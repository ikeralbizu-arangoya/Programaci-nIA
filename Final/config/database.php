    <?php
// Configuración de conexión a MySQL
define('DB_HOST', 'localhost');
define('DB_NAME', 'f1_project');
define('DB_USER', 'root');  // Usuario XAMPP por defecto
define('DB_PASS', 'root');      // Contraseña vacía en XAMPP por defecto

// Crear conexión
try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ]
    );
} catch(PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>