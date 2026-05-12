<?php
// ============================================
//  AUTH CONTROLLER
//  Handles: login, register, logout
//
//  Flow: User Request → Controller
//        → calls AdminModel (for DB)
//        → loads auth/view (for display)
//
//  NO SQL here. NO HTML here.
// ============================================

require_once BASE_PATH . '/core/Controller.php';
require_once BASE_PATH . '/app/models/AdminModel.php';

class AuthController extends Controller {

    private $adminModel;

    public function __construct() {
        $this->adminModel = new AdminModel();
    }

    // ------------------------------------------
    //  LOGIN
    //  GET  → show login form
    //  POST → validate credentials, start session
    // ------------------------------------------
    public function login() {

        // Already logged in? Send to dashboard
        if ($this->isLoggedIn()) {
            $this->redirect('index.php?controller=employee&action=index');
        }

        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $username = trim($_POST['username'] ?? '');
            $password = trim($_POST['password'] ?? '');

            // PHP-side null check (backup to JS validation)
            if (empty($username) || empty($password)) {
                $error = "Please enter both username and password.";

            } else {
                // Ask the Model to verify credentials
                $admin = $this->adminModel->findByCredentials($username, $password);

                if ($admin) {
                    // Credentials valid — store in session
                    $_SESSION['admin_id']       = $admin['id'];
                    $_SESSION['admin_username'] = $admin['username'];
                    $this->redirect('index.php?controller=employee&action=index');

                } else {
                    $error = "Invalid username or password.";
                }
            }
        }

        // Load the login view, pass $error to it
        $this->view('auth/login', ['error' => $error]);
    }

    // ------------------------------------------
    //  REGISTER
    //  GET  → show registration form
    //  POST → validate input, create admin account
    // ------------------------------------------
    public function register() {

        if ($this->isLoggedIn()) {
            $this->redirect('index.php?controller=employee&action=index');
        }

        $error   = '';
        $success = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $username = trim($_POST['username'] ?? '');
            $password = trim($_POST['password'] ?? '');
            $confirm  = trim($_POST['confirm_password'] ?? '');

            // Validation (PHP backup)
            if (empty($username) || empty($password) || empty($confirm)) {
                $error = "All fields are required.";

            } elseif ($password !== $confirm) {
                $error = "Passwords do not match.";

            } elseif ($this->adminModel->usernameExists($username)) {
                $error = "Username already taken. Please choose another.";

            } else {
                // Ask Model to create the admin
                $this->adminModel->create($username, $password);
                $success = "Registration successful! You can now login.";
            }
        }

        // Load register view, pass $error and $success
        $this->view('auth/register', [
            'error'   => $error,
            'success' => $success
        ]);
    }

    // ------------------------------------------
    //  LOGOUT
    //  Destroy session, redirect to login
    // ------------------------------------------
    public function logout() {
        session_destroy();
        $this->redirect('index.php?controller=auth&action=login');
    }
}
