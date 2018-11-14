<?php
session_start();
include_once('common.php');

//session_destroy();

addToCart(1,1);

setProductInCartCount(18,20);

var_dump(fetchProductsFromCartAsArray());
?>
