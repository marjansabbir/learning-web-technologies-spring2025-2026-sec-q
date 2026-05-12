<?php
// ============================================
//  ROUTER
//  Reads the URL parameters and loads the
//  correct Controller and calls the action.
//
//  URL format:
//  index.php?controller=auth&action=login
//  index.php?controller=employee&action=index
// ============================================

class Router {

    public function dispatch() {

        // Read controller and action from URL, set defaults
        $controller = isset($_GET['controller']) ? $_GET['controller'] : 'auth';
        $action     = isset($_GET['action'])     ? $_GET['action']     : 'login';

        // Allow only letters (security: prevent directory traversal)
        $controller = preg_replace('/[^a-zA-Z]/', '', $controller);
        $action     = preg_replace('/[^a-zA-Z_]/', '', $action);

        // Build class name: "employee" → "EmployeeController"
        $className = ucfirst(strtolower($controller)) . 'Controller';
        $classFile = BASE_PATH . '/app/controllers/' . $className . '.php';

        if (file_exists($classFile)) {
            require_once $classFile;

            $obj = new $className();

            if (method_exists($obj, $action)) {
                $obj->$action();
            } else {
                $this->notFound("Action '<b>$action</b>' does not exist in $className.");
            }

        } else {
            $this->notFound("Controller file '<b>$className.php</b>' not found.");
        }
    }

    // Simple 404 page
    private function notFound($detail = '') {
        http_response_code(404);
        echo "<h2>404 - Page Not Found</h2>";
        if ($detail) echo "<p>$detail</p>";
        echo "<p><a href='index.php'>Go to Home</a></p>";
    }
}
