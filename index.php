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
        <form class="" action="index.php" method="get">
          <input type="text" name="q" value="" placeholder="search">
          <button type="submit" name="" value="">Search</button>
        </form>
      </div>
      <div class="row main">
        <?php
          require_once('common.php');
          printProducts();
         ?>
      </div>
      <div class="row footer">

      </div>
    </div>
  </div>
</body>
</html>
