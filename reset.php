<?php
require_once __DIR__ . '/includes/config.php';

$username = 'admin';
$password = 'admin123';
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Check if admin exists
$result = mysqli_query($conn, "SELECT id FROM admins WHERE username = '$username'");

if (mysqli_num_rows($result) > 0) {
    // Update existing admin
    $query = "UPDATE admins SET password = '$hashed_password' WHERE username = '$username'";
    if (mysqli_query($conn, $query)) {
        echo "<h1>Success!</h1><p>Admin password has been reset to: <strong>admin123</strong></p>";
        echo "<p><a href='admin/login.php'>Click here to login</a></p>";
    } else {
        echo "Error updating password: " . mysqli_error($conn);
    }
} else {
    // Insert new admin if deleted
    $query = "INSERT INTO admins (username, password, full_name) VALUES ('$username', '$hashed_password', 'Site Administrator')";
    if (mysqli_query($conn, $query)) {
        echo "<h1>Success!</h1><p>Admin account created with password: <strong>admin123</strong></p>";
        echo "<p><a href='admin/login.php'>Click here to login</a></p>";
    } else {
        echo "Error creating admin: " . mysqli_error($conn);
    }
}
?>
