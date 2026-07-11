<?php
require_once 'config/database.php';
require_once 'config/roles.php';

$userRole = $_SESSION['role'];
?>

<div class="dashboard-grid">
    <?php if ($userRole === 'admin'): ?>
        <!-- Admin Dashboard -->
        <div class="stat-card">
            <div class="stat-icon">👥</div>
            <div class="stat-content">
                <h3>Total Users</h3>
                <p class="stat-number">
                    <?php echo $pdo->query('SELECT COUNT(*) FROM users')->fetchColumn(); ?>
                </p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">👨‍🎓</div>
            <div class="stat-content">
                <h3>Students</h3>
                <p class="stat-number">
                    <?php echo $pdo->query('SELECT COUNT(*) FROM users WHERE role = "student"')->fetchColumn(); ?>
                </p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">👨‍🏫</div>
            <div class="stat-content">
                <h3>Teachers</h3>
                <p class="stat-number">
                    <?php echo $pdo->query('SELECT COUNT(*) FROM users WHERE role = "teacher"')->fetchColumn(); ?>
                </p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">⚙️</div>
            <div class="stat-content">
                <h3>Admins</h3>
                <p class="stat-number">
                    <?php echo $pdo->query('SELECT COUNT(*) FROM users WHERE role = "admin"')->fetchColumn(); ?>
                </p>
            </div>
        </div>

    <?php elseif ($userRole === 'teacher'): ?>
        <!-- Teacher Dashboard -->
        <div class="stat-card">
            <div class="stat-icon">📚</div>
            <div class="stat-content">
                <h3>My Classes</h3>
                <p class="stat-number">0</p>
                <p style="font-size: 12px; color: #999;">Manage your classes</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">👥</div>
            <div class="stat-content">
                <h3>Total Students</h3>
                <p class="stat-number">0</p>
                <p style="font-size: 12px; color: #999;">In your classes</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">📝</div>
            <div class="stat-content">
                <h3>Pending Grades</h3>
                <p class="stat-number">0</p>
                <p style="font-size: 12px; color: #999;">To be submitted</p>
            </div>
        </div>

    <?php elseif ($userRole === 'student'): ?>
        <!-- Student Dashboard -->
        <div class="stat-card">
            <div class="stat-icon">📊</div>
            <div class="stat-content">
                <h3>GPA</h3>
                <p class="stat-number">--</p>
                <p style="font-size: 12px; color: #999;">Current academic average</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">✓</div>
            <div class="stat-content">
                <h3>Attendance</h3>
                <p class="stat-number">--</p>
                <p style="font-size: 12px; color: #999;">Attendance percentage</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">📚</div>
            <div class="stat-content">
                <h3>Courses</h3>
                <p class="stat-number">0</p>
                <p style="font-size: 12px; color: #999;">Enrolled courses</p>
            </div>
        </div>

    <?php endif; ?>
</div>

<div class="dashboard-content">
    <div class="card">
        <div class="card-header">
            <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>! 👋</h2>
        </div>
        <div class="card-body">
            <p>
                Welcome to the <strong>School Management System</strong>. 
                You are logged in as a <strong><?php echo htmlspecialchars(getRoleLabel($userRole)); ?></strong>.
            </p>
            
            <?php if ($userRole === 'admin'): ?>
                <p>As an administrator, you have full access to manage the system, including:</p>
                <ul style="margin: 10px 0; padding-left: 20px;">
                    <li>User management (create, edit, delete users)</li>
                    <li>System settings and configuration</li>
                    <li>View complete system statistics</li>
                </ul>
            <?php elseif ($userRole === 'teacher'): ?>
                <p>As a teacher, you can:</p>
                <ul style="margin: 10px 0; padding-left: 20px;">
                    <li>Manage your classes and students</li>
                    <li>Record and manage student grades</li>
                    <li>View your personal profile</li>
                    <li>Access system settings</li>
                </ul>
            <?php elseif ($userRole === 'student'): ?>
                <p>As a student, you can:</p>
                <ul style="margin: 10px 0; padding-left: 20px;">
                    <li>View your grades and academic performance</li>
                    <li>Check your attendance records</li>
                    <li>Manage your profile information</li>
                    <li>Update your account settings</li>
                </ul>
            <?php endif; ?>

            <p style="margin-top: 15px; font-size: 14px; color: #666;">
                Use the sidebar navigation to access features available for your role.
            </p>
        </div>
    </div>
</div>