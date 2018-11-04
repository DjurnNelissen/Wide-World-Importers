<?php
  session_start();
?>
<html>
<head>
  <title></title>
  <link rel="stylesheet" href="/css/main.css" media="screen" title="no title">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
</head>
<body>
  <div class="wrapper">
    <div class="container">
      <div class="row nav-bar">

      </div>
      <div class="row main">
        <?php
          require_once('common.php');
          addToCart(1,1);
          DumpSql(fetchProductsFromCart());
         ?>
      </div>
      <div class="row footer">

      </div>
    </div>
  </div>
</body>
</html>
