<?php
  session_start();
  include_once('php/cart.php');
  include_once('php/order.php');
  addToCart(1,1);
  print(getDeliveryCosts(4));

 ?>
