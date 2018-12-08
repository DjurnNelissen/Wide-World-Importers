<!-- include the header of the page -->
<?php
	$title = "Home";
	$stylesheet = FALSE;
	$sidebar = TRUE;
	include("includes/page-head.php");
?>
						<div class="row px-5 py-4">
							<div class="card col shadow-sm">
								<div class="row p-3">
									<div class="col-4">
										<select id='orderSelect' class="" name="order" onchange='searchProducts()'>
											<option value="">Sort</option>
											<option value="nameA" <?php printSelectedOption('nameA') ?> >Name A-Z</option>
											<option value="nameZ" <?php printSelectedOption('nameZ') ?> >Name Z-A</option>
											<option value="priceA" <?php printSelectedOption('priceA') ?> >Price ascending</option>
											<option value="priceD" <?php printSelectedOption('priceD') ?> >Price descending</option>
										</select>
									</div>
									<div class="col-8">
										<?php printNowShowing($_GET) ?>
									</div>
								</div>
								<div class="row p-3">
									<?php printProducts(); ?>
								</div>
							</div>
						</div>
<!-- include the footer of the page -->
<?php include("includes/page-foot.php") ?>
