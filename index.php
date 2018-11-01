<?php
session_start();


?>
<html>
<head>
  <title></title>
  <link rel="stylesheet" href="/css/main.css" media="screen" title="no title">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
</head>
<body>
  <div class="wrapper">
    <div class="container">
      <div class="row nav-bar">

      </div>
      <div class="row main">
        <?php
        $servername = "localhost";
        $username = "wwi";
        $password = "";
        $DBname = "wideworldimporters";

        // Create connection
        try {
          $conn = new PDO("mysql:host=$servername;dbname=" . $DBname, $username, $password);
          // set the PDO error mode to exception
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e)
        {
          echo "Connection failed: " . $e->getMessage();
        }

    

         ?>
      </div>
      <div class="row footer">

      </div>
    </div>
  </div>
</body>
</html>
