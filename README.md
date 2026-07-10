# School Management System

A comprehensive web-based management system for secondary schools built with PHP, HTML, and CSS.

## Features

### User Management
- User registration and login
- Role-based access control (Admin, Teacher, Student)
- User profile management
- User listing and administration
- Password hashing and security
- Account activation/deactivation

### Dashboard
- Quick statistics overview
- User count by role
- System information

### User Roles
- **Admin**: Full system access, user management
- **Teacher**: Can manage classes and grades
- **Student**: Can view grades and attendance

## Installation

### Prerequisites
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache/Nginx web server

### Setup Instructions

1. **Clone the repository**
   ```bash
   git clone https://github.com/Msambwa-Yohanis/school-management-system.git
   cd school-management-system
   ```

2. **Create a MySQL database**
   ```sql
   CREATE DATABASE school_management_system;
   ```

3. **Configure database connection**
   - Edit `config/database.php`
   - Update database credentials:
     ```php
     $host = 'localhost';
     $db_name = 'school_management_system';
     $user = 'root';
     $password = '';
     ```

4. **Initialize the database**
   - Run `config/init.php` in your browser or via command line:
     ```bash
     php config/init.php
     ```

5. **Start the development server**
   ```bash
   php -S localhost:8000
   ```

6. **Access the application**
   - Open your browser and go to `http://localhost:8000`
   - Default login page will appear

## Project Structure

```
school-management-system/
├── assets/
│   └── css/
│       ├── style.css          # Main stylesheet
│       ├── auth.css           # Authentication pages styles
│       └── dashboard.css      # Dashboard styles
├── config/
│   ├── database.php           # Database configuration
│   └── init.php               # Database initialization
├── pages/
│   ├── dashboard.php          # Dashboard page
│   ├── users.php              # User management
│   ├── profile.php            # User profile
│   └── settings.php           # System settings
├── index.php                  # Main dashboard
├── login.php                  # Login page
├── register.php               # Registration page
├── logout.php                 # Logout handler
└── README.md                  # This file
```

## Usage

### First Time Setup

1. **Register a new account**
   - Go to the registration page
   - Fill in username, email, password
   - Select your role (Admin, Teacher, or Student)
   - Click Register

2. **Login**
   - Use your registered credentials
   - Select appropriate role

3. **Navigate the system**
   - Use the sidebar menu to access different features
   - View dashboard for quick statistics
   - Manage users (Admin only)
   - Update your profile

## Database Schema

### Users Table
```sql
CREATE TABLE users (
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
```

## Security Features

- Password hashing using bcrypt (PASSWORD_BCRYPT)
- SQL prepared statements to prevent SQL injection
- Session-based authentication
- Role-based access control
- Input validation and sanitization

## Future Enhancements

- [ ] Student Management
- [ ] Class Management
- [ ] Attendance Tracking
- [ ] Grade Management
- [ ] Exam Management
- [ ] Finance Module
- [ ] Library Management
- [ ] Parent Portal
- [ ] Email Notifications
- [ ] SMS Notifications
- [ ] Advanced Reporting

## Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## License

This project is licensed under the MIT License - see the LICENSE file for details.

## Support

For support, email: support@schoolmanagementsystem.com

## Author

Msambwa-Yohanis
