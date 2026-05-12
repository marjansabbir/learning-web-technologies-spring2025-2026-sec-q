<?php
// ============================================
//  FRONT CONTROLLER
//  This is the ONLY entry point for the app.
//  Every URL goes through this file.
//
//  URL format:
//  index.php?controller=auth&action=login
//  index.php?controller=employee&action=index
//  index.php?controller=employee&action=create
//  index.php?controller=employee&action=edit&id=1
//  index.php?controller=employee&action=delete&id=1
//  index.php?controller=employee&action=search
//  index.php?controller=employee&action=searchAjax
// ============================================

session_start();

// Absolute path to this folder (used everywhere for requires)
define('BASE_PATH', __DIR__);

// Load config and core framework files
require_once BASE_PATH . '/config/database.php';
require_once BASE_PATH . '/core/Model.php';
require_once BASE_PATH . '/core/Controller.php';
require_once BASE_PATH . '/core/Router.php';

// Hand off to the Router — it reads the URL and calls the right Controller
$router = new Router();
$router->dispatch();
