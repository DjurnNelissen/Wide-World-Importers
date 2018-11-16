<?php
/**
 * Created by PhpStorm.
 * User: Axel Broek
 * Date: 14-11-2018
 * Time: 14:14
 */
session_start();
include_once ("common.php");

?>
<html>
<head>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <script src="js/main.js"></script>

    <style>
        @import url('https://fonts.googleapis.com/css?family=Berkshire+Swash|Courgette');
    </style>
</head>
<body>

<section>
    <form action="loginconfirmed.php" method="post">
        <div class="container">
            <div class="div1">
                <h1>WWI loginpage</h1>
                <h3>in aanbouw</h3>
            </div>
            <div class="div2">
                <h4>Need an Account ?<a href="#"> Sing Up</a></h4>
                <input type="email" name="email" placeholder="email">
                <input type="password" name="passwd" placeholder="password">
                <span style="color: lightblue"></span>
                <input type="submit" id="sub" name="submit" value="Sign In">
                <a href="#"> Forget Your Password ?</a>
            </div>
        </div>
    </form>
</section>
</body>
</html>
