<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Karla&family=Lora&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css" />
</head>
<body>
  <!-- nav menu begin -->
  <!-- Load icon library to show a condensed menu bars on small screens -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="topnav" id="myTopnav">
  <a href="index.php">Homework Tracker</a>

  <a href="homework-table.php">View All</a>
  <div class="topnav-right">
      <?php
      if (empty($_SESSION['userId'])) {
          echo '<a href="register.php">Register</a>
                  <a href="login.php">Login</a>';
      }
      else {
          echo '<a href="homework-tracker.php">Add New</a>
                  <a href="#">' . $_SESSION['username'] . '</a>
                  <a href="logout.php">Logout</a>';
      }

      ?>
      <a href="javascript:void(0);" class="icon" onclick="myFunction()">
      <i class="fa fa-bars"></i>
    </a>
  </div>
</div>

<!--  TODO: move to scripts doc -->
<script>
/* Toggle between adding and removing the "responsive" class to topnav when the user clicks on the icon */
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}
</script>
