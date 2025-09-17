<?php
session_start();
require_once "db.php"; // Your database connection

if(isset($_POST['submit'])) {
    $name    = trim($_POST['name']);
    $email   = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);

    // Simple validation
    if(!$name || !$email || !$subject || !$message || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Please fill all fields correctly.";
        header("Location: contact.html");
        exit;
    }

    // Insert into database
    $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, subject, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $subject, $message);

    if($stmt->execute()) {
        $_SESSION['success'] = "Your message has been sent successfully!";
    } else {
        $_SESSION['error'] = "Failed to send your message. Please try again.";
    }

    $stmt->close();
    $conn->close();

    header("Location: contact.html");
    exit;
}
?>
