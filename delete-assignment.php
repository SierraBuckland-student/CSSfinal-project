<?php
require_once 'header.php';
require_once 'auth.php';
$title = 'Delete Assignments';

//read the selected musician id from the value at the end of the url
$homeworkID = $_GET['homeworkID'];

//try catch block for code accessing database / making db changes
try {
    //connect to db
    $db = new PDO('mysql:host=172.31.22.43;dbname=Sierra200366619', 'Sierra200366619', 'Yb4mYQm6V2');

    //set up sql command to delete selected record
    $sql = "DELETE FROM homework WHERE homeworkID = :homeworkID";

    //bind parameter to pass in the selected id
    $cmd = $db->prepare($sql);
    $cmd->bindParam( ':homeworkID', $homeworkID, PDO::PARAM_INT);

    //execute sql command
    $cmd->execute();

    //disconnect
    $db = null;

    //take user back to updated list
    //only add redirect once we know above code is worker otherwise we will not get the error message
    header('location:homework-table.php');
}
catch (Exception $e) {
    header('location:error.php');
    exit();
}

?>
</body>
</html>
