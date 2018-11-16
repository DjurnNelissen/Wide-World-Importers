<?php
session_start();
include_once('common.php');
if (isset($_POST['id']) && isset($_POST['amount'])) {
  //fetch the common.php
  include_once("../php/cart.php");
  //call add to cart from common.php
  setProductInCartCount($_POST['id'], $_POST['amount']);
  //return success if item added to cart
  print("succes");
} else {
  //if paramaters are missing return error
  print("error");
}
?>
