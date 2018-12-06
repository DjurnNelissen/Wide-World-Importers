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
			<li id="Home" class="nav-item">
				<a class="nav-link" href="index.php"><i class="fas fa-store"></i> Home<span class="sr-only">(current)</span></a>
			</li>
			<li id="Cart" class="nav-item">
				<a class="nav-link" href="winkelwagen.php"><i class="fas fa-shopping-cart"></i> Cart</a>
			</li>
			<li id="Login" class="nav-item">
				<a class="nav-link" href="login.php"><i class="fas fa-user"></i> Login</a>
			</li>
		</ul>
	</div>
</nav>
<script>
	var page = "<?php echo $title ?>";
	if (page == "Home"){
		var navItem = document.getElementById("Home");
		navItem.className += " " + "active";
	} else if (page == "Cart"){
		var navItem = document.getElementById("Cart");
		navItem.className += " " + "active";
	} else if (page == "Login"){
		var navItem = document.getElementById("Login");
		navItem.className += " " + "active";
	}
</script>