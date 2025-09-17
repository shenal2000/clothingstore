<?php
session_start();
require_once "db.php";

function go($url){
    header("Location: $url");
    exit;
}

// ----------------- SIGNUP -----------------
if (isset($_POST['signup'])) {
    $name  = trim($_POST['name']);
    $email = trim($_POST['email']);
    $pass  = $_POST['password'];

    if (!$name || !filter_var($email, FILTER_VALIDATE_EMAIL) || !$pass) {
        go("user.html?error=Invalid+input");
    }

    // Check if email exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->close();
        go("user.html?error=Email+already+registered");
    }
    $stmt->close();

    // Insert new user
    $hash = password_hash($pass, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $hash);
    if ($stmt->execute()) {
        $_SESSION['user'] = [
            'id' => $stmt->insert_id,
            'name' => $name,
            'email' => $email,
            'role' => 'user'
        ];
        $stmt->close();
        go("profile.php");
    } else {
        $stmt->close();
        go("user.html?error=Signup+failed");
    }
}

// ----------------- LOGIN -----------------
if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $pass  = $_POST['password'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !$pass) {
        go("user.html?error=Invalid+input");
    }

    $stmt = $conn->prepare("SELECT id, name, password, role FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res && $res->num_rows === 1) {
        $row = $res->fetch_assoc();

        if (password_verify($pass, $row['password'])) {
            $_SESSION['user'] = [
                'id' => $row['id'],
                'name' => $row['name'],
                'email' => $email,
                'role' => $row['role']
            ];
            $stmt->close();
            if ($row['role'] === 'admin') {
                go("admin.php");
            } else {
                go("profile.php");
            }
        } else {
            $stmt->close();
            go("user.html?error=Invalid+password");
        }
    } else {
        $stmt->close();
        go("user.html?error=Email+not+found.+Please+signup+first");
    }
}

