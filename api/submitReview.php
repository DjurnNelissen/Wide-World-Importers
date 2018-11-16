<?php
session_start();
include_once('common.php');
//checks if data has been submitted
if (isset($_POST['rating']) && isset($_POST['comment']) && isset($_POST['productID'])) {
  //checks if the user is logged in
  if (checkLogin()) {
    //submits the review to the database
    submitReview($_POST['rating'], $_POST['comment'], $_POST['productID']);
  }
}
 ?>