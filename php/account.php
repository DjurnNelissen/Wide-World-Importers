<?php
include_once('db.php');


//checks if the given credentials are legit
function verifyUser ($username, $pass) {
  //setup our query
  $sql = "SELECT * FROM people
  WHERE LogonName = '$username'
  AND IsPermittedToLogon = 1";
  //execute the query
  $stmt = runQuery($sql);
  //check if the user exists
  if ($stmt->rowCount() > 0) {
    $row = $stmt->fetch();
    //compare the passwords
    if (password_verify($pass, $row['HashedPassword'])) {
      //if they match return true
      return true;
    }
  }

  //return false by default
  return false;
}

//checks if the user is logged in
function checkLogin () {
  //check is session has user
  if (isset($_SESSION['user'])) {
    //check if the credentials match
    if (verifyUser($_SESSION['user']['name'], $_SESSION['user']['pass'])) {
      return true;
    }
  }
  //returns false by default
  return false;
}

//returns the ID of the user thats currently logged in - returns null if something went wrong
function getPersonID () {
  if (checkLogin()) {
    $stmt = runQuery("SELECT PersonID FROM people WHERE LogonName = '" . $_SESSION['user']['name'] . "'");
    if ($stmt->rowCount() > 0) {
      $row = $stmt->fetch();
      //return the ID
      return $row['PersonID'];
    }
  }
  //returns null by default
  return null;
}

//returns the account ID, returns null if something went wrong
function getAccountID () {
  //checks if the user is logged in
  if (checkLogin()) {
    //gets the ID
    $ID = getPersonID();
    //setup sql query
    $sql = "SELECT AccountID FROM accounts WHERE PersonID =  $ID";
    //runs the query
    $stmt = runQuery($sql);
    //checks if we found atleast 1 account
    if ($stmt->rowCount() >  0) {
      $row = $stmt->fetch();
      //returns the ID
      return $row['AccountID'];
    }
  }
  return null;
}

//sets the current user
function setUser ($user, $pass) {
  $_SESSION['user'] = [
    'name' => $user,
    'pass' => $pass
  ];
}

//queries add to database
function addDataToDatabase () {
    // Variable for user input
    $fullname = filter_input(INPUT_POST, 'fullname', FILTER_SANITIZE_STRING);
    $prefferedname = filter_input(INPUT_POST, 'prefferedname', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $phonenumber = filter_input(INPUT_POST, 'phonenumber', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $passwordcheck = filter_input(INPUT_POST, 'passwordcheck', FILTER_SANITIZE_STRING);

    $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
    $street = filter_input(INPUT_POST, 'street', FILTER_SANITIZE_STRING);
    $housenumber = filter_input(INPUT_POST, 'housenumber', FILTER_SANITIZE_STRING);
    $postalcode = filter_input(INPUT_POST, 'postalcode', FILTER_SANITIZE_STRING);


// Hashed password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sqlPeople = " INSERT INTO people (PersonID, Fullname, PreferredName, SearchName, IsPermittedToLogon, LogonName, HashedPassword, IsSystemUser, PhoneNumber, EmailAddress, LastEditedBy, ValidFrom, ValidTo)
    VALUES ((SELECT MAX(pe.PersonID) + 1 FROM people pe) , '$fullname', '$prefferedname', '" .  $prefferedname . " " .  $fullname . "', 1, '$email', '$hashedPassword', 1, '$phonenumber', '$email', 1, (SELECT CURDATE()), '9999-12-31 23:59:59')";

    $stmt = runQuery($sqlPeople);

    $sqlCustomer = " INSERT INTO customers (CustomerID, CustomerName, BillToCustomerID, CustomerCategoryID, PrimaryContactPersonID, DeliveryMethodID, DeliveryCityID, PostalCityID, CreditLimit, AccountOpenedDate, StandardDiscountPercentage, IsStatementSent, IsOnCreditHold, PaymentDays, PhoneNumber, DeliveryAddressLine1, DeliveryAddressLine2, DeliveryPostalCode, LastEditedBy, ValidFrom, ValidTo)
    VALUES ((SELECT MAX(c.CustomerID) + 1 FROM customers c) , '$fullname', (SELECT MAX(cu.CustomerID) + 1 FROM customers cu), 9, (SELECT MAX(PersonID) FROM people), 1, 1, '$postalcode', 0, (SELECT CURDATE()), 0, 0, 0, 7, '$phonenumber', '$housenumber', '$street', '$postalcode', 1, (SELECT CURDATE()), '9999-12-31 23:59:59')";


    runQuery($sqlCustomer);

    $sqlAccount = " INSERT INTO accounts (PersonID, CustomerID)
    VALUES ((SELECT MAX(PersonID) FROM people),
        (SELECT MAX(CustomerID) FROM customers))";

    runQuery($sqlAccount);
}
// checks whether the repeated password is the same as the password
function passwordNotEqual($a,$b){
    if($a == $b){
        //return true;
        addDataToDatabase ();
        print("Je wachtwoord is gelijk");
    }else{
        //return false;
        print("Nope... Try again");
    }
}

//checks if the username already exist
function usernameUsed($email){

    $sql = "SELECT LogonName FROM people";

    if($email != runQuery($sql)){
        return true;
    }else{
        return false;
    }
}

// password requirements that the password must need
//function passwordReq ($password){
//    if (strlen($password) < 8 ) {
//     return false;
//    } else if (!preg_match('/^(?=[a-z])(?=[A-Z])[a-zA-Z]{8,}$/',                    $password){
//            return false;
//    }else{
//        return true;
//    }
//
//
//}

//returns the preferredname of the currently logged in user
function getLoggedInName () {
  if (checkLogin()) {
    //setup the query
    $sql = "SELECT PreferredName FROM people WHERE LogonName = '" . $_SESSION['name'] . "'";
    //execute the query
    $stmt = runQuery($sql);
    //fetch the result
    $row = $stmt-fetch();
    if ($row) {
        //return the name
        return $row['PreferredName'];
    }
  }
  //return nothing by default
  return '';
}


 ?>
