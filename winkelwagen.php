<?php
  session_start();
  include_once("common.php");

  if (isset($_POST['addToCart'])) {
    addToCart($_POST['ProductID'], $_POST['quantity']);
  }

 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <div class="wrapper">
      <div class="container">
        <div class="row nav-bar">
          <!--nav bar -->
        </div>
        <div class="row main">
          <?php
            printCart();
           ?>
        </div>
        <div class="row footer">

        </div>
      </div>
    </div>
  </body>
</html>
