<?php
  //load libs
  session_start();
  include_once("common.php");
  include("menu.php");

  //handle adding items to cart
  if (isset($_POST['addToCart'])) {
    addToCart($_POST['ProductID'], $_POST['quantity']);
  }

  //handle removing items from cart
  if (isset($_POST['RemoveItem'])) {
    removeFromCart($_POST['ID'], $_POST['amount']);
  }

 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/main.css" media="screen" title="no title">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <title>WWI Webshop</title>
  </head>
  <body>
    <?php include('Menu.php') ?>
    <div class="wrapper">
      <div class="container">

        <div class="row main">
          <?php
          //prints the HTML code to generate the items in the cart
            printCart();
           ?>
        </div>
        <div class="row footer">

        </div>
      </div>
    </div>
  </body>
</html>
