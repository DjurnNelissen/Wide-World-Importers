<?php
/**
 * Created by PhpStorm.
 * User: Axel Broek
 * Date: 23-11-2018
 * Time: 17:47
 */
session_start();
unset($_SESSION["user"]);
header("Location: login.php");
exit();
?>