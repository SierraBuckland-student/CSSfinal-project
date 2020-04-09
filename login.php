<?php
$title = 'Login Page';
require_once ('header.php');
?>
<main class="container">
    <h1>Login</h1>
    <form method="post" action="validate.php">

        <fieldset class="form-group">
            <label for="username" >Username:</label>
            <input name="username" id="username" required type="email" placeholder="youremail@email.com" />
        </fieldset>

        <fieldset class="form-group">
            <label for="password" >Password:</label>
            <input type="password" name="password" id="password" required />
        </fieldset>

        <div class="loginBtn">
            <input type="submit" value="Login" class="btn" />
        </div>
    </form>
</main>
<?php
require_once 'footer.php';
?>
