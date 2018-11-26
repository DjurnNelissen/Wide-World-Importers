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
  if (checkCart()) {
    $total = 0;
    foreach ($_SESSION['cart'] as $key => $value) {
      $total = $total + getProductWeight($key);
    }
    return $total;
  }
}



 ?>
