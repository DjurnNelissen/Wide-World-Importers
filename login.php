<?php
/**
 * Created by PhpStorm.
 * User: Axel Broek
 * Date: 14-11-2018
 * Time: 14:14
 */
session_start();
include_once ("common.php");
if(isset($_GET["loginfailed"])){
    print("login gefaald!");
}
?>
<style>
    .inputveld {
        width: 500px;
    }

</style>

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

    <body>
    <section>
    <div class="nav">
    <a href="/" class="navbar-brand">Logo</a>
    <form class="Search" action="index.php" method="get">
        <input type="text" hidden name="c" value='all'>
        <input type="text" name="q" value=>
        <button type="submit" name="" value="" class="btn">Search</button>
    </form>
    <div class="nav justify-content-center">
        <ul class="nav ul">
            <li class="nav-item">
                <a class="nav-link active" href="#">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../winkelwagen.php">Winkelwagen</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Inloggen</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Contact</a>
            </li>
        </ul>
    </div>
</div>
<section/>



        <div class="login-box">
            <div class="textbox">
                <div class="hello">
                    <h1> Inloggen</h1><br/>
                </div>
            </div>
                Email:<br/>
                <input class="inputveld" type="email" name="email" placeholder="">
                <div/>
                <br/>
                <div class="textbox">
                 Wachtwoord:<br/>
                    <input class="inputveld" type="password" name="passwd" placeholder="">
                    <div/>
                    <br/>
                    <input type="submit" id="sub" name="submit" value="Inloggen">
                    <br/><br/>
                    Nog geen account registreer je dan <a href="register.html">hier</a>.
                </div>


</body>
</html>
