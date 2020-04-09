<?php
$db = new PDO('mysql:host=172.31.22.43;dbname=Sierra200366619', 'Sierra200366619', 'Yb4mYQm6V2');
//PDO error mode attribute to raise a PDOException that tells you what went wrong when it goes wrong gotten from https://www.php.net/manual/en/pdo.setattribute.php
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
