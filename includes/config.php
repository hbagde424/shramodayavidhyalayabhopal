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
define('SITE_NAME', 'श्रमोदय आवासीय विद्यालय भोपाल');
define('SITE_TAGLINE', 'गुणवत्तापूर्ण शिक्षा | सुरक्षित परिसर | उज्जवल भविष्य');
// Dynamic SITE_URL (handles HTTP/HTTPS & Localhost/Live automatically)
$protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https')) ? "https" : "http";
$host = $_SERVER['HTTP_HOST'];
$dir = dirname($_SERVER['SCRIPT_NAME']);
$dir = str_replace('\\', '/', $dir); // Windows compatibility
if ($dir === '/') { $dir = ''; }

// If we are in admin folder or includes folder, we need to strip that from the path
$dir = preg_replace('#/(admin|includes)$#', '', $dir);

define('SITE_URL', $protocol . '://' . $host . $dir);

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
