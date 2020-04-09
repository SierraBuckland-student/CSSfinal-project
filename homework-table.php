<?php
$title = 'All Assignments';

//use the require_once function to embed the shared header here
require_once('header.php');
?>
    <main class="container">
        <h1>Homework Due:</h1>
<?php

if (!empty($_SESSION['userId'])) {
    echo '<div class="addNewLink"><a href="homework-tracker.php">Add a new assignment</a></div>';
}

//try {
    $db = new PDO('mysql:host=172.31.22.43;dbname=Sierra200366619', 'Sierra200366619', 'Yb4mYQm6V2');


    $sql = "SELECT * FROM homework"; //SQL read all records from homework db
    $cmd = $db->prepare($sql); //initializing Command variable
    $cmd->execute(); //using command variable to run above query
    $homework = $cmd->fetchAll(); //fetchAll() method from week 3 to store the data into variable = $homework.

    // html table
    echo '<table class="table">
            <thead id="tableHead">
                <tr>
                    <th scope="col">Assignment:</th>
                    <th scope="col">Subject:</th>
                    <th scope="col">Due Date:</th>
                    <th scope="col">Percent of Overall Grade:</th>
                    <th scope="col">Submit Online:</th>

                    <th scope="col">Screenshot:</th>
            ';

    //  only show delete heading if user is authenticated
       if (!empty($_SESSION['userId'])) {
           echo '<th scope="col">Delete Task:</th>';
       }

    echo '</tr></thead>';

    // fills out table rows with user created records
    foreach ($homework as $value) {
        echo '<tr><td>';
            if (!empty($_SESSION['userId'])) {
                echo '<a href="homework-tracker.php?homeworkID=' . $value['homeworkID'] . '">' . $value['assignment'] . '</a>';
            }
            else {
                echo $value['assignment'];
            }

        echo '</td>
              <td>' . $value['subject'] . '</td>
              <td>' . $value['dueDate'] . '</td>
              <td>' . $value['percentGrade'] . '</td>
              <td>' . $value['submit'] . '</td>
            <td>';

        if (!empty($value['photo'])) {
            echo '<img src="img/homework/' . $value['photo'] . '" alt="Assignment Photo" class="thumbnail" />';
        }
        echo '</td>';


    //    only allow deleting for auth. users
        if (!empty($_SESSION['userId'])) {
            echo '<td><a class="text-danger" href="delete-assignment.php?homeworkID=' . $value['homeworkID'] . '"
                    onclick="return confirmDelete();">Delete</a></td>
                </tr>';
        }
    }
    echo '</table>';

    $db = null;

//} catch (Exception $e) {
//    header('location:error-page.php');
//    exit();
//}

echo '</main>';

require_once('footer.php');
?>
