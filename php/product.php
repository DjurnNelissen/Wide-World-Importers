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

/* OLD FUNCTION
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
*/

//searches for products in the database
function findProducts ($name, $category, $order) {

  //create variable to store final sql string
  $sqlFinal  = "SELECT * FROM stockitems";

  //create an empty array to store parameters
  $params = [];

  //adds the where if needed
  if (isset($name) || isset($category)) {
    $sqlFinal = $sqlFinal . " WHERE";
  }

  //adds the query for the name
  if (isset($name)) {
      //splits the name at spaces
      $words = explode(' ',$name);
      $sql = '';

      //adds each seperate word as a LIKE %word%
      for ($i=0; $i < count($words) ; $i++) {
        $sql = $sql . " StockItemName LIKE ?";
        array_push($params, "%" . $words[$i] . "%" );
        if ($i != count($words) - 1) {
          $sql = $sql . " AND";
        }
      }

      $sqlFinal = $sqlFinal . $sql;
  }

  //adds the category
  if (isset($category)) {
    if (isset($name)) {
      $sqlFinal = $sqlFinal . " AND";
    }

    $sqlFinal = $sqlFinal . " StockItemID IN (SELECT StockItemID FROM stockitemstockgroups WHERE StockGroupID = ?)";
    array_push($params, $category);
  }

  //adds the order by
  if (isset($order)) {
    $sql = '';
    if ($order == 'priceA') {
      $sql = ' ORDER BY RecommendedRetailPrice ASC';
    } else if ($order == 'priceD') {
      $sql = ' ORDER BY RecommendedRetailPrice DESC';
    } else if ($order == 'nameA') {
      $sql = ' ORDER BY StockItemName ASC';
    } else if ($order == 'nameZ') {
      $sql = ' ORDER BY StockItemName DESC';
    }

    $sqlFinal = $sqlFinal . $sql;
  } else {
    $sqlFinal = $sqlFinal . " ORDER BY StockItemID DESC";
  }

  //returns the query result
  return runQueryWithParams($sqlFinal, $params);
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
     $category = null;
   }

   //default order
   if (isset($_GET['o'])) {
     $order = $_GET['o'];
   } else {
     $order = null;
   }

   //finds for all products
    $products = findProducts($_searchtekst,$category, $order);
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
  print("<div class='p-2 productgroup'> <a href='#' onclick='searchProducts(" . '"all"' . ")' class='px-3'>All</a></div>");
  while ($row = $stmt->fetch()) {
    print("<div class='p-2 productgroup'> <a href='#' onclick='searchProducts(" . $row['StockGroupID'] . ")' class='px-3'>" . $row['StockGroupName'] . "</a></div>");
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

//used for the dropdown in index.php
function printSelectedOption ($or) {
  if (isset($_GET['o'])) {
    if ($_GET['o'] == $or) {
      print('selected');
    }
  }
}

//used to show current category, sorted and stuff in index.html
function printNowShowing ($get) {

  //order
  if (isset($get['c'])) {
    print(" Category: " .  getCategoryName($get['c']));
  }

  //query
  if (isset($get['q'])) {
    print(" Search: '" . $get['q'] . "'");
  }



  //category
  if (isset($get['o'])) {
    if ($get['o'] == 'priceA') {
      print(' Ordered by price ascending');
    } else if ($get['o'] == 'priceD') {
      print(' Ordered by price descending');
    } else if ($get['o'] == 'nameA') {
      print(' Ordered by name A-Z');
    } else if ($get['o'] == 'nameZ') {
      print(' Ordered by name Z-A');
    }
  }
}

//return the name of the category with the id
function getCategoryName($id) {
  $sql = "SELECT * FROM stockgroups WHERE StockGroupID = ?";

  $stmt = runQueryWithParams($sql, array($id));

  $row = $stmt->fetch();

  return $row['StockGroupName'];
}

//returns the weight per unit from product
function getProductWeight ($id) {
  $sql = "SELECT TypicalWeightPerUnit FROM stockitems WHERE StockItemID = ?";

  $stmt = runQueryWithParams($sql, array($id));

  $row = $stmt->fetch();

  return $row['TypicalWeightPerUnit'];
}

 ?>
