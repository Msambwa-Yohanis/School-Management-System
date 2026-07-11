<?php
require_once 'config/database.php';
require_once 'config/auth_middleware.php';
require_once 'config/roles.php';

// Both teachers and students can access this page
requireRole(['teacher', 'student'], 'Only teachers and students can access grades.');

$userRole = $_SESSION['role'];
?>

<div class="grades-header">
    <h2><?php echo ($userRole === 'teacher') ? 'Grade Management' : 'My Grades'; ?></h2>
    <p style="color: #666; font-size: 14px;">
        <?php echo ($userRole === 'teacher') ? 'Manage student grades and performance' : 'View your academic grades and performance'; ?>
    </p>
</div>

<?php if ($userRole === 'teacher'): ?>
    <!-- Teacher Grades Management -->
    <div class="card">
        <div class="card-body">
            <div style="text-align: center; padding: 40px; color: #999;">
                <p style="font-size: 48px; margin: 0;">📝</p>
                <p>No students assigned to your classes yet.</p>
                <p style="font-size: 14px;">Once you have classes assigned, you'll be able to manage student grades here.</p>
            </div>
        </div>
    </div>

<?php else: ?>
    <!-- Student Grades View -->
    <div class="card">
        <div class="card-body">
            <div style="text-align: center; padding: 40px; color: #999;">
                <p style="font-size: 48px; margin: 0;">📊</p>
                <p>No grades available yet.</p>
                <p style="font-size: 14px;">Your grades will appear here as teachers submit them.</p>
            </div>
        </div>
    </div>

<?php endif; ?>

<div class="card" style="margin-top: 20px;">
    <div class="card-header">
        <h3>Coming Soon</h3>
    </div>
    <div class="card-body">
        <?php if ($userRole === 'teacher'): ?>
            <ul style="padding-left: 20px;">
                <li>Record student grades</li>
                <li>View grade statistics</li>
                <li>Generate grade reports</li>
                <li>Track student performance</li>
                <li>Submit semester grades</li>
            </ul>
        <?php else: ?>
            <ul style="padding-left: 20px;">
                <li>View all your grades</li>
                <li>Check grade breakdown by subject</li>
                <li>View performance trends</li>
                <li>Download grade reports</li>
            </ul>
        <?php endif; ?>
    </div>
</div>