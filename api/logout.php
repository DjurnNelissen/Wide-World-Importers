<?php
session_start();
//unsets the user
if (isset($_SESSION['user'])) {
  unset($_SESSION['user']);
}

 ?>
