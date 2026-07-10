<?php
require_once 'config/database.php';

// Get user statistics
$total_users = $pdo->query('SELECT COUNT(*) FROM users')->fetchColumn();
$total_students = $pdo->query('SELECT COUNT(*) FROM users WHERE role = "student"')->fetchColumn();
$total_teachers = $pdo->query('SELECT COUNT(*) FROM users WHERE role = "teacher"')->fetchColumn();
$total_admins = $pdo->query('SELECT COUNT(*) FROM users WHERE role = "admin"')->fetchColumn();
?>

<div class="dashboard-grid">
    <div class="stat-card">
        <div class="stat-icon">👥</div>
        <div class="stat-content">
            <h3>Total Users</h3>
            <p class="stat-number"><?php echo $total_users; ?></p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">👨‍🎓</div>
        <div class="stat-content">
            <h3>Students</h3>
            <p class="stat-number"><?php echo $total_students; ?></p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">👨‍🏫</div>
        <div class="stat-content">
            <h3>Teachers</h3>
            <p class="stat-number"><?php echo $total_teachers; ?></p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">⚙️</div>
        <div class="stat-content">
            <h3>Admins</h3>
            <p class="stat-number"><?php echo $total_admins; ?></p>
        </div>
    </div>
</div>

<div class="dashboard-content">
    <div class="card">
        <div class="card-header">
            <h2>Welcome to Dashboard</h2>
        </div>
        <div class="card-body">
            <p>This is your School Management System dashboard. You can manage users, view statistics, and access all system features from the sidebar navigation.</p>
            <p><strong>Your Role:</strong> <?php echo ucfirst($_SESSION['role']); ?></p>
        </div>
    </div>
</div>
