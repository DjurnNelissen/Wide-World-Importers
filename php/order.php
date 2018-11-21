<?php
//this file includes all functions needed to handle orders

//includes
include_once('db.php');
include_once('account.php');

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

 ?>
