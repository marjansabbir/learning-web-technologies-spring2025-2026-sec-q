<?php
// ============================================
//  BASE CONTROLLER
//  All controllers extend this class.
//  Provides helpers: view(), redirect(),
//  session checks, and flash messages.
//  Controllers NEVER contain SQL queries.
//  Controllers NEVER contain raw HTML.
// ============================================

class Controller {

    // ------------------------------------------
    //  Load a view file and pass data to it
    //  $viewPath : e.g. 'employees/index'
    //  $data     : array of variables for view
    // ------------------------------------------
    protected function view($viewPath, $data = []) {
        // Turn array keys into variables
        // e.g. ['employees' => [...]] becomes $employees in the view
        extract($data);

        $file = BASE_PATH . '/app/views/' . $viewPath . '.php';

        if (file_exists($file)) {
            require $file;
        } else {
            die("View not found: <strong>$viewPath</strong>");
        }
    }

    // ------------------------------------------
    //  Redirect to another URL
    // ------------------------------------------
    protected function redirect($url) {
        header("Location: $url");
        exit();
    }

    // ------------------------------------------
    //  Check if admin session is active
    // ------------------------------------------
    protected function isLoggedIn() {
        return isset($_SESSION['admin_id']);
    }

    // ------------------------------------------
    //  Force login — redirect if not logged in
    // ------------------------------------------
    protected function requireLogin() {
        if (!$this->isLoggedIn()) {
            $this->redirect('index.php?controller=auth&action=login');
        }
    }

    // ------------------------------------------
    //  Store a one-time flash message in session
    // ------------------------------------------
    protected function setFlash($type, $message) {
        $_SESSION['flash'] = [
            'type'    => $type,       // 'success' or 'error'
            'message' => $message
        ];
    }

    // ------------------------------------------
    //  Read and clear the flash message
    // ------------------------------------------
    protected function getFlash() {
        if (isset($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            unset($_SESSION['flash']);
            return $flash;
        }
        return null;
    }
}
