<?php
  //load libs
  include("includes/page-head.php");

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
							<div class="card col shadow-sm">
								<div class="row p-3">
									<?php
										//prints the HTML code to generate the items in the cart
										printCart();
									?>
								</div>
							</div>
        		</div>

<!-- include the footer of the page -->
<?php include("includes/page-foot.php") ?>
