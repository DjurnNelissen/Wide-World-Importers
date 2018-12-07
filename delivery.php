<!-- include the header of the page -->
<?php
	$title = "Delivery options";
	$stylesheet = FALSE;
	$sidebar = FALSE;
	include_once('php/order.php');
	include("includes/page-head.php");

?>
<div class="row px-5 py-4">
  <div class="card col shadow-sm">
    <h3>Delivery options</h3>
		<?php
			printDeliveryDetails();
		 ?>
    <div class="row date">
      <div class="col-12">
        <h5>Delivery date</h5>
        <input type="date" name="devDate" value="">
      </div>
    </div>
		<div class="row time">
			<div class="col-12">
				<h5>Delivery time</h5>
				<input type="time" name="devTime" value="">
			</div>
		</div>
    <div class="row method">
      <div class="col-12">
        <h5>Delivery method</h5>
        <select class="" name="devMethod">
          <?php
            printDeliveryMethods();
          ?>
        </select>
      </div>
    </div>
		<div class="row comment">
			<div class="col-12">
				<h5>Delivery instructions</h5>
				<textarea name="devInstructions" rows="4" cols="40"></textarea>
			</div>
		</div>

  </div>
</div>
<!-- include the footer of the page -->
<?php include("includes/page-foot.php") ?>
