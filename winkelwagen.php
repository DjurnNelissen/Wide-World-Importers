<?php
  session_start();
  include_once("common.php");
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
            if (checkCart()) {
              if (count($_SESSION['cart']) > 0 ) {
                for ($i=0; $i < count($_SESSION['cart']); $i++) {
                  $product = fetchProduct($_SESSION['cart'][$i]["ID"]);
                  $product = $product->fetch();
                  print($product['StockItemName'] . ' ' . $_SESSION['cart'][$i]['amount'] . 'X <br>');
                  print($product['MarketingComments'] . '<br>');
                }
              } else {
                //cart is empty
                print("cart is empty");
              }
            }
           ?>
        </div>
        <div class="row footer">

        </div>
      </div>
    </div>
  </body>
</html>
