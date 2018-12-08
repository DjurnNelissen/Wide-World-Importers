<?php
session_start();

$_SESSION['devOptions'] = [
  'time' => $_POST['devTime'],
  'date' => $_POST['devDate'],
  'instruction' => trim(filter_input(INPUT_POST, 'devInstructions', FILTER_SANITIZE_STRING)),
  'method' => $_POST['devMethod']
];

header('location: orderoverview.php');

 ?>
