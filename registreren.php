<!DOCTYPE html>
<?php
include_once ('php/account.php');

// Variable for user input
$fullname = filter_input(INPUT_POST, 'fullname', FILTER_SANITIZE_STRING);
$prefferedname = filter_input(INPUT_POST, 'prefferedname', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
$phonenumber = filter_input(INPUT_POST, 'phonenumber', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
$passwordcheck = filter_input(INPUT_POST, 'passwordcheck', FILTER_SANITIZE_STRING);

// Hashed password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);


// query data stores data in the database
$sql = " INSERT INTO people (PersonID, Fullname, PreferredName, SearchName, IsPermittedToLogon, LogonName, HashedPassword, IsSystemUser, PhoneNumber, EmailAddress, LastEditedBy, ValidFrom, ValidTo)
VALUES ((SELECT MAX(pe.PersonID) + 1 FROM people pe) , '$fullname', '$prefferedname', '" .  $prefferedname . " " .  $fullname . "', 1, '$email', '$password', 1, '$phonenumber', '$email', 1,  '2013-01-01 00:00:00', '9999-12-31 23:59:59')";

$stmt = runQuery($sql);

$sqlCustomer = " INSERT INTO customers ()
VALUES ()";

$sqlAccount = " INSERT INTO accounts (PersonID, CusomerID)
VALUES ((SELECT MAX(PersonID) FROM people),
        (SELECT MAX(CustomerID) FROM customers))";
?>


<!------------->
<!--- HTML ---->
<!------------->

<html>
  <head>
    <meta charset="utf-8">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <link rel="stylesheet" href="css/main.css" media="screen" title="no title" type="text/css">

    <title>WWI Webshop</title>
  </head>

  <body>
    <?php include("Menu.php") ?>
      <br><br>


        <div class="col form">
        <h1>Registreer je nu!</h1><br>
            <form method="post" action="registreren.php">
                Volledige naam:<br>
                <input type="text" name="fullname" size="30" required><br><br>

                Roepnaam:<br>
                <input type="text" name="prefferedname" size="30" required><br><br>

                E-mail:<br>
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
        </div>

</body>
</html>
