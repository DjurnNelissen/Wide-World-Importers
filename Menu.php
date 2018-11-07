
      <div class="nav">
          <a class="navbar-brand">Logo</a>
          <form class="Search" action="index.php" method="get">
            <input type="text" name="q" value=<?php if (isset($_GET['q'])) print("'" . $_GET['q'] . "'")  ?>>
              <button type="submit" name="" value="">Search</button>
          </form>

          <div class="nav justify-content-center">
            <ul class="nav ul">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Categoriën</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Inloggen</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
            </ul>
          </div>
    </div>
