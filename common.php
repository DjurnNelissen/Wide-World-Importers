<?php

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
    //if the item isnt in the cart yet it adds it completely
    if (! $foundItem) {
      $product = [
        'ID' => $productID,
        'amount' => $amount
      ];

      array_push($_SESSION['cart'], $product);
    }
  }
}

//removes a product from the cart -  use 'all' to remove all of the product
function removeFromCart ($productID, $amount) {
  if (checkCart()) {
    for ($i=0; $i < count($_SESSION['cart']); $i++) {
      if ($_SESSION['cart'][$i]['ID'] == $productID) {
        if ($amount == 'all' || $amount >= $_SESSION['cart'][$i]['amount']) {
          unset($_SESSION['cart'][$i]);
        } else {
          $_SESSION['cart'][$i][$amount] = $SESSION['cart'][$i]['amount'] - $amount;
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

//fetches a single product based on its product ID
function fetchProduct($id) {
  $sql = "SELECT * FROM stockitems WHERE StockItemID = $id";
  return runQuery($sql);
}



?>
