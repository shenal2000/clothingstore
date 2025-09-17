<?php
session_start();
include "db.php";

if (!isset($_SESSION['user'])) {
    header("Location: index.html"); 
    exit();
}

$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Profile</title>
  <link rel="stylesheet" href="style.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f4f4;
      text-align: center;
      margin: 0;
      padding: 0;
    }
    .profile-box {
      background: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.2);
      width: 350px;
      margin: 100px auto;
    }
    .profile-box h2 {
      margin-bottom: 20px;
      color: #333;
    }
    .profile-box p {
      font-size: 16px;
      margin: 10px 0;
      color: #555;
    }
    .logout-btn {
      display: inline-block;
      margin-top: 20px;
      padding: 10px 20px;
      background: #252525;
      color: white;
      border: none;
      border-radius: 5px;
      font-weight: bold;
      text-decoration: none;
    }
    .logout-btn:hover {
      background: #ffa600;
    }
  </style>
</head>
<body>

<section id="header">
    <h1>MoveGear</h1>
    <div>
        <ul id="navbar">
            <li><a href="index.html">Home</a></li>
            <li><a href="shop.html">Shop</a></li>
            <li><a href="blog.html">Blog</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="contact.html">Contact us</a></li>
            <li><a href="cart.html"><i class="fa-solid fa-suitcase"></i></a></li>
            <li><a class="active" href="profile.php"><i class="fa-solid fa-user"></i></a></li>
        </ul>
    </div>
</section>
<br><br>
<div class="profile-box">
    <h2>User Profile</h2>
    <p><strong>Name:</strong> <?php echo htmlspecialchars($user['name']); ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
    <a href="logout.php" class="logout-btn">Logout</a>
</div>

<footer class="section-p1">
    <div class="col">
        <h4>Contact</h4>
        <p>Address: NSBM Green University</p>
        <p>Phone:0123456789 / +9409876543</p>
        <p>Hours:9.00am -8.00pm, Mon- Sat</p> <br>
       <div class="follow">
          <h4>Follow us</h4>
            <div class="icon">
                <i class="fab fa-facebook-f"></i>
                <i class="fab fa-twitter"></i>
                <i class="fab fa-instagram"></i>
                <i class="fab fa-pinterest-p"></i>
                <i class="fab fa-youtube"></i>
            </div> 
        </div> 
    </div>
    <div class="col">
      <h4>About</h4>
      <a href="#">About us</a>
      <a href="#">Delivery Information</a>
      <a href="#">Privacy Policy</a>
      <a href="#">Terms & COnditions</a>
      <a href="#">Contact Us</a>
    </div>
        <div class="col">
      <h4>My Account</h4>
      <a href="#">Sign in</a>
      <a href="#">View Cart</a>
      <a href="#">Favourite</a>
      <a href="#">Track My Order</a>
      <a href="#">Help</a>
    </div>
    <div>
      <h1>MoveGear</h1>
    </div>

</footer>

<script src="script.js"></script>
<script src="https://kit.fontawesome.com/e417e634d8.js" crossorigin="anonymous"></script>
</body>
</html>



