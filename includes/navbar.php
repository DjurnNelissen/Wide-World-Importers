<nav class="navbar navbar-expand-lg navbar-light">
	<a class="navbar-brand" href="index.php">
    <img class="nav-logo" src="img/logo-new.png" alt="">
  </a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">

		<input id='search' class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="q" value="<?php if (isset($_GET['q'])) print($_GET['q']) ?>">
		<button class="btn btn-outline-info my-2 my-sm-0 btn-nav-search" type="button" onclick="searchProducts()"><i class="fas fa-search"></i></button>


		<ul class="navbar-nav">
			<li class="nav-item active">
				<a class="nav-link" href="index.php"><i class="fas fa-store"></i> Home<span class="sr-only">(current)</span></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="winkelwagen.php"><i class="fas fa-shopping-cart"></i> Cart</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="login.php"><i class="fas fa-user"></i> Login</a>
			</li>
		</ul>
	</div>
</nav>
