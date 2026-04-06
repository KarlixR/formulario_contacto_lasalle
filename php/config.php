<?php
// Configuración de conexión a la base de datos
// Ajusta estos valores según tu instalación de XAMPP
define('DB_HOST', 'lasallecontacto.infinityfreeapp.com');
define('DB_USER', 'if0_41434691');
define('DB_PASS', 'IngSoftware2026');          // XAMPP por defecto no tiene contraseña
define('DB_NAME', 'if0_41434691');

function conectar() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($conn->connect_error) {
        die('<p style="color:red">Error de conexión: ' . $conn->connect_error . '</p>');
    }
    $conn->set_charset('utf8mb4');
    return $conn;
}
