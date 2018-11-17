<?php
//session_start();

//this file includes all database related functions

//dictionary that stores DB settings
function getDBsettings () {
  return array (
  'DBserver' => "localhost",
  'DBname'  => "wideworldimporters",
  'DBport' => 3306,

  'DBuser' => "wwi",
  'DBpass' => ''
  );
}

//executes an SQL string and returns the result
function runQuery ($q) {
  //setup the database connection
  $dbSettings = getDBsettings();
  $db = "mysql:host=" . $dbSettings['DBserver'] . ";dbname=" . $dbSettings['DBname'] . ";port=" . $dbSettings['DBport'];
  $pdo = new PDO($db, $dbSettings['DBuser'], $dbSettings['DBpass']);
  //prepare the SQL string
  $stmt = $pdo->prepare($q);
  //execute the SQL
  $stmt->execute();
  //close the conention
  $pdo = null;
  //return the result
  return $stmt;
}

function runQueryWithParams ($q, $p) {
  //setup the database connection
  $dbSettings = getDBsettings();
  $db = "mysql:host=" . $dbSettings['DBserver'] . ";dbname=" . $dbSettings['DBname'] . ";port=" . $dbSettings['DBport'];
  $pdo = new PDO($db, $dbSettings['DBuser'], $dbSettings['DBpass']);
  //prepare the SQL string
  $stmt = $pdo->prepare($q);
  //execute the SQL
  $stmt->execute(array($p));
  //close the conention
  $pdo = null;
  //return the result
  return $stmt;
}

//test function to dump the SQL result
function DumpSql ($stmt) {
  while ($row = $stmt->fetch()) {
    print(var_dump($row));
  }
}

//turns a single dimension array into a string with a comma between each element
function arrayToSQLString ($arr) {
  $sql = "";
  foreach ($arr as $key => $value) {
    $sql = $sql . $value . ',';
  }
  $sql = rtrim($sql,',');
  return $sql;
}

 ?>
