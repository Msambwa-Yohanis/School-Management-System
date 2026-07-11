<?php
session_start();
require_once 'config/database.php';
require_once 'config/auth_middleware.php';
require_once 'config/roles.php';

// Check if user is authenticated
requireLogin();

// Get requested page
$page = isset($_GET['page']) ? preg_replace('/[^a-z_]/', '', $_GET['page']) : 'dashboard';

// Check if page exists and user has access
if (!file_exists('pages/' . $page . '.php') || !canAccessPage($_SESSION['role'], $page)) {
    $page = 'dashboard';
}

// Get user role info
$userRole = $_SESSION['role'];
$visiblePages = getVisiblePages($userRole);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Management System - Dashboard</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <style>
        .role-badge {
            display: inline-block;
            padding: 4px 8px;
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border-radius: 4px;
            font-size: 12px;
            margin-top: 8px;
            text-transform: uppercase;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>SMS</h2>
                <p>School Management</p>
                <span class="role-badge"><?php echo htmlspecialchars(getRoleLabel($userRole)); ?></span>
            </div>
            <nav class="sidebar-nav">
                <ul>
                    <?php foreach ($visiblePages as $pageKey => $pageData): ?>
                        <li>
                            <a href="index.php?page=<?php echo htmlspecialchars($pageKey); ?>" 
                               class="nav-link <?php echo $page === $pageKey ? 'active' : ''; ?>"
                               title="<?php echo htmlspecialchars($pageData['label']); ?>">
                                <span class="nav-icon"><?php echo $pageData['icon']; ?></span>
                                <span class="nav-text"><?php echo htmlspecialchars($pageData['label']); ?></span>
                            </a>
                        </li>
                    <?php endforeach; ?>
                    <li>
                        <a href="logout.php" class="nav-link logout" title="Logout">
                            <span class="nav-icon">🚪</span>
                            <span class="nav-text">Logout</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <header class="top-header">
                <div class="header-left">
                    <h1>Welcome to School Management System</h1>
                </div>
                <div class="header-right">
                    <div class="user-info">
                        <span title="Your Role: <?php echo htmlspecialchars(getRoleLabel($userRole)); ?>">
                            <?php echo htmlspecialchars($_SESSION['username']); ?>
                            <small>(<?php echo htmlspecialchars(getRoleLabel($userRole)); ?>)</small>
                        </span>
                    </div>
                </div>
            </header>

            <section class="content">
                <?php
                $page_file = 'pages/' . $page . '.php';
                if (file_exists($page_file)) {
                    include $page_file;
                } else {
                    include 'pages/dashboard.php';
                }
                ?>
            </section>
        </main>
    </div>
</body>
</html>