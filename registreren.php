<!DOCTYPE html>
<?php
include_once('common.php');





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
    <form>
        Volledige naam:<br>
        <input type="text" name="fullname" size="30"><br><br>
        E-mail/gebruikersnaam:<br>
        <input type="text" name="email" size="30"><br><br>
        Telefoonnummer:<br>
        <input type="text" name="phonenumber" size="30"><br><br>
        Wachtwoord:<br>
        <input type="text" name="password" size="30"><br><br>
        Herhaal wachtwoord:<br>
        <input type="text" name="passwordcheck" size="30"><br>
        <br>
        <input type="submit" value="Aanmelden">


    </form>











  </body>
</html>
