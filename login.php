<!DOCTYPE html>
<html>
<?php
$title = "Login";
$stylesheet = "css/login.css";
$sidebar = false;
include("includes/page-head.php");
?>
<div class="card col-12 col-md-4 mx-auto shadow-sm login-card">
    <div class="card-body">
        <h1 class="card-title">Login</h1>
        <form action="loginconfirmed.php" method="post" >
            <div class="form-group">

                <label for="email">E-mail:</label>
                <input class="form-control" type="email" name="email">
                <label for="passwd">Password:</label>
                <input class="form-control" type="password" name="passwd">

                <input class="btn btn-info loginknop" type="submit" id="sub" name="submit" value="Inloggen">
            </div>
        </form>
        <p class="card-text">Dont have an account? <br> Register <a href="registreren.php"><u>here</u></a>.</p>
    </div>
</div>

<!-- include the footer of the page -->
<?php include("includes/page-foot.php") ?>
