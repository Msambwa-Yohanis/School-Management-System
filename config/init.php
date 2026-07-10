<?php
require_once 'database.php';

// Create tables if they don't exist
try {
    $sql = "
    CREATE TABLE IF NOT EXISTS users (
        id INT PRIMARY KEY AUTO_INCREMENT,
        username VARCHAR(50) UNIQUE NOT NULL,
        email VARCHAR(100) UNIQUE NOT NULL,
        password VARCHAR(255) NOT NULL,
        role ENUM('admin', 'teacher', 'student') DEFAULT 'student',
        first_name VARCHAR(100),
        last_name VARCHAR(100),
        phone VARCHAR(20),
        address TEXT,
        city VARCHAR(50),
        state VARCHAR(50),
        postal_code VARCHAR(10),
        date_of_birth DATE,
        gender ENUM('Male', 'Female', 'Other'),
        profile_picture VARCHAR(255),
        is_active TINYINT(1) DEFAULT 1,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );
    ";
    $pdo->exec($sql);
    echo "Users table created successfully.\n";
} catch (PDOException $e) {
    echo "Error creating users table: " . $e->getMessage() . "\n";
}

// Check if tables exist
echo "Database initialization complete.\n";
?>
