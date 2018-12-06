<?php
//this file is now split into seperate files


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

//checks if the given credentials are legit
function verifyUser ($username, $hash) {
  //TO-DO

  //if credentials match return true

  //else return false

  //dummy CODE
  return true;
}

//adds a new review to the database for a certain product
function submitReview ($rating, $text, $productID) {
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

//checks if a user has previously ordered a product
function userHasPurchashedProduct ($productID) {
  //if user is logged in
  if (checkLogin()) {
    $userid = getUserID();
    //get the times this user has purchased this product
    $sql = "SELECT * FROM orders o join orderlines ol ON o.OrderID = ol.OrderID WHERE ol.StockItemID = $productID AND o.CustomerID = $userid";
    //execute the query
    $stmt = runQuery($sql);
    //check if this user has purchased the product 1 or more times
    if ($stmt->rowCount() > 0) {
      //if so return true
      return true;
    }
  }
  //return false by default
  return false;
}

//checks if the user is logged in
function checkLogin () {
  //check is session has user
  if (isset($_SESSION['user'])) {
    //check if the credentials match
    if (verifyUser($_SESSION['user']['name'], $_SESSION['user']['hash'])) {
      return true;
    }
  }
  //returns false by default
  return false;
}

//returns the ID of the user thats currently logged in - returns null if something went wrong
function getPersonID () {
  if (checkLogin()) {
    $stmt = runQuery("SELECT PersonID FROM people WHERE LogonName = " . $_SESSION['user']['name']);
    if ($stmt->rowCount() > 0) {
      $row = $stmt->fetch();
      //return the ID
      return $row['PersonID'];
    }
  }
  //returns null by default
  return null;
}

//returns the account ID, returns null if something went wrong
function getAccountID () {
  //checks if the user is logged in
  if (checkLogin()) {
    //gets the ID
    $ID = getPersonID();
    //setup sql query
    $sql = "SELECT AccountID FROM accounts WHERE PersonID =  $ID";
    //runs the query
    $stmt = runQuery($sql);
    //checks if we found atleast 1 account
    if ($stmt->rowCount() >  0) {
      $row = $stmt->fetch();
      //returns the ID
      return $row['AccountID'];
    }
  }
  return null;
}

//sets the current user
function setUser ($user, $hash) {
  $_SESSION['user'] = [
    'name' => $user,
    'hash' => $hash
  ];
}

/* OLD CODE
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
*/

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

/* OLD CODE
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
*/

//empties the entire cart
function emptyCart () {
  unset($_SESSION['cart']);
  checkCart(); // creates a new cart just in case
}

/* OLD CODE
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
*/

/* OLD CODE
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
*/

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
  foreach ($arr as $key => $value) {
    $sql = $sql . $value . ',';
  }
  $sql = rtrim($sql,',');
  return $sql;
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
							 <div class='col-4'>
							 	 <span class='badge-pill badge-primary mr-2'>" . $products[$i]['amount'] . "</span><b><a clas='cart-title' href='product.php?id=" . $products[$i]['StockItemID'] . "'>" . $products[$i]['StockItemName'] . "</a></b>
							 </div>

							 <!-- Naam product -->
							 <div class='col-3'>
							 	 <p>€ " . $products[$i]['RecommendedRetailPrice'] * $products[$i]['amount'] . "</p>
							 </div>

							 <!-- Verwijder knoppen -->
							 <div class='col-3'>
								 <form class='' action='winkelwagen.php' method='post'>
									 <input type='number' name='ID' value='" . $products[$i]['StockItemID'] . "' hidden>
									 <input type='number' name='amount' value=" . (string)$products[$i]['amount'] . " hidden>
									 <button type='submit' class='btn btn-danger' name='RemoveItem'><i class='fas fa-trash'></i> Remove all</button>
									</form>
									<form class='' action='winkelwagen.php' method='post'>
										<input type='number' name='ID' value='" . $products[$i]['StockItemID'] . "' hidden>
										<input type='number' name='amount' value=1 hidden>
									 <button type='submit' class='btn btn-danger' name='RemoveItem'><i class='fas fa-trash'></i> Remove one</button>
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
			print ("<div class='col col-sm-6 col-md-4 col-lg-3 p-2'>
								<div class='card shadow-sm'>
									<img class='card-img-top' src='https://sc02.alicdn.com/kf/HTB1wYdzPFXXXXaXapXXq6xXFXXX2/USB-Flash-Drive-8-GB-Memory-Stick.jpg_350x350.jpg' alt='Card image cap'>
									<div class='card-body'>
										<h5 class='card-title'>" .  $row['StockItemName'] .  "</h5>
										<p class='card-text'>" .  $row['StockItemName'] .  "</p>
										<a href='product.php?id=" . $row['StockItemID'] . "' class='btn btn-primary'>View</a>
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

//runs and SQL query to fetch all categories
function getProductCategories () {
  $sql = "SELECT * FROM stockgroups";
  return runQuery($sql);
}

//prints the product categories
function printProductCategories () {
  $stmt = getProductCategories();
  print("<div class='p-2 productgroup'> <a href='#' value='all' onclick=searchCategory('all') class='px-3'>All</a></div>");
  while ($row = $stmt->fetch()) {
    print("<div class='p-2 productgroup'> <a href='#' value='" . $row['StockGroupID'] . "' onclick=searchCategory(" . $row['StockGroupID'] . ") class='px-3'>" . $row['StockGroupName'] . "</a></div>");
  }
}

?>
