<?php
require_once "db.php";
$name = "Admin";
$email = "admin@example.com";
$pass = password_hash("Admin12345", PASSWORD_DEFAULT);
$role = "admin";
$stmt = $conn->prepare("INSERT INTO users (name,email,password,role) VALUES (?,?,?,?)");
$stmt->bind_param("ssss",$name,$email,$pass,$role);
if ($stmt->execute()) echo "Admin created: $email / Admin12345";
else echo "Error: " . $conn->error;
$stmt->close();
