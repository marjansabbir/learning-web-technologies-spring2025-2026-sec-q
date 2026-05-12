<?php
// ============================================
//  DATABASE CONFIGURATION
//  Change these values to match your setup
// ============================================

define('DB_HOST', 'localhost');
define('DB_NAME', 'shop_management');
define('DB_USER', 'root');
define('DB_PASS', '');

/**
 * Returns a singleton PDO database connection.
 * Called once; reused on every subsequent call.
 */
function getDB() {
    static $pdo = null;

    if ($pdo === null) {
        try {
            $pdo = new PDO(
                "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8",
                DB_USER,
                DB_PASS
            );
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    return $pdo;
}
