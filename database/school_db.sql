-- =========================================================
--  SARVODAYA AWASIYA VIDYALAYA - Database Schema
--  Import this file in phpMyAdmin / MySQL before running site
-- =========================================================

CREATE DATABASE IF NOT EXISTS school_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE school_db;

-- ---------------------------------------------------------
-- Admin users table
-- ---------------------------------------------------------
CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    full_name VARCHAR(100) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Default admin -> username: admin  password: admin123
-- (password is hashed with PHP password_hash - bcrypt)
INSERT INTO admins (username, password, full_name) VALUES
('admin', '$2y$10$0m/POvbNw.CapUW4.YxA9eyV2iTy1fZEj7p44qF37KrYLYdHzvptO', 'Site Administrator');
-- NOTE: hash above corresponds to password "admin123"

-- ---------------------------------------------------------
-- Notices / Important Information
-- ---------------------------------------------------------
CREATE TABLE IF NOT EXISTS notices (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(500) NOT NULL,
    file_link VARCHAR(255) DEFAULT NULL,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO notices (title, file_link) VALUES
('कक्षा 6वीं से 12वीं तक रिक्त सीटों पर प्रवेश हेतु आवेदन आमंत्रित I', NULL),
('प्रवेश संबंधी जानकारी हेतु कार्यालय समय में संपर्क करें I', NULL);

-- ---------------------------------------------------------
-- News (Important News / Announcements)
-- ---------------------------------------------------------
CREATE TABLE IF NOT EXISTS news (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(300) NOT NULL,
    description TEXT,
    image VARCHAR(255) DEFAULT NULL,
    news_date DATE NOT NULL,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO news (title, description, news_date) VALUES
('विद्यालय में नवीन शिक्षण सत्र प्रारंभ', 'नवीन शिक्षण सत्र हर्षोल्लास के साथ प्रारंभ हुआ।', CURDATE());

-- ---------------------------------------------------------
-- Events (School Events)
-- ---------------------------------------------------------
CREATE TABLE IF NOT EXISTS events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(300) NOT NULL,
    description TEXT,
    image VARCHAR(255) DEFAULT NULL,
    event_date DATE NOT NULL,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO events (title, description, event_date) VALUES
('वार्षिक खेल महोत्सव', 'विद्यालय में वार्षिक खेल महोत्सव का आयोजन किया गया।', CURDATE());

-- ---------------------------------------------------------
-- Gallery
-- ---------------------------------------------------------
CREATE TABLE IF NOT EXISTS gallery (
    id INT AUTO_INCREMENT PRIMARY KEY,
    caption VARCHAR(300) DEFAULT NULL,
    image VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ---------------------------------------------------------
-- Contact / Enquiry messages sent from public contact form
-- ---------------------------------------------------------
CREATE TABLE IF NOT EXISTS enquiries (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL,
    phone VARCHAR(20) DEFAULT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
