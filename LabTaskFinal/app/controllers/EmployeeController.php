<?php
// ============================================
//  EMPLOYEE CONTROLLER
//  Handles: index, create, edit, delete, search
//
//  Flow: User Request → Controller
//        → calls EmployeeModel (for DB)
//        → loads employees/view (for display)
//
//  NO SQL here. NO HTML here.
// ============================================

require_once BASE_PATH . '/core/Controller.php';
require_once BASE_PATH . '/app/models/EmployeeModel.php';

class EmployeeController extends Controller {

    private $employeeModel;

    public function __construct() {
        // All employee actions require login
        $this->requireLogin();
        $this->employeeModel = new EmployeeModel();
    }

    // ------------------------------------------
    //  INDEX (Dashboard)
    //  Lists all employees
    // ------------------------------------------
    public function index() {
        // Ask Model for all employees
        $employees = $this->employeeModel->getAll();

        // Read any flash message (success/error from previous action)
        $flash = $this->getFlash();

        // Load view, pass data
        $this->view('employees/index', [
            'employees' => $employees,
            'flash'     => $flash
        ]);
    }

    // ------------------------------------------
    //  CREATE
    //  GET  → show add employee form
    //  POST → validate and save new employee
    // ------------------------------------------
    public function create() {
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $name       = trim($_POST['name']       ?? '');
            $contact_no = trim($_POST['contact_no'] ?? '');
            $username   = trim($_POST['username']   ?? '');
            $password   = trim($_POST['password']   ?? '');

            // PHP-side null check
            if (empty($name) || empty($contact_no) || empty($username) || empty($password)) {
                $error = "All fields are required.";

            } elseif ($this->employeeModel->usernameExists($username)) {
                $error = "That username is already taken by another employee.";

            } else {
                // Ask Model to insert the record
                $this->employeeModel->create($name, $contact_no, $username, $password);

                // Set flash message, redirect to list
                $this->setFlash('success', 'Employee added successfully.');
                $this->redirect('index.php?controller=employee&action=index');
            }
        }

        $this->view('employees/create', ['error' => $error]);
    }

    // ------------------------------------------
    //  EDIT
    //  GET  → show edit form pre-filled with data
    //  POST → validate and update employee record
    // ------------------------------------------
    public function edit() {
        $id    = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $error = '';

        // Ask Model for this employee's data
        $employee = $this->employeeModel->getById($id);

        if (!$employee) {
            $this->setFlash('error', 'Employee not found.');
            $this->redirect('index.php?controller=employee&action=index');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $name       = trim($_POST['name']       ?? '');
            $contact_no = trim($_POST['contact_no'] ?? '');
            $username   = trim($_POST['username']   ?? '');
            $password   = trim($_POST['password']   ?? '');

            // PHP-side null check
            if (empty($name) || empty($contact_no) || empty($username)) {
                $error = "Name, contact number, and username are required.";

            } elseif ($this->employeeModel->usernameExists($username, $id)) {
                $error = "That username is already taken by another employee.";

            } else {
                // Update with or without new password
                if (!empty($password)) {
                    $this->employeeModel->updateWithPassword($id, $name, $contact_no, $username, $password);
                } else {
                    $this->employeeModel->updateWithoutPassword($id, $name, $contact_no, $username);
                }

                $this->setFlash('success', 'Employee updated successfully.');
                $this->redirect('index.php?controller=employee&action=index');
            }
        }

        $this->view('employees/edit', [
            'employee' => $employee,
            'error'    => $error
        ]);
    }

    // ------------------------------------------
    //  DELETE
    //  Removes employee record and redirects
    // ------------------------------------------
    public function delete() {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

        $employee = $this->employeeModel->getById($id);

        if (!$employee) {
            $this->setFlash('error', 'Employee not found.');
        } else {
            $this->employeeModel->delete($id);
            $this->setFlash('success', 'Employee deleted successfully.');
        }

        $this->redirect('index.php?controller=employee&action=index');
    }

    // ------------------------------------------
    //  SEARCH
    //  Loads the search page (AJAX handles results)
    // ------------------------------------------
    public function search() {
        $this->view('employees/search', []);
    }

    // ------------------------------------------
    //  SEARCH AJAX
    //  Called by AJAX from search page.
    //  Returns JSON — no view loaded.
    // ------------------------------------------
    public function searchAjax() {
        // Return JSON only
        header('Content-Type: application/json');

        $keyword = trim($_GET['keyword'] ?? '');

        if (empty($keyword)) {
            echo json_encode([]);
            exit();
        }

        // Ask Model to search and return results
        $results = $this->employeeModel->search($keyword);
        echo json_encode($results);
        exit();
    }
}
