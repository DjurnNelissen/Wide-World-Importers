<?php
  session_start();
  include_once('common.php');
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

        </div>
        <div class="row main">
          <div class="">
            <?php
              $product = fetchProduct($_GET['id']);
              $row = $product->fetch();

              print($row['StockItemName']);
            ?>
          </div>


            <form class="" action="/winkelwagen.php" method="post">
              <input type="number" name="ProductID" value="<?php print($_GET['id']) ?>" hidden>
              <input type="number" name="quantity" value="1" min="1">
              <input type="submit" name="addToCart" value="Add to Cart">
            </form>
        </div>
        <div class="row footer">

        </div>
      </div>
    </div>
  </body>
</html>
