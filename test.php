<?php
session_start();
include_once('common.php');

//session_destroy();

addToCart(1,1);

var_dump(fetchProductsFromCartAsArray());
?>
