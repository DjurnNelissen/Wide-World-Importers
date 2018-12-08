<?php
include_once('db.php');

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
			print("<div class='row p-3 ml-2 cartItem'>
							 <!-- Afbeelding product -->
							 <div class='col-2'>
							 	 <img class='img-fluid rounded img-thumbnail' src='https://sc02.alicdn.com/kf/HTB1wYdzPFXXXXaXapXXq6xXFXXX2/USB-Flash-Drive-8-GB-Memory-Stick.jpg_350x350.jpg' />
							 </div>

							 <!-- Naam product -->
							 <div class='col-3'>
							 	 <b><a clas='cart-title' href='product.php?id=" . $products[$i]['StockItemID'] . "'>" . $products[$i]['StockItemName'] . "</a></b>
							 </div>

							 <!-- Prijs product -->
							 <div class='col-1'>
							 	 <p>€ " . $products[$i]['RecommendedRetailPrice'] . "</p>
							 </div>

               <!-- aantal aanpassen -->
               <div class='col-2'>
                <input type='number' min='1' value='" . $products[$i]['amount'] . "' id='" . $products[$i]['StockItemID'] . "' onchange=setProductAmount(" . $products[$i]['StockItemID'] . ")>
               </div>

               <!-- totaal prijs -->

               <div class='col-2'>
                <p id='" . $products[$i]['StockItemID'] . "-total'>€ " . $products[$i]["RecommendedRetailPrice"] * $products[$i]['amount'] . " </p>
               </div>

							 <!-- Verwijder knoppen -->
							 <div class='col-2'>
								 <form class='' action='winkelwagen.php' method='post'>
									 <input type='number' name='ID' value='" . $products[$i]['StockItemID'] . "' hidden>
									 <input type='number' name='amount' value=" . (string)$products[$i]['amount'] . " hidden>
									 <button type='submit' class='btn btn-danger' name='RemoveItem'><i class='fas fa-trash'></i> Remove</button>
									</form>
								</div>
							</div>");
		}
	} else {
  	print("<div class='alert alert-danger mx-auto my-5' role='alert'>
  				   <strong>Oh snap!</strong> Your cart is empty. <i class='far fa-frown'></i>
					 </div>");
	}
}


//prints the total price, place order button and empty cart button
function printCartFooter () {
    print ("
    <div class='row p-3 ml-2 cartItem'>
      <!-- afbeelding -->
      <div class='col-2'>
      <img class='img-fluid rounded img-thumbnail' src='https://sc02.alicdn.com/kf/HTB1wYdzPFXXXXaXapXXq6xXFXXX2/USB-Flash-Drive-8-GB-Memory-Stick.jpg_350x350.jpg' />
      </div>

      <!-- naam -->
      <div class='col-3'>

      </div>

      <!-- prijs -->
      <div class='col-1'>
        <button class='btn btn-success' " . returnDisabledIfCartEmpty() . ">Checkout</button>
      </div>

      <!-- aantal -->
      <div class='col-2'>

      </div>

      <!-- totaal -->
      <div class='col-2'>
          <p id='cart-totaal-prijs'>Total: € " . getTotalCartPrice() . "</p>
      </div>

      <!-- remove -->
      <div class='col-2'>
        <button class='btn btn-danger'  onclick='emptyCart()' " . returnDisabledIfCartEmpty() . "><i class='fas fa-trash'></i> Empty cart</button>
      </div>
    </div>
    ");
}

//checks if a product is in the cart
function isInCart ($id) {
  if (checkCart()) {
    if (array_key_exists($id, $_SESSION['cart'])) {
      return true;
    }
  }
  return false;
}

function returnDisabledIfCartEmpty () {
  if (checkCart()) {
    if (count($_SESSION['cart']) == 0) {
      return 'disabled';
    }
  }
  return '';
}

function getTotalCartPrice () {
  //make sure a cart exists
  if (checkCart()) {
    //get all products
    $cart = fetchProductsFromCartAsArray();
    //set total
    $totaal = 0;
    //calculate total
    foreach ($cart as $key => $row) {
      $totaal = $totaal + ($row['amount'] * $row['RecommendedRetailPrice']);
    }
    //return total
    return $totaal;
  }
}

 ?>
