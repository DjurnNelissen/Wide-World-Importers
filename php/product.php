<?php
session_start();
include_once('db.php')

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

//prints the product categories
function printProductCategories () {
  $stmt = getProductCategories();
  print("<div class='productgroup'> <input type='radio' name='category' value='all' onchange=searchCategory('all')>all</div>");
  while ($row = $stmt->fetch()) {
    print("<div class='productgroup'> <input type='radio' name='category' value='" . $row['StockGroupID'] . "' onchange=searchCategory(" . $row['StockGroupID'] . ")>" . $row['StockGroupName'] . "</div>");
  }
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
      print ("<div class='product'> <a href='product.php/?id=" . $row['StockItemID'] . "'>" .  $row['StockItemName'] .  "</a> </div>");
    }
  } else {
    print("No products found");
  }
}


 ?>
