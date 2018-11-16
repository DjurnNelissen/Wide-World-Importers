<?php
session_start();
//includes
include_once('db.php');
include_once('account.php');

//this file includes all functions related to the reviews

//checks if currently logged in user has purchased the product
function userHasPurchashedProduct ($productID) {

}

//checks if the currently logged in user has reviewed the product
function userHasReviewedProduct ($productID) {

}

//adds a review to the database
function submitReview ($productID, $rating, $comment) {
  //checks if the user is logged in
  if (checkLogin()) {
      if (userHasPurchashedProduct($productID) && ! userHasReviewedProduct($productID)) {
        $id = getUserID();
        //check if the ID didnt get an error
        if (isset($id)) {
          //create query
          $sql = "INSERT INTO reviews
          (Rating, Comment, ProductID, PersonID)
          VALUES
          ($rating,'$text',$productID,$id)
          ";
          //execute query
          runQuery($sql);
          //verify if placing review was succesful
        }
    }
  }
}

//prints reviews for the product
function printReviews ($productID) {
  //setup sql
  $sql = "SELECT * FROM reviews r JOIN people p on r.PersonID = p.PersonID WHERE ProductID = $productID";
  //execute query
  $stmt = runQuery($sql);
  //get each row
  if ($stmt->rowCount() > 0) {
    while ($row => $stmt->fetch()) {
    //print each review
    print ("
      <div class='row review'>
        <div class='col-md-12 review-head'>
        <div class='col-md-6  rating'>
            " . $row['Rating'] . "
        </div>
        <div class='col-md-6 name'>
          " . $row['PreferredName'] . "
        </div>
        </div>
        <div class='col-md-12 comment'>
          " . $row['Comment'] . "
        </div>
      </div>
    ");
    }
  } else {
    //no reviews for this product
    print ("<div class='row no-reviews'>
    <div class='col-md-12'>
    This product does not have any reviews.
    </div>
    </div>");
  }
}

 ?>