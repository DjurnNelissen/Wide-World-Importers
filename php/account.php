 <?php
session_start();
include('db.php');

//checks if the given credentials are legit
function verifyUser ($username, $hash) {
  //TO-DO

  //if credentials match return true

  //else return false

  //dummy CODE
  return true;
}

//checks if the user is logged in
function checkLogin () {
  //check is session has user
  if (isset($_SESSION['user'])) {
    //check if the credentials match
    if (verifyUser($_SESSION['user']['name'], $_SESSION['user']['hash'])) {
      return true;
    }
  }
  //returns false by default
  return false;
}

//returns the ID of the user thats currently logged in - returns null if something went wrong
function getPersonID () {
  if (checkLogin()) {
    $stmt = runQuery("SELECT PersonID FROM people WHERE LogonName = " . $_SESSION['user']['name']);
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
function setUser ($user, $hash) {
  $_SESSION['user'] = [
    'name' => $user,
    'hash' => $hash
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
//function usernameUsed(){

//}

// password requirements that the password must need
//function passwordReq (){
//}
 ?>
