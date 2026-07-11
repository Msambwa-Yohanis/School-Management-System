<?php
/**
 * Authentication and Authorization Middleware
 * Handles access control checks
 */

require_once 'roles.php';

/**
 * Check if user is authenticated
 * Redirects to login if not
 */
function requireLogin() {
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit();
    }
}

/**
 * Check if user has specific role
 * 
 * @param string|array $requiredRoles Role or array of roles required
 * @return bool True if user has required role
 */
function hasRole($requiredRoles) {
    if (!isset($_SESSION['role'])) {
        return false;
    }
    
    if (is_string($requiredRoles)) {
        return $_SESSION['role'] === $requiredRoles;
    }
    
    if (is_array($requiredRoles)) {
        return in_array($_SESSION['role'], $requiredRoles);
    }
    
    return false;
}

/**
 * Check if user can access a page
 * Denies access if not authorized
 * 
 * @param string $page Page to access
 * @return bool True if user can access page
 */
function requirePageAccess($page) {
    requireLogin();
    
    if (!canAccessPage($_SESSION['role'], $page)) {
        http_response_code(403);
        die('
            <!DOCTYPE html>
            <html>
            <head>
                <title>Access Denied</title>
                <link rel="stylesheet" href="assets/css/style.css">
                <style>
                    body {
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        height: 100vh;
                        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                        font-family: Arial, sans-serif;
                    }
                    .error-container {
                        background: white;
                        padding: 40px;
                        border-radius: 10px;
                        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
                        text-align: center;
                    }
                    .error-code {
                        font-size: 48px;
                        color: #e74c3c;
                        font-weight: bold;
                        margin: 0;
                    }
                    .error-message {
                        font-size: 18px;
                        color: #333;
                        margin: 15px 0;
                    }
                    .error-description {
                        color: #666;
                        font-size: 14px;
                        margin: 15px 0;
                    }
                    .back-link {
                        display: inline-block;
                        margin-top: 20px;
                        padding: 10px 20px;
                        background: #667eea;
                        color: white;
                        text-decoration: none;
                        border-radius: 5px;
                    }
                    .back-link:hover {
                        background: #764ba2;
                    }
                </style>
            </head>
            <body>
                <div class="error-container">
                    <h1 class="error-code">403</h1>
                    <p class="error-message">Access Denied</p>
                    <p class="error-description">You do not have permission to access this page. Your role (' . htmlspecialchars($_SESSION['role']) . ') is not authorized to view this resource.</p>
                    <a href="index.php?page=dashboard" class="back-link">← Back to Dashboard</a>
                </div>
            </body>
            </html>
        ');
        exit();
    }
    
    return true;
}

/**
 * Require specific role with custom error
 * 
 * @param string|array $requiredRoles Role or array of roles
 * @param string $errorMessage Custom error message
 */
function requireRole($requiredRoles, $errorMessage = null) {
    requireLogin();
    
    if (!hasRole($requiredRoles)) {
        http_response_code(403);
        $message = $errorMessage ?? 'Access Denied. Your role is not authorized to perform this action.';
        die('
            <!DOCTYPE html>
            <html>
            <head>
                <title>Access Denied</title>
                <link rel="stylesheet" href="assets/css/style.css">
                <style>
                    body {
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        height: 100vh;
                        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                        font-family: Arial, sans-serif;
                    }
                    .error-container {
                        background: white;
                        padding: 40px;
                        border-radius: 10px;
                        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
                        text-align: center;
                    }
                    .error-code {
                        font-size: 48px;
                        color: #e74c3c;
                        font-weight: bold;
                        margin: 0;
                    }
                    .error-message {
                        font-size: 18px;
                        color: #333;
                        margin: 15px 0;
                    }
                    .back-link {
                        display: inline-block;
                        margin-top: 20px;
                        padding: 10px 20px;
                        background: #667eea;
                        color: white;
                        text-decoration: none;
                        border-radius: 5px;
                    }
                    .back-link:hover {
                        background: #764ba2;
                    }
                </style>
            </head>
            <body>
                <div class="error-container">
                    <h1 class="error-code">403</h1>
                    <p class="error-message">Access Denied</p>
                    <p class="error-message">' . htmlspecialchars($message) . '</p>
                    <a href="index.php?page=dashboard" class="back-link">← Back to Dashboard</a>
                </div>
            </body>
            </html>
        ');
        exit();
    }
}

?>
