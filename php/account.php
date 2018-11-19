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


// checks whether the repeated password is the same as the password
function passwordNotEqual($password,$passwordcheck){
    if($password == $passwordcheck){
        return true;
    }else{
        return false;
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
