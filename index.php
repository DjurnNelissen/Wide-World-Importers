<?php
  session_start();
  require_once('common.php');
  include("menu.php");

?>
<html>
<head>
  <title></title>
  <link rel="stylesheet" href="css/main.css" media="screen" title="no title">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
</head>
<body>
  <div class="wrapper">
    <div class="container">
      <div class="row nav-bar">
        <form class="" action="index.php" method="get">
          <input type="text" name="q" value="" placeholder="search">
          <button type="submit" name="" value="">Search</button>
        </form>
      </div>
      <div class="row main">
        <div class="products">
          <?php
            printProducts();
           ?>
        </div>
        <div class="categories">
          <?php
            printProductCategories();
           ?>
        </div>
      </div>
      <div class="row footer">

      </div>
    </div>
  </div>
</body>
</html>
