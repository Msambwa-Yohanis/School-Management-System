<?php
require_once 'config/database.php';
require_once 'config/auth_middleware.php';

// Only teachers can access this page
requireRole('teacher', 'Only teachers can manage classes.');
?>

<div class="classes-header">
    <h2>My Classes</h2>
    <p style="color: #666; font-size: 14px;">Manage your classes and students</p>
</div>

<div class="card">
    <div class="card-body">
        <div style="text-align: center; padding: 40px; color: #999;">
            <p style="font-size: 48px; margin: 0;">📚</p>
            <p>No classes assigned yet.</p>
            <p style="font-size: 14px;">Your classes will appear here once they are assigned by the administrator.</p>
        </div>
    </div>
</div>

<div class="card" style="margin-top: 20px;">
    <div class="card-header">
        <h3>Class Management Features Coming Soon</h3>
    </div>
    <div class="card-body">
        <ul style="padding-left: 20px;">
            <li>View assigned classes</li>
            <li>Manage student enrollment</li>
            <li>Track attendance</li>
            <li>Record grades and performance</li>
            <li>Create class announcements</li>
        </ul>
    </div>
</div>