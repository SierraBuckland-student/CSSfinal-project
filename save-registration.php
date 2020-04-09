<?php
//Get form inputs
$username = $_POST['username'];
$password = $_POST['password'];
$confirm = $_POST['confirm'];
$valid = true;

// Validate inputs: required + matching passwords
if (empty($username)) {
    echo 'Username is required<br />';
    $valid = false;
}

if (empty($password)) {
    echo 'Password is required<br />';
    $valid = false;
}

if ($password != $confirm) {
    echo 'Passwords do not match';
    $valid = false;
}

if ($valid) {
    //db connection
    $db = new PDO('mysql:host=172.31.22.43;dbname=Sierra200366619', 'Sierra200366619', 'Yb4mYQm6V2');

    //check if username exists already
    $sql = "SELECT * FROM users WHERE username = :username";
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
    $cmd->execute();
    $user = $cmd->fetch();

    // if a record with a matching username is found execution is stopped and doesn't insert
    if (!empty($user)) {
        echo 'This username already exists';
        exit(); // stops execution
    }

    $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
    $cmd = $db->prepare($sql);

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT); //hash the password before saving as per last in person class

    //Bind param and execute insert
    $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
    $cmd->bindParam(':password', $hashedPassword, PDO::PARAM_STR, 255);
    $cmd->execute();

    $db = null;
    header('location:login.php');

}

?>
