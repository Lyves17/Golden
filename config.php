<?php
// Configuration de l'application GoldenAxe
define('APP_NAME', 'GoldenAxe');
define('APP_VERSION', '1.0.0');

// Configuration de la base de données
define('DB_HOST', 'localhost');
define('DB_USER', 'bankuser');
define('DB_PASS', 'bankpass');
define('DB_NAME', 'web_programming');

// Chemins de l'application
define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/Goldenaxe');
define('APP_ROOT', dirname(__DIR__) . '/Goldenaxe');

// Rôles utilisateurs
define('ROLE_ADMIN', 'Admin');
define('ROLE_EMPLOYEE', 'Employee');
define('ROLE_CLIENT', 'Client');

// Configuration des sessions
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_secure', isset($_SERVER['HTTPS']));

// Configuration du fuseau horaire
date_default_timezone_set('Europe/Paris');

// Gestion des erreurs
if (defined('ENVIRONMENT')) {
    switch (ENVIRONMENT) {
        case 'development':
            error_reporting(-1);
            ini_set('display_errors', 1);
            break;
        case 'production':
            ini_set('display_errors', 0);
            error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
            break;
        default:
            header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
            echo 'The application environment is not set correctly.';
            exit(1);
    }
}

// Fonctions utilitaires
function isAdmin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === ROLE_ADMIN;
}

function isEmployee() {
    return isset($_SESSION['role']) && $_SESSION['role'] === ROLE_EMPLOYEE;
}

function isClient() {
    return isset($_SESSION['role']) && $_SESSION['role'] === ROLE_CLIENT;
}

function requireRole($role) {
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== $role) {
        header('HTTP/1.1 403 Forbidden');
        include_once 'errors/403.php';
        exit();
    }
}

// Fonction pour charger automatiquement les classes
spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    $base_dir = __DIR__ . '/app/';
    
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }
    
    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    
    if (file_exists($file)) {
        require $file;
    }
});
