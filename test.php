<?php
  session_start();
  include_once('php/account.php');
  include_once('php/order.php');
  include_once('php/db.php');

  setUser('kaylaw@wideworldimporters.com','123');

  printOrders();
 ?>
