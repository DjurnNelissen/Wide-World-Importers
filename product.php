<?php
  session_start();
  include_once('php/product.php');
  include_once('php/review.php');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/css/main.css" media="screen" title="no title">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <title>WWI Webshop</title>
  </head>
  <body>
    <?php include("Menu.php") ?>
    <section class="container">

        <div class="row">
        <figure class="col-sm-6">
            <img  class="img-responsive" src="https://sc02.alicdn.com/kf/HTB1wYdzPFXXXXaXapXXq6xXFXXX2/USB-Flash-Drive-8-GB-Memory-Stick.jpg_350x350.jpg"/>
            </figure>
        <div class="col-sm-6">
            <div class="row">
                <?php
                    $product = fetchProduct($_GET['id']);
                    $row = $product->fetch(); ?>
                <h1><?php print($row['StockItemName']); ?> </h1>
                 </div>
            <div class="row">
                <p>Gewicht:  <?php print($row['TypicalWeightPerUnit']); ?></p>
            </div>
            <div class="row">
                <p>Prijs: € <?php  print($row['RecommendedRetailPrice']); ?></p>
            </div>
            <div class="row">
                <p>Belasting: <?php print($row['TaxRate']); ?> %</p>
            </div>
            <div class="row">
                <p><?php if ($row['MarketingComments'] != "") {
                  print("Beschrijving: " . $row['MarketingComments']);
              }
               ?></p>
            </div>

            <div class="row">
                <p><?php

              if ($row['ColorName'] != "") {
                  print("Kleur: " . $row['ColorName']);
              }
              ?>

                </p>
            </div>
            <div class="row">
                <p><?php
              if ($row['Brand'] != "") {
                  print("Merk: " . $row['Brand']);
              }
              ?>
                </p>
            </div>
            <div class="row">
                <form class="" action="../winkelwagen.php" method="post">
            </div>
            <div class="row">
              <?php
              if ($row['Size'] != "") {
                  print("Maat: " . $row['Size']);
              }
               ?>
            </div>
          </div>


            <form class="" action="../winkelwagen.php" method="post">
              <input type="number" name="ProductID" value="<?php print($_GET['id']) ?>" hidden>
              <input type="number" name="quantity" value="1" min="1">
              <input type="submit" name="addToCart" value="Add to Cart">
            </form>
            </div>
        </div>

        <?php
        print ("<div> Average rating: " . round(getAverageRating($_GET['id']),1) . " </div>");
        printReviews($_GET['id']);
        ?>

      </section>












  </body>
</html>
