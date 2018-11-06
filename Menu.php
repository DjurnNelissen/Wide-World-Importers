<?php
  session_start();
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link rel="stylesheet" href="css/main.css">

    <title>Test nav bar</title>
  </head>
  <body>
      <div class="nav">
          <a class="navbar-brand">Logo</a>
          <form class="form-inline">
            <input type="search" placeholder="Search">
            <button class="btn btn-outline-succes" type="submit">Search</button>
          </form>
          <div class="nav justify-content-end">
            <ul class="nav justify-content-end">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Active</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Disabled</a>
                </li>
            </ul>
          </div>
    </div>
  </body>
</html>
