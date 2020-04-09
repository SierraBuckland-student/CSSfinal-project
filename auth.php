<?php
// authentication check
if (empty($_SESSION['userId'])) {
    header('location:login.php');
    exit();
}

?>
