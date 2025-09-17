<?php
session_start();
require_once "db.php";
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') { header("Location: user.html"); exit; }
if (!isset($_GET['id'])) header("Location: admin.php");
$id = (int)$_GET['id'];
$stmt = $conn->prepare("DELETE FROM users WHERE id=?");
$stmt->bind_param("i",$id);
$stmt->execute();
$stmt->close();
header("Location: admin.php");
exit;
