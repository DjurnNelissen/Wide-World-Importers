<?php
//includes
include_once('db.php');
include_once('account.php');

//this file includes all functions related to the reviews

//checks if currently logged in user has purchased the product
function userHasPurchashedProduct ($productID) {
  //user has  to be logged in before we can access this info
  if (checkLogin()) {
  //setup query
  $sql = "SELECT * FROM people p
   JOIN accounts a  ON p.PersonID = a.PersonID
   JOIN orders o ON o.CustomerID = a.CustomerID
   JOIN orderlines ol ON ol.OrderID = o.OrderID
   WHERE p.LogonName = '" . $_SESSION['user']['name'] . "' AND ol.StockItemID = $productID";
   //run query
   $stmt = runQuery($sql);
   //check if the customer has bought this product
   if ($stmt->rowCount() > 0) {
     //if so return true
     return true;
   }

}
  //return false by default
  return false;
}

//checks if the currently logged in user has reviewed the product
function userHasReviewedProduct ($productID) {
  if (checkLogin()) {
    //setup a query that returns all reviews for the current product
    //for the currently logged in user
    $sql = "SELECT * FROM reviews r WHERE ProductID = $productID
    AND PersonID = (
      SELECT PersonID FROM people
      WHERE LogonName = " . $_SESSION['user']['name'] . " )";
      //executes the query
      $stmt = runQuery($sql);
      //if we have 1 or somehow more reviews then the user has reviewed this product
      if ($stmt->rowCount() > 0) {
        return true;
      }
  }
  //returns false by default
  return false;
}

//adds a review to the database
function submitReview ($productID, $rating, $comment) {
  //checks if the user is logged in
  if (checkLogin()) {
      if (userHasPurchashedProduct($productID) && ! userHasReviewedProduct($productID)) {
        $id = getPersonID();
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
    while ($row = $stmt->fetch()) {
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
