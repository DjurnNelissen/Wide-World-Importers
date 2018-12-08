<?php
session_start();
include_once('php/account.php');
if (checkLogin()) {
	$c = getLoggedInAccDetails();
} else {
	//redirect to login page

	header("location: login.php");
}
	$title = "Delivery options";
	$stylesheet = FALSE;
	$sidebar = FALSE;
	include_once('php/order.php');

	include("includes/page-head.php");

?>
<div class="row px-5 py-4">
  <div class="card col shadow-sm pb-2">
    <h3>Delivery options</h3>
		<form class="" action="setDeliveryOptions.php" method="post">


		<!--
		<div class="row NAW">
			<div class="col-12">
				<div class="row fullname">
					<div class="col-12">
						<h5>Fullname</h5>
						<input type="text" name="fullname" value="<?php print($c['FullName']) ?>" required>
					</div>
				</div>
				<div class="row deliveryLine1">
					<div class="col-12">
						<h5>Delivery line 1</h5>
						<input type="text" name="line1" value="<?php print($c['DeliveryAddressLine1']) ?>" required>
					</div>
				</div>
				<div class="row deliveryLine2">
					<div class="col-12">
						<h5>Delivery line 2</h5>
						<input type="text" name="line2" value="<?php print($c['DeliveryAddressLine2']) ?>" required>
					</div>
				</div>
				<div class="row postalcode">
					<div class="col-12">
						<h5>Postalcode</h5>
						<input type="text" name="devPostal" value="<?php print($c['DeliveryPostalCode']) ?>" required>
					</div>
				</div>
				<div class="row e-mail">
					<div class="col-12">
						<p>

						</p>
					</div>
				</div>
				<div class="row phone">
					<div class="col-12">
						<p>

						</p>
					</div>
				</div>
			</div>
		</div>
		 -->
    <div class="row date">
      <div class="col-12">
        <h5>Delivery date</h5>
        <input type="date" name="devDate"
				 <?php
				 		$currentDate = date('Y-m-d', time());
						$Date = date('Y-m-d',strtotime($currentDate. ' + 1 days'));
						print("min='$Date'");
						if (isset($_SESSION['devOptions'])) {
							print("value='" . $_SESSION['devOptions']['date'] . "'");
						} else {
								print("value='$Date'");
						}

				  ?>
				 required >
      </div>
    </div>
		<div class="row time">
			<div class="col-12">
				<h5>Preferred delivery time</h5>
				<input type="time" name="devTime" value="<?php
					if (isset($_SESSION['devOptions'])) {
						print ($_SESSION['devOptions']['time']);
					} else {
						print('12:00');
					}
				 ?>" required>
			</div>
		</div>
    <div class="row method">
      <div class="col-12">
        <h5>Delivery method</h5>
        <select class="" name="devMethod" required>
          <?php
            printDeliveryMethods();
          ?>
        </select>
      </div>
    </div>
		<div class="row comment">
			<div class="col-3">
				<h5>Delivery instructions</h5>
				<textarea class="form-control" name="devInstructions" rows="4" cols="40" placeholder="Delivery instructions">
					<?php
						if (isset($_SESSION['devOptions'])) {
							print($_SESSION['devOptions']['instruction']);
						}
					 ?>
				</textarea>
			</div>
		</div>
		<div class="row buttons mt-2">
			<div class="col-2">
				<a href="winkelwagen.php"><button class="btn btn-info" type="button" name="button">Back to cart</button></a>
			</div>
			<div class="col-2">
				<button class="btn btn-success" type="submit" name="button">Next</button>
			</div>
		</div>
		</form>
  </div>
</div>
<!-- include the footer of the page -->
<?php include("includes/page-foot.php") ?>
