<?php
  session_start();
  include_once('php/order.php');
  include_once('php/product.php');
  print(getOrderWeight());
 ?>
