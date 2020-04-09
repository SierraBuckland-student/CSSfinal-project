<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Logout Page</title>
</head>
<body>
<?php
// allow user to end session/logout and go back to log in page
session_start();
session_unset(); //clear session variables
session_destroy(); //fully clear session

header('location:login.php');
?>
</body>
</html>
