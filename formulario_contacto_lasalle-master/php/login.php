<?php
session_start();
require_once 'config.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['usuario'] ?? '');
    $clave   = $_POST['clave'] ?? '';

    $admin_usuario = $_ENV['ADMIN_USER'] ?? 'admin';
    $admin_clave   = $_ENV['ADMIN_PASS'] ?? '';

    if ($usuario === $admin_usuario && hash_equals($admin_clave, $clave)) {
        $_SESSION['admin'] = true;
        header('Location: ver_contactos.php');
        exit;
    }
    $error = 'Usuario o contraseña incorrectos.';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin - U La Salle</title>
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: Segoe UI, sans-serif; background: #f0f2f5; display: flex; align-items: center; justify-content: center; min-height: 100vh; }
    .login-card { background: white; padding: 2.5rem; border-radius: 10px; box-shadow: 0 2px 12px rgba(0,0,0,.1); width: 100%; max-width: 360px; }
    h2 { color: #003087; margin-bottom: 1.5rem; text-align: center; }
    label { display: block; font-size: .9rem; font-weight: 600; margin-bottom: .3rem; color: #444; }
    input { width: 100%; padding: .6rem .8rem; border: 1px solid #ccc; border-radius: 4px; font-size: .95rem; margin-bottom: 1rem; }
    input:focus { outline: none; border-color: #003087; }
    button { width: 100%; padding: .7rem; background: #003087; color: white; border: none; border-radius: 4px; font-size: 1rem; cursor: pointer; }
    button:hover { background: #00256b; }
    .err { color: #cc0000; background: #fdecea; padding: .7rem; border-radius: 4px; margin-bottom: 1rem; font-size: .9rem; }
  </style>
</head>
<body>
  <div class="login-card">
    <h2>🔐 Panel Admin</h2>
    <?php if ($error): ?>
      <p class="err"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form method="POST">
      <label for="usuario">Usuario</label>
      <input type="text" id="usuario" name="usuario" required autofocus />
      <label for="clave">Contraseña</label>
      <input type="password" id="clave" name="clave" required />
      <button type="submit">Ingresar</button>
    </form>
  </div>
</body>
</html>
