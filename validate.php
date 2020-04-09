<?php
$username = $_POST['username'];
$password = $_POST['password'];

try {
    //db connection
    $db = new PDO('mysql:host=172.31.22.43;dbname=Sierra200366619', 'Sierra200366619', 'Yb4mYQm6V2');

    //sql command for users table
    $sql = "SELECT userId, password FROM users WHERE username = :username";

    //bind username param
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
    $cmd->execute();

    $user = $cmd->fetch();

    //verify password and username match and are correct
    if (!password_verify($password, $user['password'])) {
        /* echo 'Invalid Login';
        exit(); */
        header('location:error-page.php'); // redirect to error page
    }
    else {
        session_start();
        $_SESSION['userId'] = $user['userId']; // store user's id from query in new variable $_SESSION
        $_SESSION['username'] = $username;
        header('location:homework-table.php'); // redirect to homework table
    }

    $db = null;

}
catch (Exception $e) {
    header('location:error-page.php');
    exit();
}
?>
