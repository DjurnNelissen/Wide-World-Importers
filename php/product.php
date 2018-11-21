<?php
include_once('db.php');
include_once('cart.php');
include_once('php/review.php');

//this file includes all functions related to finding products

//fetches a single product based on its product ID
function fetchProduct($id) {
  $sql = "SELECT * FROM stockitems s LEFT JOIN colors c ON s.ColorID = c.ColorID WHERE StockItemID = $id";
  return runQuery($sql);
}

//returns products based on name and categories (categories being a stockgroupID array)
function findProducts ($text, $category, $limit) {
    $sql =   "SELECT * FROM stockitems";

    //checks if the item is in the requested categories
    if (isset($category) && $category != 'all') {
      $category = (int)$category;
        $sql = $sql . " WHERE StockItemID IN (SELECT StockItemID FROM stockitemstockgroups WHERE StockGroupID = $category )";
        if (isset($text) && $text != '') {
          //adds the text search if needed
          $sql = $sql . "AND StockItemName LIKE '%$text%'";
        }
    } else {
      //adds the text search if needed
      if (isset($text) && $text != '' ) {
        $sql = $sql . " WHERE StockItemName LIKE '%$text%'";
      }
    }

    if (isset($limit)) {
      $sql = $sql . " LIMIT $limit";
    }

    return runQuery($sql);
}


//runs and SQL query to fetch all categories
function getProductCategories () {
  $sql = "SELECT * FROM stockgroups";
  return runQuery($sql);
}

//used  for index.php
function printProducts () {
  //gets all products that match the query -- currently only uses the text search
   if (!isset($_GET["q"])) {
    $_searchtekst = "";
  } else {
       $_searchtekst = $_GET["q"] ;
   }
   //defaults to all categories
   if (isset($_GET['c'])) {
    $category = $_GET['c'];
   } else {
     $category = 'all';
   }
   //finds for all products
    $products = findProducts($_searchtekst,$category,1000);
    if ($products->rowCount() > 0) {
      while ($row = $products->fetch()) {
			print ("<div class='col col-sm-6 col-md-4 col-lg-3 p-2 product-card'>
								<div class='card shadow-sm'>
									<img class='card-img-top product-card-img' src='https://sc02.alicdn.com/kf/HTB1wYdzPFXXXXaXapXXq6xXFXXX2/USB-Flash-Drive-8-GB-Memory-Stick.jpg_350x350.jpg' alt='Card image cap'>
									<div class='card-body'>
										<h5 class='card-title'>" . $row['StockItemName'] . "</h5>
										<div class='row'>
											<h5 class='card-title col-6'>€ " . $row['RecommendedRetailPrice'] . "</h5>
											<button class='btn btn-success col-4 add-to-cart-button' onclick=" . '"' . "addToCart(" . $row['StockItemID'] .  ", 1)" . '"' . " data-trigger='focus' data-toggle='popover' data-placement='top' data-content='Product added to cart'>
												<i class='fas fa-cart-plus'></i>
											</button>
										</div>
                    <section class='stars-outer'>
                      <p class='stars-inner' style='width: " . getRatingPercentageRounded(getAverageRating($row['StockItemID'])) . "%'></p>
                    </section>
                    <p class='review-count'>" . getReviewCount($row['StockItemID']) . " review(s)</p>
                  " . getSupplyLevelDiv($row['StockItemID']) . "
										<a href='product.php?id=" . $row['StockItemID'] . "' class='btn btn-primary col-12'>View</a>
									</div>
								</div>
  						</div>");
      //print ("<div class='product'> <a href='product.php/?id=" . $row['StockItemID'] . "'>" .  $row['StockItemName'] .  "</a> </div>");
    }
  } else {
    print("<div class='alert alert-danger mx-auto my-5' role='alert'>
  				   <strong>Oh snap!</strong> No products found. <i class='far fa-frown'></i>
					 </div>");
  }
}

//prints the product categories
function printProductCategories () {
  $stmt = getProductCategories();
  print("<div class='p-2 productgroup'> <a href='#' value='all' onclick=searchCategory('all') class='px-3'>All</a></div>");
  while ($row = $stmt->fetch()) {
    print("<div class='p-2 productgroup'> <a href='#' value='" . $row['StockGroupID'] . "' onclick=searchCategory(" . $row['StockGroupID'] . ") class='px-3'>" . $row['StockGroupName'] . "</a></div>");
  }
}

//returns the amount in stock for given product
function getStockSupply ($id) {
  //setup query
  $sql = "SELECT SUM(QuantityOnHand) FROM stockitemholdings WHERE StockItemID = $id";
  //execute query
  $stmt = runQuery($sql);
  //fetch result
  $row = $stmt->fetch();
  //return result
  return $row['SUM(QuantityOnHand)'];
}

//prints the level of the supply for a specific product
function getSupplyLevelDiv ($id) {
  $supply = getStockSupply($id);

  $supplyText = $supply;

  if ($supply > 100) {
    $supplyText = "100+";
  }

  $div = "<div class='supply-box mb-2'><i class='fas fa-box' style='color: ";

  if ($supply > 75) {
    //green good supply
    $div = $div . "#28a745;";
  } else if ($supply > 25) {
    //orange ok supply
    $div = $div . "#ffc107;";
  } else if ($supply > 0) {
    //red - low supply
    $div = $div . "#dc3545;";
  } else {
    //grey - no supply
    $div = $div . "#6c757d;";
	}

  $div = $div . "'></i> <span>" . $supplyText . "</span></div>";

  return $div;

}

 ?>
