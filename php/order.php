<?php
//this file includes all functions needed to handle orders

//includes
include_once('db.php');
include_once('account.php');
include_once('cart.php');

//functions

//returns a stmt of all orders placed by the user that is currently logged in
function getUserOrders () {
  //check if the user is logged in
  if (checkLogin()) {
    //setup a query
    $sql = "SELECT * FROM orders WHERE CustomerID = (
      SELECT CustomerID FROM accounts WHERE PersonID = (
        SELECT PersonID FROM people WHERE LogonName = ?)
      )";
      //return the orders
      return runQueryWithParams($sql, array($_SESSION['user']['name']));
  }
}

//returns he order lines for a specific order
function getOrderLines($id) {
  //setup query
  $sql = "SELECT * FROM orderlines WHERE OrderID = ?";
  //execute query and return the result
  return runQueryWithParams($sql,array($id));
}


//generates all html needed to view orders -- WIP
function printOrders() {
  $stmt = getUserOrders();

  while ($row = $stmt->fetch()) {
    print ($row['OrderID'] . "<br>");
    $stmt2 = getOrderLines($row['OrderID']);
    while ($row2 = $stmt2->fetch()) {
      print($row2['StockItemID'] . " * ". $row2['Quantity'] ."<br>");
    }

    print('<br> ---------------------------- <br>');
  }
}

//turns the users current cart into an order
function createOrder () {
  //we can only create an order if the user is logged in
  if (checkLogin()) {
    //make sure we have a cart
    if (checkCart()) {
      //if the cart has more then 1 item
      if (count($_SESSION['cart']) > 0) {
        $params = [];
        //current date
        $date = date("Y/m/d");

        //get last placed order
        $newOrderID = getLastOrderID() + 1;
        array_push($params, $newOrderID);
        //fetch the account ID
        $accID = getAccountID();
        array_push($params, $accID, $accID,$date,$newOrderID,$date);

        //create an order
        $sql = "INSERT INTO orders (
          OrderID, CustomerID, SalespersonPersonID,ContactPersonID, PickedByPersonID,
          OrderDate, CustomerPurchaseOrderNumber, IsUnderSupplyBackordered, Comments,
          DeliveryInstructions, LastEditedBy, LastEditedWhen
        )
        VALUES (?,(SELECT CustomerID FROM accounts WHERE AccountID = ?),1,1,(SELECT PersonID FROM accounts WHERE AccountID = ?),
        ?,?, 0, '', '', 1, ?
      )";

        //execute the query
        $stmt = runQueryWithParams($sql, $params);

        //add order lines
        foreach ($_SESSION['cart'] as $key => $value) {
          createOrderLine($value, $newOrderID, $date);
        }
      }
    }
  }
}

//generates an order line for a product
function createOrderLine ($item, $orderID, $time) {
  if (checkLogin()) {
    //setup values
    $params = array($orderID, $item['ID'], $item['ID'],$item['ID'], $item['amount'], $item['ID'], $item['ID'], $item['amount'], $time, $time );
    //setup query
    $sql = "INSERT INTO orderlines (
      OrderLineID, OrderID, StockItemID, Description,
      PackageTypeID, Quantity, UnitPrice, TaxRate, PickedQuantity,
      PickingCompletedWhen, LastEditedBy, LastEditedWhen
      )
      VALUES (
        (SELECT MAX(o.OrderLineID) + 1 FROM orderlines o),
        ?, ?, (SELECT StockItemName FROM stockitems WHERE StockItemID = ?),
        (SELECT UnitPackageID FROM stockitems Where StockItemID = ?),
        ?,
        (SELECT UnitPrice FROM stockitems WHERE StockItemID = ?),
        (SELECT TaxRate FROM stockitems WHERE StockItemID = ?),
        ?, ?, 1, ?
      )";
      //execute query
      $stmt = runQueryWithParams($sql, $params);
  }

}

//returns the last placed order
function getLastOrderID () {
  //setup query
  $sql = "SELECT MAX(OrderID) FROM orders";
  //execute query
  $stmt = runQuery($sql);
  //fetch result
  $row = $stmt->fetch();
  //return result
  return $row['MAX(OrderID)'];
}

//gets the weight of your order
function getOrderWeight () {
  $total = 0;
  if (checkCart()) {
    foreach ($_SESSION['cart'] as $key => $value) {
      $total = $total + (getProductWeight($value['ID']) * $value['amount']);
    }
  }
  return $total;
}

//prints the users address and stuff
function printDeliveryDetails () {
  if (checkLogin()) {
    //setup query to fetch all data about user
    $sql = "SELECT * FROM people p JOIN
    accounts a ON p.PersonID = a.PersonID JOIN
    customers c ON a.CustomerID = c.CustomerID
    WHERE p.LogonName = ?";
    //execute query
    $stmt = runQueryWithParams($sql, array($_SESSION['user']['name']));
    //fetch result
    $row = $stmt->fetch();

    $div = "
    <div class='row'>
      <div class='col-12'>
        <h3>Delivery Details</h3>
        <!-- full name -->
        <div class='row'>
          <div class='col-6'>
            <p>
            Name
            </p>
          </div>
          <div class='col-6'>
            <p>
              " . $row['FullName'] . "
            </p>
          </div>
        </div>
        <!-- line 1-->
        <div class='row'>
        <div class='col-6'>
          <p>
            Address Line 1
          </p>
        </div>
          <div class='col-6'>
            <p>
             " . $row['DeliveryAddressLine1'] . "
            </p>
          </div>
        </div>
        <!-- line 2-->
        <div class='row'>
        <div class='col-6'>
          <p>
          Address Line 2
          </p>
        </div>
          <div class='col-6'>
            <p>
              " . $row['DeliveryAddressLine2'] . "
            </p>
          </div>
        </div>
        <!-- postalcode -->
        <div class='row'>
        <div class='col-6'>
          <p>
              Postal Code
          </p>
        </div>
          <div class='col-6'>
            <p>
             " . $row['DeliveryPostalCode'] . "
            </p>
          </div>
        </div>
        <!-- e-mail -->
        <div class='row'>
        <div class='col-6'>
          <p>
            E-mail
          </p>
        </div>
          <div class='col-6'>
            <p>
              " . $row['EmailAddress'] . "
            </p>
          </div>
        </div>
        <!-- phone -->
        <div class='row'>
        <div class='col-6'>
          <p>
            Phone
          </p>
        </div>
          <div class='col-6'>
            <p>
              " . $row['PhoneNumber'] . "
            </p>
          </div>
        </div>
      </div>
    ";

    print($div);
  }
}

//prints items currently in cart
function printOrderItems () {
  //cart has to exist
  if (checkCart()) {
    //needs atleast one item in cart
    if (count($_SESSION['cart']) > 0) {
      $products = fetchProductsFromCartAsArray();

      foreach ($products as $key => $product) {
        $div = "
        <div class='row item'>
          <!-- item -->
          <div class='col-3'>
            <!-- item image -->
            <img class='img-fluid rounded img-thumbnail mx-auto' src='https://sc02.alicdn.com/kf/HTB1wYdzPFXXXXaXapXXq6xXFXXX2/USB-Flash-Drive-8-GB-Memory-Stick.jpg_350x350.jpg' />
          </div>
          <div class='col-3'>
            <!-- item name -->
            <p>
              <a href='product.php?id=" . $product['StockItemID'] . "'> " . $product['StockItemName'] . "</a>
            </p>
          </div>
          <div class='col-2'>
            <!-- item price -->
            <p>
              € " . $product['RecommendedRetailPrice'] . "
            </p>
          </div>
          <div class='col-2'>
            <!-- amount -->
            <p>
              " . $product['amount'] . "
            </p>
          </div>
          <div class='col-2'>
            <!-- total price -->
              € " . ($product['RecommendedRetailPrice'] * $product['amount']) . "
          </div>
        </div>
        ";

        print($div);
      }
    }
  }
}



 ?>
