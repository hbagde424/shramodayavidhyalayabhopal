<?php
/**
 * ==================================================
 *  DATABASE CONFIGURATION
 *  Edit these values according to your hosting / XAMPP setup
 * ==================================================
 */
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'school_db');

// Site base settings (edit for your school)
define('SITE_NAME', 'सर्वोदय आवासीय विद्यालय');
define('SITE_TAGLINE', 'गुणवत्तापूर्ण शिक्षा | सुरक्षित परिसर | उज्जवल भविष्य');
define('SITE_URL', 'http://localhost/school_website');

// Start session everywhere
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Create connection
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (!$conn) {
    die('डेटाबेस कनेक्शन में त्रुटि: ' . mysqli_connect_error());
}

mysqli_set_charset($conn, 'utf8mb4');

// Simple helper to escape output
function h($str) {
    return htmlspecialchars($str ?? '', ENT_QUOTES, 'UTF-8');
}
