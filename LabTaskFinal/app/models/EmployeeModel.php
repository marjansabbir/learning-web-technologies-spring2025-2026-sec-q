<?php
// ============================================
//  EMPLOYEE MODEL
//  Handles all database operations for employees.
//  ONLY contains DB queries and data logic.
//  NO HTML, NO echo, NO redirects.
// ============================================

require_once BASE_PATH . '/core/Model.php';

class EmployeeModel extends Model {

    /**
     * Fetch all employees, newest first.
     */
    public function getAll() {
        $stmt = $this->pdo->query(
            "SELECT * FROM employees ORDER BY id DESC"
        );
        return $stmt->fetchAll();
    }

    /**
     * Fetch a single employee by their ID.
     * Returns the row or false if not found.
     */
    public function getById($id) {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM employees WHERE id = ?"
        );
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    /**
     * Check if an employee username already exists.
     * Pass $excludeId when editing so we skip the current employee.
     */
    public function usernameExists($username, $excludeId = null) {
        if ($excludeId) {
            $stmt = $this->pdo->prepare(
                "SELECT id FROM employees WHERE username = ? AND id != ?"
            );
            $stmt->execute([$username, $excludeId]);
        } else {
            $stmt = $this->pdo->prepare(
                "SELECT id FROM employees WHERE username = ?"
            );
            $stmt->execute([$username]);
        }
        return $stmt->fetch() ? true : false;
    }

    /**
     * Insert a new employee record.
     */
    public function create($name, $contact_no, $username, $password) {
        $stmt = $this->pdo->prepare(
            "INSERT INTO employees (name, contact_no, username, password)
             VALUES (?, ?, ?, MD5(?))"
        );
        return $stmt->execute([$name, $contact_no, $username, $password]);
    }

    /**
     * Update employee and change their password.
     */
    public function updateWithPassword($id, $name, $contact_no, $username, $password) {
        $stmt = $this->pdo->prepare(
            "UPDATE employees
             SET name = ?, contact_no = ?, username = ?, password = MD5(?)
             WHERE id = ?"
        );
        return $stmt->execute([$name, $contact_no, $username, $password, $id]);
    }

    /**
     * Update employee but keep their existing password unchanged.
     */
    public function updateWithoutPassword($id, $name, $contact_no, $username) {
        $stmt = $this->pdo->prepare(
            "UPDATE employees
             SET name = ?, contact_no = ?, username = ?
             WHERE id = ?"
        );
        return $stmt->execute([$name, $contact_no, $username, $id]);
    }

    /**
     * Delete an employee by ID.
     */
    public function delete($id) {
        $stmt = $this->pdo->prepare(
            "DELETE FROM employees WHERE id = ?"
        );
        return $stmt->execute([$id]);
    }

    /**
     * Search employees by name, contact number, or username.
     * Returns results as associative array (used for AJAX/JSON).
     */
    public function search($keyword) {
        $like = '%' . $keyword . '%';
        $stmt = $this->pdo->prepare(
            "SELECT id, name, contact_no, username
             FROM employees
             WHERE name LIKE ? OR contact_no LIKE ? OR username LIKE ?
             ORDER BY name ASC"
        );
        $stmt->execute([$like, $like, $like]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
