<?php
$title = 'Register';
require_once ('header.php');
?>

<main class="container">
    <h1>User Registration</h1>
    <form method="post" action="save-registration.php">

        <fieldset class="form-group">
            <label for="username" >Username:</label>
            <input name="username" id="username" required type="email" placeholder="youremail@email.com" />
        </fieldset>

        <fieldset class="form-group">
            <label for="password" >Password:</label>
            <input type="password" name="password" id="password" required
                   pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="Include: a symbol, a number, an uppercase letter, and be 8 characters long"/>
        </fieldset>

        <fieldset class="form-group">
            <label for="confirm" >Confirm Password:</label>
            <input type="password" name="confirm" id="confirm" required
                   pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" />
        </fieldset>

        <div class="registerBtn">
            <input type="submit" value="Register" class="btn" />
        </div>

    </form>
</main>

<?php
require_once 'footer.php';
?>
