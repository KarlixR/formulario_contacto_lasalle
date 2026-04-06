<?php
require_once 'config.php';

$conn = conectar();

// Consulta SELECT simple
$resultado = $conn->query("SELECT id, nombre, email, asunto, fecha FROM contactos ORDER BY fecha DESC");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Contactos - Prueba BD</title>
  <style>
    body { font-family: Segoe UI, sans-serif; padding: 2rem; background: #f5f5f5; }
    h2   { color: #003087; margin-bottom: 1rem; }
    table { border-collapse: collapse; width: 100%; background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,.08); }
    th   { background: #003087; color: white; padding: .75rem 1rem; text-align: left; }
    td   { padding: .65rem 1rem; border-bottom: 1px solid #eee; }
    tr:last-child td { border-bottom: none; }
    .btn { display: inline-block; margin-top: 1rem; padding: .6rem 1.5rem; background: #003087; color: white; text-decoration: none; border-radius: 4px; }
  </style>
</head>
<body>
  <h2>📋 Registros en tabla <code>contactos</code></h2>

  <?php if ($resultado && $resultado->num_rows > 0): ?>
    <p>Se encontraron <strong><?= $resultado->num_rows ?></strong> registro(s).</p>
    <table>
      <thead>
        <tr>
          <th>ID</th><th>Nombre</th><th>Email</th><th>Asunto</th><th>Fecha</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($fila = $resultado->fetch_assoc()): ?>
          <tr>
            <td><?= $fila['id'] ?></td>
            <td><?= htmlspecialchars($fila['nombre']) ?></td>
            <td><?= htmlspecialchars($fila['email']) ?></td>
            <td><?= htmlspecialchars($fila['asunto']) ?></td>
            <td><?= $fila['fecha'] ?></td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  <?php else: ?>
    <p>No hay registros en la tabla. <a href="insertar.php">Insertar datos de prueba</a>.</p>
  <?php endif; ?>

  <a class="btn" href="insertar.php">➕ Insertar nuevo contacto</a>

  <?php $conn->close(); ?>
</body>
</html>
