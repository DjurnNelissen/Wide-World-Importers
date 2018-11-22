<!-- include the header of the page -->
<?php include("includes/page-head.php"); ?>
						<div class="row px-5 py-4">
							<div class="card col shadow-sm">
								<div class="row p-3">
									<select id='orderSelect' class="" name="order" onchange='sortSearch()'>
										<option value="">Sort</option>
										<option value="nameA">Name A-Z</option>
										<option value="nameZ">Name Z-A</option>
										<option value="priceA">Price ascending</option>
										<option value="priceD">Price descending</option>
									</select>
								</div>
								<div class="row p-3">
									<?php printProducts(); ?>
								</div>
							</div>
						</div>
<!-- include the footer of the page -->
<?php include("includes/page-foot.php") ?>
