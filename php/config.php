<?php
// Configuración de conexión a la base de datos
define('DB_HOST', 'sql102.infinityfree.com');
define('DB_USER', 'if0_41596719');
define('DB_PASS', 'VWrVejVSWya');
define('DB_NAME', 'if0_41596719_contactos');

function conectar() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($conn->connect_error) {
        die('<p style="color:red">Error de conexión: ' . $conn->connect_error . '</p>');
    }
    $conn->set_charset('utf8mb4');
    return $conn;
}