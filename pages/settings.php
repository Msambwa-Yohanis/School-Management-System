<?php
require_once 'config/database.php';
require_once 'config/auth_middleware.php';

// All authenticated users can access settings
requireLogin();
?>

<div class="settings-header">
    <h2>Settings</h2>
    <p style="color: #666; font-size: 14px;">Manage your account and preferences</p>
</div>

<div class="card">
    <div class="card-header">
        <h3>Account Settings</h3>
    </div>
    <div class="card-body">
        <div class="settings-group">
            <h4>Password</h4>
            <p><a href="pages/change_password.php" class="btn btn-secondary">Change Password</a></p>
        </div>

        <div class="settings-group" style="margin-top: 20px;">
            <h4>Profile</h4>
            <p><a href="index.php?page=profile" class="btn btn-secondary">Edit Profile</a></p>
        </div>
    </div>
</div>

<div class="card" style="margin-top: 20px;">
    <div class="card-header">
        <h3>Notification Settings</h3>
    </div>
    <div class="card-body">
        <div class="settings-group">
            <label>
                <input type="checkbox" checked>
                Email Notifications
            </label>
        </div>

        <div class="settings-group" style="margin-top: 15px;">
            <label>
                <input type="checkbox" checked>
                SMS Notifications
            </label>
        </div>
    </div>
</div>

<div class="card" style="margin-top: 20px;">
    <div class="card-header">
        <h3>Privacy Settings</h3>
    </div>
    <div class="card-body">
        <div class="settings-group">
            <label>
                <input type="checkbox" checked>
                Make profile public
            </label>
        </div>
    </div>
</div>

<style>
    .settings-group {
        margin-bottom: 15px;
    }

    .settings-group h4 {
        margin: 0 0 10px 0;
        color: #333;
        font-size: 14px;
        font-weight: bold;
    }

    .settings-group label {
        display: flex;
        align-items: center;
        cursor: pointer;
        margin: 8px 0;
    }

    .settings-group input[type="checkbox"] {
        margin-right: 10px;
        cursor: pointer;
    }
</style>