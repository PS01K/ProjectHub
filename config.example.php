<?php
// ============================================
// ProjectHub — Database Configuration (Example)
// ============================================
// Copy this file as config.php and fill in your
// actual database credentials.
// ============================================

define('DB_HOST', 'your_database_host');     // e.g., 'sql123.infinityfree.com'
define('DB_USER', 'your_database_user');     // e.g., 'if0_12345678'
define('DB_PASSWORD', 'your_db_password');   // Your database password
define('DB_NAME', 'your_database_name');     // e.g., 'if0_12345678_projecthub'

// Establish database connection
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check connection
if (!$conn) {
    die("Sorry, we are unable to connect to the database. Please try again later.");
}

// Set charset to handle special characters properly
mysqli_set_charset($conn, "utf8mb4");
?>
