<?php
session_start();
include_once('php/review.php');
include_once('php/account.php');

setUser('kaylaw@wideworldimporters.com','123');

var_dump(checkLogin());

var_dump(userHasPurchashedProduct(1));

var_dump(userHasReviewedProduct(1));

var_dump(getPersonID());

var_dump(password_hash('123', PASSWORD_DEFAULT));

?>
