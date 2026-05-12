-- ============================================
--  SHOP MANAGEMENT SYSTEM - Database Setup
--  Paste this into phpMyAdmin > SQL tab > Go
-- ============================================

CREATE DATABASE IF NOT EXISTS shop_management;
USE shop_management;

-- Admins table (for login/register)
CREATE TABLE IF NOT EXISTS admins (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    username   VARCHAR(50)  NOT NULL UNIQUE,
    password   VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Employees table
CREATE TABLE IF NOT EXISTS employees (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    name       VARCHAR(100) NOT NULL,
    contact_no VARCHAR(20)  NOT NULL,
    username   VARCHAR(50)  NOT NULL UNIQUE,
    password   VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Default admin: username = admin | password = admin123
INSERT INTO admins (username, password) VALUES ('admin', MD5('admin123'));
