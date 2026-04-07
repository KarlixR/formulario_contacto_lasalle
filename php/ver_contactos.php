<?php
require_once 'config.php';

$conn = conectar();

// Consulta SELECT con todos los campos
$resultado = $conn->query("SELECT id, nombre, email, telefono, asunto, mensaje, fecha FROM contactos ORDER BY fecha DESC");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contactos recibidos - U La Salle</title>
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      font-family: Segoe UI, sans-serif;
      background: #f0f2f5;
      color: #333;
    }

    header {
      background: #003087;
      color: white;
      padding: 1.2rem 2rem;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    header h1 { font-size: 1.3rem; }

    header a {
      color: white;
      text-decoration: none;
      font-size: 0.9rem;
      opacity: 0.85;
    }

    header a:hover { opacity: 1; }

    .container {
      max-width: 1100px;
      margin: 2rem auto;
      padding: 0 1.5rem;
    }

    .stats {
      display: flex;
      gap: 1rem;
      margin-bottom: 1.5rem;
    }

    .stat-card {
      background: white;
      border-radius: 10px;
      padding: 1.2rem 1.8rem;
      box-shadow: 0 2px 8px rgba(0,0,0,.07);
      flex: 1;
      text-align: center;
    }

    .stat-card .number {
      font-size: 2rem;
      font-weight: 700;
      color: #003087;
    }

    .stat-card .label {
      font-size: 0.85rem;
      color: #888;
      margin-top: 0.2rem;
    }

    .card {
      background: white;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(0,0,0,.07);
      overflow: hidden;
    }

    .card-header {
      padding: 1.2rem 1.5rem;
      border-bottom: 1px solid #eee;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .card-header h2 {
      font-size: 1.1rem;
      color: #003087;
    }

    .btn {
      display: inline-block;
      padding: .55rem 1.3rem;
      background: #003087;
      color: white;
      text-decoration: none;
      border-radius: 6px;
      font-size: 0.9rem;
      transition: background .2s;
    }

    .btn:hover { background: #00256b; }

    .btn-outline {
      background: transparent;
      border: 2px solid #003087;
      color: #003087;
    }

    .btn-outline:hover { background: #003087; color: white; }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    thead th {
      background: #f8f9fb;
      color: #555;
      font-size: 0.8rem;
      text-transform: uppercase;
      letter-spacing: .05em;
      padding: .9rem 1.2rem;
      text-align: left;
      border-bottom: 2px solid #eee;
    }

    tbody td {
      padding: 1rem 1.2rem;
      border-bottom: 1px solid #f0f0f0;
      font-size: 0.95rem;
      vertical-align: top;
    }

    tbody tr:last-child td { border-bottom: none; }

    tbody tr:hover { background: #fafbff; }

    .badge {
      display: inline-block;
      padding: .25rem .7rem;
      border-radius: 20px;
      font-size: 0.8rem;
      font-weight: 600;
    }

    .badge-admisiones  { background: #dbeafe; color: #1d4ed8; }
    .badge-becas       { background: #dcfce7; color: #15803d; }
    .badge-academico   { background: #fef9c3; color: #854d0e; }
    .badge-otro        { background: #f3e8ff; color: #7e22ce; }

    .mensaje-preview {
      max-width: 220px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      color: #666;
      font-size: 0.9rem;
    }

    .fecha {
      font-size: 0.85rem;
      color: #888;
      white-space: nowrap;
    }

    .empty {
      text-align: center;
      padding: 3rem;
      color: #aaa;
    }

    .empty p { margin-top: .5rem; font-size: 0.95rem; }
  </style>
</head>
<body>

<header>
  <h1>🎓 Panel de Contactos — U La Salle</h1>
  <a href="../index.html">← Volver al sitio</a>
</header>

<div class="container">

  <?php
    $total = $resultado ? $resultado->num_rows : 0;

    // Contar por asunto
    $por_asunto = ['admisiones' => 0, 'becas' => 0, 'academico' => 0, 'otro' => 0];
    $filas = [];
    if ($resultado && $total > 0) {
      while ($f = $resultado->fetch_assoc()) {
        $filas[] = $f;
        $key = $f['asunto'];
        if (isset($por_asunto[$key])) $por_asunto[$key]++;
        else $por_asunto['otro']++;
      }
    }
  ?>

  <div class="stats">
    <div class="stat-card">
      <div class="number"><?= $total ?></div>
      <div class="label">Total de mensajes</div>
    </div>
    <div class="stat-card">
      <div class="number"><?= $por_asunto['admisiones'] ?></div>
      <div class="label">Admisiones</div>
    </div>
    <div class="stat-card">
      <div class="number"><?= $por_asunto['becas'] ?></div>
      <div class="label">Becas</div>
    </div>
    <div class="stat-card">
      <div class="number"><?= $por_asunto['academico'] ?></div>
      <div class="label">Info académica</div>
    </div>
  </div>

  <div class="card">
    <div class="card-header">
      <h2>📋 Mensajes recibidos</h2>
      <a href="insertar.php" class="btn">➕ Insertar prueba</a>
    </div>

    <?php if ($total > 0): ?>
    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Nombre</th>
          <th>Email</th>
          <th>Teléfono</th>
          <th>Asunto</th>
          <th>Mensaje</th>
          <th>Fecha</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($filas as $fila): ?>
          <?php
            $badgeClass = 'badge-' . $fila['asunto'];
            if (!in_array($fila['asunto'], ['admisiones','becas','academico'])) $badgeClass = 'badge-otro';
          ?>
          <tr>
            <td><strong><?= $fila['id'] ?></strong></td>
            <td><?= htmlspecialchars($fila['nombre']) ?></td>
            <td><?= htmlspecialchars($fila['email']) ?></td>
            <td><?= htmlspecialchars($fila['telefono'] ?: '—') ?></td>
            <td><span class="badge <?= $badgeClass ?>"><?= htmlspecialchars($fila['asunto']) ?></span></td>
            <td><div class="mensaje-preview" title="<?= htmlspecialchars($fila['mensaje']) ?>"><?= htmlspecialchars($fila['mensaje']) ?></div></td>
            <td><span class="fecha"><?= date('d/m/Y H:i', strtotime($fila['fecha'])) ?></span></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <?php else: ?>
      <div class="empty">
        <div style="font-size:2.5rem">📭</div>
        <p>No hay mensajes todavía. <a href="insertar.php">Inserta el primero</a>.</p>
      </div>
    <?php endif; ?>
  </div>

</div>

<?php $conn->close(); ?>
</body>
</html>