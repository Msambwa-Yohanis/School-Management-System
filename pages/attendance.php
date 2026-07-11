<?php
require_once 'config/database.php';
require_once 'config/auth_middleware.php';

// Only students can access this page
requireRole('student', 'Only students can view attendance.');
?>

<div class="attendance-header">
    <h2>My Attendance</h2>
    <p style="color: #666; font-size: 14px;">View your attendance records</p>
</div>

<div class="card">
    <div class="card-body">
        <div style="text-align: center; padding: 40px; color: #999;">
            <p style="font-size: 48px; margin: 0;">✓</p>
            <p>No attendance records available yet.</p>
            <p style="font-size: 14px;">Your attendance will be tracked and displayed here.</p>
        </div>
    </div>
</div>

<div class="card" style="margin-top: 20px;">
    <div class="card-header">
        <h3>Attendance Features</h3>
    </div>
    <div class="card-body">
        <ul style="padding-left: 20px;">
            <li>View daily attendance status</li>
            <li>Check attendance percentage</li>
            <li>View absence details</li>
            <li>Download attendance report</li>
            <li>See attendance trends</li>
        </ul>
    </div>
</div>