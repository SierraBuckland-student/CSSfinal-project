<?php
// set the variable title
$title = 'Save Assignment';

require_once('header.php');
require_once 'auth.php';

//open content container
echo '<main class="container">';

//save inputs
$homeworkID = $_POST['homeworkID'];
//form variables
$assignment = $_POST['assignment'];
$subject = $_POST['subject'];
$dueDate = $_POST['dueDate'];
$percentGrade = $_POST['percentGrade'];
//submit default is false, if user checks it, it is true
$submit = false;

if (!empty($_POST['submit'])) {
    $submit = true;
}

$photo = $_FILES['photo'];

if (empty($photo['name'])) {
    $photo = null;
}

// validate input
$valid = true;

if (empty($assignment)) {
    echo 'Assignment name is required<br />';
    $valid = false;
}

elseif (strlen($assignment) > 50) {
    echo 'Assignment name must be 50 characters or less<br />';
    $valid = false;
}

//POSSIBLY COMMENT THIS OUT
//only need this if "true" word value does not convert to boolean
if ($submit == "true") {
    $submit = true;
}
    else {
        $submit = false;
    }

//photo upload check
if (!empty($photo['name'])) {
    $tmp_name = $photo['tmp_name'];
    $type = mime_content_type($tmp_name);

    if ($type != 'image/jpeg' && $type != 'image/png') {
        echo 'Please upload a .jpg or .png file<br />';
        $valid = false;
    }
    else {
        // use the session to uniquely name the uploaded file & save to the img/musicians
        session_start();
        $photo = session_id() . '-' . $photo['name'];
        move_uploaded_file($tmp_name, "img/homework/$photo");
    }
}


// execute if the form is valid
if ($valid == true) {
    //try catch block for save task code
    try {
        //db connection
        $db = new PDO('mysql:host=172.31.22.43;dbname=Sierra200366619', 'Sierra200366619', 'Yb4mYQm6V2');

        //field names for users info
        echo "Assignment: $assignment<br />Subject: $subject<br />Due Date: $dueDate<br />Percent of Overall Grade: $percentGrade<br />Submit: $submit<br />Photo: $photo";

        if (empty($homeworkID)) {
            //inserts values into SQL db
            $sql = "INSERT INTO homework (assignment, subject, dueDate, percentGrade, submit, photo) VALUES (:assignment, :subject, :dueDate, :percentGrade, :submit, :photo)";
        }

        else if (empty($photo)) {
        $sql = "UPDATE homework SET assignment = :assignment, subject = :subject, dueDate = :dueDate, percentGrade = :percentGrade,
            submit = :submit WHERE homeworkID = :homeworkID";
        }

        else {
            $sql = "UPDATE homework SET assignment = :assignment, subject = :subject, dueDate = :dueDate, percentGrade = :percentGrade,
            submit = :submit, photo = :photo WHERE homeworkID = :homeworkID";
            //the where part of this is very important so only the one specific record is updated not ALL of them
        }

        $cmd = $db->prepare($sql);

        //command variable to fill in the right parameter values
        $cmd->bindParam(':assignment', $assignment, PDO::PARAM_STR, 50);
        $cmd->bindParam(':subject', $subject, PDO::PARAM_STR, 25);
        $cmd->bindParam(':dueDate', $dueDate, PDO::PARAM_STR);
        $cmd->bindParam(':percentGrade', $percentGrade, PDO::PARAM_INT);
        $cmd->bindParam(':submit', $submit, PDO::PARAM_BOOL);


// A photo OR NO homeworkID
        if (!empty($photo)||(empty($homeworkID))) {
            $cmd->bindParam(':photo', $photo, PDO::PARAM_STR, 100);
        }

// homeworkID not empty (if homework id was not empty and trying to save a photo it would still save photo because of above if statement)
        if (!empty($homeworkID)) {
            $cmd->bindParam(':homeworkID', $homeworkID, PDO::PARAM_INT);
        }


        $cmd->execute(); //saves the above values to the db

        $db = null;
        echo '<p>Assignment Saved!</p>';
        header('location:homework-table.php');

    } catch (Exception $e) {
        header('location:error-page.php');
        exit();
    }
}
?>

<a href="homework-table.php">Show all assignments</a>
    </main>

<?php
//embed footer
require_once('footer.php');
?>
