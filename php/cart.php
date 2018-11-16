<?php
session_start();
include_once('../common.php');

//this file includes all functions related to the shoppingcart

//check if the cart exists in the current session, if not it creates a new cart, returns true if cart exists
function checkCart() {
  if (! isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
    return true;
  } else {
    return true;
  }
}

//adds product to the cart
function addToCart ($productID, $amount) {
  //make sure a cart exist within the session
  if (checkCart()) {
    //check if the product already is in the cart
    if (array_key_exists($productID,$_SESSION['cart'])) {
      //only add the amount
      $_SESSION['cart'][$productID]['amount'] = $_SESSION['cart'][$productID]['amount'] + $amount;
    } else {
      //add the product entirely
      $_SESSION['cart'][$productID] = [
        'ID' => $productID, // ID isnt really needed since its already in the key
        'amount' => $amount
      ];
    }
  }
}

//removes a product from the cart
function removeFromCart ($productID, $amount) {
  if (checkCart()) {
    if (array_key_exists($productID, $_SESSION['cart'])) {
      if ($amount >= $_SESSION['cart'][$productID]['amount'] || $amount == 'all') {
        //remove item completely
        unset($_SESSION['cart'][$productID]);
      } else {
        //remove item partially
        $_SESSION['cart'][$productID]['amount'] = $_SESSION['cart'][$productID]['amount'] - $amount;
      }
    }
  }
}

//returns a statement object with all products currently in the cart
function fetchProductsFromCart () {
  if (checkCart()) {
    $sql = "SELECT * FROM stockitems WHERE StockItemID IN (" . arrayToSQLString(array_keys($_SESSION['cart'])) . ")";
    return runQuery($sql);
  }
}

function fetchProductsFromCartAsArray () {
  if (checkCart()) {
    //gets all products currently in the cart
    $stmt = fetchProductsFromCart();
    //creates a new array to store all products
    $result = [];
    //adds each product, also includes the amount in the array
    while ($row = $stmt->fetch()) {
      $id = $row['StockItemID'];
      if (array_key_exists($id, $_SESSION['cart'])) {
        $input = $row;
        $input['amount'] = $_SESSION['cart'][$id]['amount'];
        array_push($result,$input);
      }
    }
    return $result;
  }
}

//sets the amount of items in the cart of a certain item
function setProductInCartCount ($id, $amount) {
  //ensures that the cart exists within the session
  if (checkCart()) {
    //checks if the product is actually in the cart
    if (array_key_exists($id, $_SESSION['cart'])) {
      if ($amount > 0) {
        $_SESSION['cart'][$id]['amount'] = $amount;
      } else {
        //remove product
        unset($_SESSION['cart'][$id]);
      }
    } else {
      //if not add the product to the cart
      addToCart($id, $amount);
    }
  }
}

//empties the entire cart
function emptyCart () {
  unset($_SESSION['cart']);
  checkCart(); // creates a new cart just in case
}

//prints the cart in HTML
function printCart () {
  //gets all products from the cart
  $products = fetchProductsFromCartAsArray();

  if (count($products) > 0) {
  for ($i=0; $i < count($products) ; $i++) {
    print("<div class='col-md-12 cartItem'> ". $products[$i]['StockItemName']  ." - aantal <input min=1 id='" . $products[$i]['StockItemID'] . "' type='number' onChange='setProductAmount(" . $products[$i]['StockItemID'] .")' value='" . $products[$i]['amount'] . "'><form class='' action='winkelwagen.php' method='post'>
      <input type='number' name='ID' value='" . $products[$i]['StockItemID'] . "' hidden>
      <input type='number' name='amount' value=" . (string)$products[$i]['amount'] . " hidden>
      <input type='submit' name='RemoveItem' value='Remove'>
    </form>");
  }
} else {
  print("Cart is empty");
}
}
 ?>
