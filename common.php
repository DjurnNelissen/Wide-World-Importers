<?php

//dictionary that stores DB settings
function getDBsettings () {
  return array (
  'DBserver' => "localhost",
  'DBname'  => "wideworldimporters",
  'DBport' => 3306,

  'DBuser' => "wwi",
  'DBpass' => ''
  );
}

//executes an SQL string and returns the result
function runQuery ($q) {
  //setup the database connection
  $dbSettings = getDBsettings();
  $db = "mysql:host=" . $dbSettings['DBserver'] . ";dbname=" . $dbSettings['DBname'] . ";port=" . $dbSettings['DBport'];
  $pdo = new PDO($db, $dbSettings['DBuser'], $dbSettings['DBpass']);
  //prepare the SQL string
  $stmt = $pdo->prepare($q);
  //execute the SQL
  $stmt->execute();
  //close the conention
  $pdo = null;
  //return the result
  return $stmt;
}

function runQueryWithParams ($q, $p) {
  //setup the database connection
  $dbSettings = getDBsettings();
  $db = "mysql:host=" . $dbSettings['DBserver'] . ";dbname=" . $dbSettings['DBname'] . ";port=" . $dbSettings['DBport'];
  $pdo = new PDO($db, $dbSettings['DBuser'], $dbSettings['DBpass']);
  //prepare the SQL string
  $stmt = $pdo->prepare($q);
  //execute the SQL
  $stmt->execute(array($p));
  //close the conention
  $pdo = null;
  //return the result
  return $stmt;
}

//test function to dump the SQL result
function DumpSql ($stmt) {
  while ($row = $stmt->fetch()) {
    print(var_dump($row));
  }
}

//check if the cart exists in the current session, if not it creates a new cart, returns true if cart exists
function checkCart() {
  if (! isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
    return true;
  } else {
    return true;
  }
}

//adds the given product ID to the cart of the current session
function addToCart($productID, $amount) {
  if (checkCart()) {
    //checks if the item already is in the cart
    $foundItem = false;
    for ($i=0; $i < count($_SESSION['cart']); $i++) {
      if ($_SESSION['cart'][$i]['ID'] == $productID) {
        $foundItem = true;
        //only adds the amount to the cart
        $_SESSION['cart'][$i]['amount'] = $_SESSION['cart'][$i]['amount'] + $amount;
      }
    }
    //if the item isnt in the cart yet, create a new product and add it to the cart
    if (! $foundItem) {
      $product = [
        'ID' => $productID,
        'amount' => $amount
      ];
      //adds the product to the cart
      array_push($_SESSION['cart'], $product);
    }
  }
}

//removes a product from the cart -  use 'all' to remove all of the product
function removeFromCart ($productID, $amount) {
  if (checkCart()) {
    //loops over the cart to find the item we are looking for
    for ($i=0; $i < count($_SESSION['cart']); $i++) {
      if ($_SESSION['cart'][$i]['ID'] == $productID) {
        //if the entire amount has to be removed, unset the variable
        if ($amount == 'all' || $amount >= $_SESSION['cart'][$i]['amount']) {
          array_splice($_SESSION['cart'],$i,1);
          $_SESSION['cart'] = array_values($_SESSION['cart']);
        } else {
          //else subtract the requested amount from the cart
          $_SESSION['cart'][$i]['amount'] = $_SESSION['cart'][$i]['amount'] - $amount;
        }
      }
    }
  }
}

//empties the entire cart
function emptyCart () {
  unset($_SESSION['cart']);
  checkCart(); // creates a new cart just in case
}

//retrieves all products from the database that are currently in the cart
function fetchProductsFromCart() {
  if (checkCart()) {
    //generates an SQL string, since i couldnt get the execute ? to work with an array
    $sql = "SELECT * FROM stockitems WHERE StockItemID IN (";
    for ($i=0; $i < count($_SESSION['cart']); $i++) {
      $sql = $sql . (string) $_SESSION['cart'][$i]['ID'] . ",";
    }
    $sql = rtrim($sql,",");
    $sql = $sql . ")";

    return runQuery($sql); //runs the SQL query
  }
}

//turns the returned products into an array, also includes the amount that is in the cart
function fetchProductsFromCartAsArray () {
  $stmt = fetchProductsFromCart();
  $result = [];
  while ($row = $stmt->fetch()) {
    $input = $row;
    for ($i=0; $i < count($_SESSION['cart']) ; $i++) {
      if ($_SESSION['cart'][$i]['ID'] == $row['StockItemID']) {
        $input['amount'] = $_SESSION['cart'][$i]['amount'];
      }
    }
    array_push($result,$input);
  }

  return $result;
}

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

//turns a single dimension array into a string with a comma between each element
function arrayToSQLString ($arr) {
  $sql = "";
  for ($i=0; $i < count($arr) ; $i++) {
    $sql = $sql . (string)$arr[$i];
    if (! $i = count($arr) - 1) {
      $sql = $sql . ',';
    }
  }
  return $sql;
}

//prints the cart in HTML
function printCart () {
  $products = fetchProductsFromCartAsArray();

  if (count($products) > 0) {
  for ($i=0; $i < count($products) ; $i++) {
    print("<div class='col-md-12 cartItem'> ". $products[$i]['StockItemName']  ." - " . $products[$i]['amount'] . "X <form class='' action='winkelwagen.php' method='post'>
      <input type='number' name='ID' value='" . $products[$i]['StockItemID'] . "' hidden>
      <input type='number' name='amount' value=" . (string)$products[$i]['amount'] . " hidden>
      <input type='submit' name='RemoveItem' value='Remove'>
    </form>
    <form class='' action='winkelwagen.php' method='post'>
      <input type='number' name='ID' value='" . $products[$i]['StockItemID'] . "' hidden>
      <input type='number' name='amount' value=1 hidden>
      <input type='submit' name='RemoveItem' value='Remove one'>
    </form></div>");
  }
} else {
  print("Cart is empty");
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

   if (isset($_GET['c'])) {
    $category = $_GET['c'];
   } else {
     $category = 'all';
   }

    $products = findProducts($_searchtekst,$category,1000);
    if ($products->rowCount() > 0) {
      while ($row = $products->fetch()) {
      print ("<div class='product'> <a href='product.php/?id=" . $row['StockItemID'] . "'>" .  $row['StockItemName'] .  "</a> </div>");
    }
  } else {
    print("No products found");
  }
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

?>
