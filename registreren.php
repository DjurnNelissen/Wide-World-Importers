<!DOCTYPE html>
<?php
//include_once ('account.php');

$fullname = filter_input(INPUT_POST, 'fullname', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
$phonenumber = filter_input(INPUT_POST, 'phonenumber', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
$passwordcheck = filter_input(INPUT_POST, 'passwordcheck', FILTER_SANITIZE_STRING);

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);



$sql = "INSERT INTO people (FullName, LogonName, HashedPassword, PhoneNumber, EmailAddress) VALUES ($fullname, $email, $hashedPassword, $phonenumber, $email)"


?>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/css/main.css" media="screen" title="no title">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <title>WWI Webshop</title>
  </head>
  <body>
    <?php include("Menu.php") ?>
      <br><br>
      <h1>Registreer je nu!</h1><br>
    <form method="post" action="registreren.php">
        Volledige naam:<br>
        <input type="text" name="fullname" size="30" required><br><br>
        E-mail/gebruikersnaam:<br>
        <input type="text" name="email" size="30" required><br><br>
        Telefoonnummer:<br>
        <input type="text" name="phonenumber" size="30" required><br><br>
        Wachtwoord:<br>
        <input type="text" name="password" size="30" required><br><br>
        Herhaal wachtwoord:<br>
        <input type="text" name="passwordcheck" size="30" required><br>
        <br>
        <input type="submit" value="Aanmelden">


    </form>











  </body>
</html>
