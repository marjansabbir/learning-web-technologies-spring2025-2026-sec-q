<?php
// ============================================
//  ADMIN MODEL
//  Handles all database operations for admins.
//  ONLY contains DB queries.
//  NO HTML, NO echo, NO redirects.
// ============================================

require_once BASE_PATH . '/core/Model.php';

class AdminModel extends Model {

    /**
     * Find an admin by username + password.
     * Used for login.
     * Returns the admin row or false.
     */
    public function findByCredentials($username, $password) {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM admins WHERE username = ? AND password = MD5(?)"
        );
        $stmt->execute([$username, $password]);
        return $stmt->fetch();
    }

    /**
     * Check if a username already exists.
     * Used before registering a new admin.
     * Returns true if taken, false if free.
     */
    public function usernameExists($username) {
        $stmt = $this->pdo->prepare(
            "SELECT id FROM admins WHERE username = ?"
        );
        $stmt->execute([$username]);
        return $stmt->fetch() ? true : false;
    }

    /**
     * Insert a new admin into the database.
     * Password is hashed with MD5.
     */
    public function create($username, $password) {
        $stmt = $this->pdo->prepare(
            "INSERT INTO admins (username, password) VALUES (?, MD5(?))"
        );
        return $stmt->execute([$username, $password]);
    }
}
