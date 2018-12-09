<!-- include libs -->
<?php
	$title = "Cart";
	$stylesheet = "css/cart.css";
	$sidebar = FALSE;
	include("includes/page-head.php");
	include_once("php/cart.php");

  //handle adding items to cart
  if (isset($_POST['addToCart'])) {
    addToCart($_POST['ProductID'], $_POST['quantity']);
  }

  //handle removing items from cart
  if (isset($_POST['RemoveItem'])) {
    removeFromCart($_POST['ID'], $_POST['amount']);
  }

 ?>
 						<div class="row px-5 py-4">
							<div class="card col-12 col-md-8 offset-md-2 p-3 shadow-sm">
								<?php
									//prints the HTML code to generate the items in the cart
									printCartHeader();
									printCart();
									printCartFooter();
								?>
							</div>
        		</div>

<!-- include the footer of the page -->
<?php include("includes/page-foot.php") ?>
