<?php

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

function DumpSql ($stmt) {
  while ($row = $stmt->fetch()) {
    print(var_dump($row));
  }
}

DumpSql(runQuery('SELECT * FROM stockitems'));

?>
