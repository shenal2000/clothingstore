<?php
// db.php
$host = "localhost";
$user = "root";
$pass = "SHEnal2000";        
$dbname = "user_system";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("DB Connection failed: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");
?>
