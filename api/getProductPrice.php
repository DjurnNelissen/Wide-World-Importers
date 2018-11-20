<?php
  session_start();
  include_once('../php/db.php');
  //checks if ID is given
  if (isset($_POST['id'])) {
    //query to get the price
    $sql = "SELECT RecommendedRetailPrice FROM stockitems WHERE StockItemID = ?";
    //execute query
    $stmt = runQueryWithParams($sql, array($_POST['id']));

    //return price
    if ($row = $stmt->fetch()) {
      print($row['RecommendedRetailPrice']);
    }
  }
 ?>
