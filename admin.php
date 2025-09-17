<?php
session_start();
require_once "db.php";

// Only allow admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: user.php?error=Access+denied");
    exit;
}

// Handle logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: user.php");
    exit;
}

// Delete user
if (isset($_GET['delete_user'])) {
    $id = intval($_GET['delete_user']);
    $conn->query("DELETE FROM users WHERE id = $id");
    header("Location: admin.php");
    exit;
}

// Delete contact message
if (isset($_GET['delete_message'])) {
    $id = intval($_GET['delete_message']);
    $conn->query("DELETE FROM contact_messages WHERE id = $id");
    header("Location: admin.php");
    exit;
}

// Fetch all users
$usersResult = $conn->query("SELECT id, name, email, role, created_at FROM users ORDER BY created_at DESC");

// Fetch all contact messages
$messagesResult = $conn->query("SELECT id, name, email, subject, message, created_at FROM contact_messages ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Dashboard</title>
</head>
<body>

<h1>Admin Dashboard</h1>

<!-- Buttons -->
<form action="index.html" style="display:inline;">
    <button type="submit">Visit Website</button>
</form>
<form action="admin.php" method="get" style="display:inline;">
    <button type="submit" name="logout" value="1">Logout</button>
</form>

<h2>Users</h2>
<table border="1" cellpadding="5" cellspacing="0">
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Role</th>
    <th>Signup Date</th>
    <th>Actions</th>
</tr>
<?php while($user = $usersResult->fetch_assoc()): ?>
<tr>
    <td><?php echo htmlspecialchars($user['id']); ?></td>
    <td><?php echo htmlspecialchars($user['name']); ?></td>
    <td><?php echo htmlspecialchars($user['email']); ?></td>
    <td><?php echo htmlspecialchars($user['role']); ?></td>
    <td><?php echo htmlspecialchars($user['created_at']); ?></td>
    <td>
        <a href="edit_user.php?id=<?php echo $user['id']; ?>">Edit</a> | 
        <a href="admin.php?delete_user=<?php echo $user['id']; ?>" onclick="return confirm('Delete this user?');">Delete</a>
    </td>
</tr>
<?php endwhile; ?>
</table>

<h2>Contact Messages</h2>
<table border="1" cellpadding="5" cellspacing="0">
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Subject</th>
    <th>Message</th>
    <th>Submitted At</th>
    <th>Actions</th>
</tr>
<?php while($msg = $messagesResult->fetch_assoc()): ?>
<tr>
    <td><?php echo htmlspecialchars($msg['id']); ?></td>
    <td><?php echo htmlspecialchars($msg['name']); ?></td>
    <td><?php echo htmlspecialchars($msg['email']); ?></td>
    <td><?php echo htmlspecialchars($msg['subject']); ?></td>
    <td><?php echo htmlspecialchars($msg['message']); ?></td>
    <td><?php echo htmlspecialchars($msg['created_at']); ?></td>
    <td>
        <a href="admin.php?delete_message=<?php echo $msg['id']; ?>" onclick="return confirm('Delete this message?');">Delete</a>
    </td>
</tr>
<?php endwhile; ?>
</table>
</body>
</html>

