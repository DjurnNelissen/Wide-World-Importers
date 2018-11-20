
<!-- include the header of the page -->
<?php include("includes/page-head.php") ?>
						<div class="row px-5 py-4">
							<div class="card col shadow-sm">
								<div class="row p-3">
									<!-- Gegevens product uit url halen -->
									<?php
										$product = fetchProduct($_GET['id']);
										$row = $product->fetch();
									?>

									<div class="row">
										<div class="col">
											<!-- Afbeelding product -->
											<div class="col-12 product-image">
												<img class="img-fluid rounded img-thumbnail" src="https://sc02.alicdn.com/kf/HTB1wYdzPFXXXXaXapXXq6xXFXXX2/USB-Flash-Drive-8-GB-Memory-Stick.jpg_350x350.jpg" />
											</div>

											<!-- Miniatuur afbeelding product -->
											<div class="col-12">
												<div class="col-4 product-image">
													<img class="rounded img-thumbnail" src="https://sc02.alicdn.com/kf/HTB1wYdzPFXXXXaXapXXq6xXFXXX2/USB-Flash-Drive-8-GB-Memory-Stick.jpg_350x350.jpg" />
												</div>

												<div class="col-4 product-image">
													<img class="rounded img-thumbnail" src="https://sc02.alicdn.com/kf/HTB1wYdzPFXXXXaXapXXq6xXFXXX2/USB-Flash-Drive-8-GB-Memory-Stick.jpg_350x350.jpg" />
												</div>

												<div class="col-4 product-image">
													<img class="rounded img-thumbnail" src="https://sc02.alicdn.com/kf/HTB1wYdzPFXXXXaXapXXq6xXFXXX2/USB-Flash-Drive-8-GB-Memory-Stick.jpg_350x350.jpg" />
												</div>
											</div>
										</div>

										<div class="col">
											<!-- Naam product -->
											<div class="col-12">
												<h1><?php print($row['StockItemName']); ?></h1>
											</div>

											<!-- Merk product -->
											<?php
												if ($row['Brand']) {
													print('<div class="col-12">
																	 <label>Brand:</label>
																	 <p>' . $row['Brand'] . '</p>
																 </div>');
												}
											 ?>

											<!-- Beschrijving product -->
											<?php
												if ($row['MarketingComments']) {
													print('<div class="col-12">
																	 <label>Description:</label>
																	 <p>' . $row['MarketingComments'] . '</p>
																 </div>');
												}
											 ?>

											<!-- Gewicht product -->
											<div class="col-12">
												<label>Weight:</label>
												<p><?php print($row['TypicalWeightPerUnit']); ?> Kg</p>
											</div>

											<!-- Voorraad product -->
											<!--
												if ($row['ProductStock']) {
													print('<div class="col-12 my-4">
																	 <span class="badge badge-light p-2">' . $row['ProductStock'] . ' in stock</span>
																 </div>');
												}
											 -->

											<!-- Prijs product -->
											<div class="col-4">
												<label>Price:</label>
												<p><b>€ <?php print($row['RecommendedRetailPrice']); ?></b></p>
											</div>

											<!-- Winkelwagen knop -->
											<div class="col-8">

												<form class="" action="winkelwagen.php" method="post">
													<div class="form-group">
														<input type="number" name="ProductID" value="<?php print($_GET['id']) ?>" hidden>
														<label for="quantity">Quantity:</label>
														<input type="number" name="quantity" id="quantity" class="form-control col-6 product-number" value="1" min="1">

														<button type="submit" name="addToCart" class="btn btn-primary col-6"><i class="fas fa-shopping-cart"></i> Add to cart</button>
													</div>
												</form>

											</div>

											<!-- Kleur product -->
											<?php
												if ($row['ColorName']) {
													print('<div class="col-12">
																	 <label>Color:</label><br>
																	 <input type="checkbox" class="product-checkbox ' . $row['ColorName'] . '">
																 </div>');
												}
											 ?>

											<!-- Maat product -->
											<!--
												if ($row['ProductSize']) {
													print('<div class="col-12 my-4">
																	 <select class="custom-select col col-md-3 product-select">
																		 <option value="' . $row['ProductSize'] . '">' . $row['ProductSize'] . '</option>
																	 </select>
																 </div>');
												}
											 -->

											<!-- Specificaties product -->
											<!--
												if ($row['ProductSpecifications']) {
													print('<div class="col-12">
																	 <p>' . $row['ProductSpecifications'] . '</p>
																 </div>');
												}
											 -->

										</div><!-- .col -->
									</div><!-- .row -->
									<div class="row">
										<?php include_once("review.php"); ?>
									</div>
								</div><!-- .row -->
							</div><!-- .card -->
						</div><!-- .row -->

<!-- include the footer of the page -->
<?php include("includes/page-foot.php") ?>
