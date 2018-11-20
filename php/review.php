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
    $sql = "SELECT * FROM reviews r WHERE StockItemID = $productID
    AND PersonID = (
      SELECT PersonID FROM people
      WHERE LogonName = '" . $_SESSION['user']['name'] . "' )";
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
          (Rating, Comment, StockItemID, PersonID)
          VALUES
          ($rating,'$comment',$productID,$id)
          ";
          //execute query
          $stmt = runQuery($sql);
          //verify if placing review was succesful

        }
    }
  }
}

//returns the average rating of the reviews for a product
function getAverageRating ($productID) {
  //generate sql string
  $sql = "SELECT AVG(Rating) FROM reviews WHERE StockItemID = $productID";
  //execute query
  $stmt = runQuery($sql);
  //get result
  $row = $stmt->fetch();
  if (isset($row['AVG(Rating)'])) {
    return $row['AVG(Rating)'];
  }
  //return 0 by default
  return 0;
}

//prints reviews for the product
function printReviews ($productID) {
  //setup sql
  $sql = "SELECT * FROM reviews r
   LEFT JOIN people p on r.PersonID = p.PersonID
    WHERE r.StockItemID = $productID
     ORDER BY Rating desc";
  //execute query
  $stmt = runQuery($sql);
  //get each row
  if ($stmt->rowCount() > 0) {

    $isFirstItem = true;

    while ($row = $stmt->fetch()) {
    //print each review
			if ($isFirstItem) {
				$isFirstItem = false;
				print ("<div class='card'>
									<div class='card-header'>
										<b>" . $row['PreferredName'] . "</b><span class='rating-date'>" . $row['DateAdded'] . "</span>
									</div>
									<div class='card-body'>
										<div class='stars-outer'>
											<div class='stars-inner' style='width:
												"	. getRatingPercentageRounded($row['Rating']) . "%'>
											</div>
										</div>
										<h5 class='card-title'>"	. round($row['Rating'],1) . "/5 stars!</h5>
										<p class='card-title'>" . $row['Comment'] . "</p>
									</div>
								</div>");
			}
		}
  } else {
    //no reviews for this product
		$today = date("Y-m-d, H:i");
    print ("<div class='card'>
							<div class='card-header'>
								<b>Your name here!</b><span class='rating-date'>" . $currentDate . "</span>
							</div>
							<div class='card-body'>
								<div class='stars-outer'>
									<div class='stars-inner' style='width:
										100%'>
									</div>
								</div>
								<h5 class='card-title'>5/5 stars!</h5>
								<p class='card-title'>Submit your review about " . $row['StockItemName'] . " now!</p>
							</div>
						</div>");
  }
}

//turns the rating into a %
function getRatingPercentage ($rating) {
  return ($rating / 5) * 100;
}

//turns the rating into a rounded %
function getRatingPercentageRounded ($rating) {
  return round(getRatingPercentage($rating) / 10) * 10;
}

//checks if there are reviews for a product
function productHasReviews ($id) {
  //create query
  $sql = "SELECT * FROM reviews WHERE StockItemID = $id";
  //execute query
  $stmt = runQuery($sql);
  //check if we found any reviews
  if ($stmt->rowCount > 0) {
    //if so return true
    return true;
  }
  //return false by default
  return false;
}

function printDisabled ($id) {
  if (! checkLogin() || ! userHasPurchashedProduct($id) || userHasReviewedProduct($id)) {
    print('disabled');
  }
}

 ?>
