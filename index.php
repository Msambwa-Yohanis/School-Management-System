<?php
session_start();

// Redirect to login if not authenticated
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Management System - Dashboard</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/dashboard.css">
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>SMS</h2>
                <p>School Management</p>
            </div>
            <nav class="sidebar-nav">
                <ul>
                    <li><a href="index.php?page=dashboard" class="nav-link <?php echo $page === 'dashboard' ? 'active' : ''; ?>">Dashboard</a></li>
                    <li><a href="index.php?page=users" class="nav-link <?php echo $page === 'users' ? 'active' : ''; ?>">Users</a></li>
                    <li><a href="index.php?page=profile" class="nav-link <?php echo $page === 'profile' ? 'active' : ''; ?>">My Profile</a></li>
                    <li><a href="index.php?page=settings" class="nav-link <?php echo $page === 'settings' ? 'active' : ''; ?>">Settings</a></li>
                    <li><a href="logout.php" class="nav-link logout">Logout</a></li>
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
                        <span><?php echo htmlspecialchars($_SESSION['username']); ?></span>
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
