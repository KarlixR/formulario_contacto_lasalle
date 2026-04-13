<?php
require_once 'config.php';
 
// Si la petición viene del formulario principal vía fetch (AJAX),
// respondemos solo con JSON y terminamos
$es_ajax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
           strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
 
$mensaje_ok = '';
$error      = '';
 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre   = trim($_POST['nombre']   ?? '');
    $email    = trim($_POST['email']    ?? '');
    $telefono = trim($_POST['telefono'] ?? '');
    $asunto   = trim($_POST['asunto']   ?? '');
    $mensaje  = trim($_POST['mensaje']  ?? '');
 
    if (!$nombre || !$email || !$asunto || !$mensaje) {
        $error = 'Todos los campos obligatorios deben completarse.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'El correo electrónico no es válido.';
    } else {
        $conn = conectar();
        $stmt = $conn->prepare(
            "INSERT INTO contactos (nombre, email, telefono, asunto, mensaje) VALUES (?, ?, ?, ?, ?)"
        );
        $stmt->bind_param('sssss', $nombre, $email, $telefono, $asunto, $mensaje);
 
        if ($stmt->execute()) {
            $mensaje_ok = "Contacto guardado con ID: " . $conn->insert_id;
        } else {
            $error = 'Error al guardar: ' . $stmt->error;
        }
        $stmt->close();
        $conn->close();
    }
 
    // Si es una petición AJAX, devolver JSON y salir
    if ($es_ajax) {
        header('Content-Type: application/json');
        if ($mensaje_ok) {
            echo json_encode(['ok' => true, 'mensaje' => $mensaje_ok]);
        } else {
            echo json_encode(['ok' => false, 'error' => $error]);
        }
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Insertar Contacto - Prueba BD</title>
  <style>
    body  { font-family: Segoe UI, sans-serif; padding: 2rem; background: #f5f5f5; }
    h2    { color: #003087; margin-bottom: 1rem; }
    form  { background: white; padding: 2rem; border-radius: 8px; max-width: 480px; box-shadow: 0 2px 8px rgba(0,0,0,.08); }
    label { display: block; font-weight: 600; margin: .8rem 0 .2rem; font-size: .9rem; }
    input, select, textarea { width: 100%; padding: .5rem .7rem; border: 1px solid #ccc; border-radius: 4px; font-size: .95rem; }
    button { margin-top: 1.2rem; padding: .65rem 1.8rem; background: #003087; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 1rem; }
    .ok   { color: #1e7e34; background: #e6f4ea; padding: .8rem; border-radius: 4px; margin-bottom: 1rem; }
    .err  { color: #cc0000; background: #fdecea; padding: .8rem; border-radius: 4px; margin-bottom: 1rem; }
    a     { display: inline-block; margin-top: 1rem; color: #003087; }
  </style>
</head>
<body>
  <h2>➕ Insertar contacto de prueba</h2>
 
  <?php if ($mensaje_ok): ?><p class="ok">✅ <?= htmlspecialchars($mensaje_ok) ?></p><?php endif; ?>
  <?php if ($error):      ?><p class="err">❌ <?= htmlspecialchars($error) ?></p><?php endif; ?>
 
  <form method="POST">
    <label>Nombre *</label>
    <input type="text" name="nombre" required />
 
    <label>Email *</label>
    <input type="email" name="email" required />
 
    <label>Teléfono</label>
    <input type="tel" name="telefono" />
 
    <label>Asunto *</label>
    <select name="asunto" required>
      <option value="">-- Selecciona --</option>
      <option value="admisiones">Admisiones</option>
      <option value="becas">Becas y financiamiento</option>
      <option value="academico">Información académica</option>
      <option value="otro">Otro</option>
    </select>
 
    <label>Mensaje *</label>
    <textarea name="mensaje" rows="4" required></textarea>
 
    <button type="submit">Guardar en BD</button>
  </form>
 
  <a href="ver_contactos.php">← Ver todos los contactos</a>
</body>
</html>