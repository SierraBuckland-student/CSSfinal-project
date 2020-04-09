<?php
// set the page title
$title = 'Track homework';

//embed header
require_once('header.php');

// auth check embedded
require_once 'auth.php';

//initialize variables
$homeworkID = null;
$assignment = null;
$subject = null;
$dueDate = null;
$percentGrade = null;
$submit = null;
$checked = null;
$photo = null;

//check homeworkID in the url string
if (!empty($_GET['homeworkID'])) {
    //if there is a homeworkID, query the db for the details on this record so we can populate the form
    $homeworkID = $_GET['homeworkID'];

    try {

        $db = new PDO('mysql:host=172.31.22.43;dbname=Sierra200366619', 'Sierra200366619', 'Yb4mYQm6V2');
        $sql = "SELECT * FROM homework WHERE homeworkID = $homeworkID";
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':homeworkID', $homeworkID, PDO::PARAM_INT);
        $cmd->execute();
        $task = $cmd->fetch();

        //populate the variables from the query result
        $assignment = $task['assignment'];
        $subject = $task['subject'];
        $dueDate = $task['dueDate'];
        $percentGrade = $task['percentGrade'];
        $submit = $task['submit'];
        $photo = $task['photo'];

        if ($task['submit'] == true) {
            $checked = "checked";
        }
    } catch (Exception $e) {
    header('location:error-page.php');
    exit();
    }
}
?>
<main class="containerAddNew">
  <h1 id="addNewTitle">Enter your assignment details:</h1>
<div class="row">
    <div class="column1">
        <form method="post" action="homework-save.php" enctype="multipart/form-data">
            <fieldset class="form-group">
        <!--   assignment name     -->
                <label for="assignment">Assignment: *</label>
                <input name="assignment" id="assignment" required maxlength="50" value="<?php echo $assignment; ?>" />
            </fieldset>
            <fieldset class="form-group">
        <!--     subject assignment is from dropdown menu   -->
                <label for="subject">Subject:</label>
                <select name="subject" id="subject" value="<?php echo $subject; ?>">
                    <option value="php">php</option>
                    <option value="CSS">CSS</option>
                    <option value="Relational Database">Relational Database</option>
                    <option value="C#">C#</option>
                    <option value="Java">Java</option>
                </select>
            </fieldset>
            <fieldset class="form-group">
        <!--     date the assignment is due on   -->
                <label for="dueDate">Due Date:</label>
                <input name="dueDate" id="dueDate" type="date" required value="<?php echo $dueDate; ?>" />
            </fieldset>
            <fieldset class="form-group">
        <!--     percent of students grade the assignment will be  -->
                <label for="percentGrade">Amount of Overall Grade:</label>
                <input name="percentGrade" id="percentGrade" value="<?php echo $percentGrade; ?>" />
            </fieldset>
            <fieldset class="form-group">
        <!--        submit online or not button    -->
                <label for="submit" >Submit Online:</label>
                <input name="submit" id="submit" type="checkbox" <?php echo $checked; ?> />
            </fieldset>
            <fieldset class="form-group">
                <label for="photo">Screenshot:</label>
                <input name="photo" id="photo" type="file" />
            </fieldset>

            <?php
            if (!empty($photo)) {
                echo '<div class="offset-2">
                        <img src="img/homework/' . $photo . '" alt="Assignment Photo" />
                    </div>';
            }

            ?>
            <!--    this line below ensures it edits existing record and not creating a new one    -->
            <input type="hidden" name="homeworkID" id="homeworkID" value="<?php echo $homeworkID; ?>" />
          <div class="addNewBtn">
            <button class="saveBtn">Save</button>
        </div>
      </form>
    </div>
<section class="imagesCol">
     <div class="imgColumn">
          <img src="https://lamp.computerstudi.es/~Sierra200366619/COMP1054/final-project/assets/img/flatlay.jpg" alt="laptop on a desk">
     </div>
     <div class="imgColumn">
      <img src="https://lamp.computerstudi.es/~Sierra200366619/COMP1054/final-project/assets/img/desk.jpg" alt="laptop on a desk showing time">
     </div>
   </section>
</div>
     </main>

<?php
require_once 'footer.php';
?>
