<?php
session_start();
include_once('../php/order.php');

if (isset($_POST['id'])) {
  print(getDeliveryCosts($_POST['id']));
} else {
  print('0');
}


?>
