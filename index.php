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
        $conn = new mysqli($servername, $username, $password, $DBname);

        $sql = "SELECT * FROM stockitems";

        $result = $conn->query($sql);


        if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
            print("<div>");
            print("<a href='index.php?id=" . $row['StockItemID'] .  "'>" . $row['StockItemName'] . "</a>");
            print("</div>");
          }
        }

         ?>
      </div>
      <div class="row footer">

      </div>
    </div>
  </div>
</body>
</html>
