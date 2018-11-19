<?php
session_start();
include_once('../php/account.php');
//checks if needed credentials have been passed
if (isset($_POST['name']) && isset($_POST['pass'])) {
  //checks if they are legit
  if (verifyUser ($_POST['name'], $_POST['pass'])) {
    //if so return success and set user
    print('success');
    setUser($_POST['name'], $_POST['pass']);
  } else {
    //else return error so we know something went wrong
    print('error');
  }
} else {
  print('error');
}

 ?>
