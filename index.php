<?php
  session_start();
  require_once('common.php');
?>
<html>
<head>
  <title>WWI Webshop</title>

  <link rel="stylesheet" href="css/main.css" media="screen" title="no title">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

  <script src="js/main.js" charset="utf-8"></script>
</head>
<body>
    <?php include('Menu.php') ?>
  <div class="wrapper">
    <div class="container">

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
