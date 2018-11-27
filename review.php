<?php
include_once('php/review.php');
include_once('php/account.php');
 ?>
<!-- include main.js for js functions -->
<link rel="stylesheet" href="css/review.css" media="screen" title="no title">
<script src="js/review.js" charset="utf-8"></script>

<div class="col-12 my-5 mx-3">
  <div class="row my-2 px-2">
    <div class="col-2">
      <h5> <?php print(getAverageRating($_GET['id'])) ?>/5 stars </h5>
    </div>
    <div class="col-2">
      <div class='stars-outer'>
        <div class='stars-inner' style='width:<?php print(getRatingPercentageRounded(getAverageRating($_GET['id'])) . "%") ?>'>
        </div>
      </div>
    </div>
    <div class="col-2">
      <h5>  Review(s): <?php print(getReviewCount($_GET['id'])) ?> </h5>
    </div>
    <div class="col-6">

    </div>
  </div>



	<?php printReviews($_GET['id']); ?>
</div>

<div class="col-12 my-5 mx-3">
	<div class='card'>
		<div class='card-header'>
			<b>Write your own review:</b>
		</div>
    <!-- alert for already reviewed -->
    <div class="alert alert-success mx-5 my-3" role="alert" <?php if (! userHasReviewedProduct($_GET['id']) ||  ! userHasPurchashedProduct($_GET['id'])) print('hidden') ?>>
      You already have reviewed this product.
    </div>
    <!-- alert for login -->
    <div class="alert alert-info mx-5 my-3" role="alert" <?php if (checkLogin()) print('hidden') ?>>
      You need to login to review this product.
    </div>
    <!-- alert for not purchased -->
    <div class="alert alert-info mx-5 my-4" role="alert" <?php if (userHasPurchashedProduct($_GET['id']) || ! checkLogin()) print('hidden') ?>>
      You need to purchase this product, before you can review it.
    </div>
		<div class='card-body'>
			<form class="form-group" action="" method="post">
				<h5 class='card-title'><span id='givenRating'>0</span>/5 stars</h5>

				<input type="range" class="form-control-range my-3 mx-auto" id="formControlRange" name="rating" min="0" max="5" step="0.5" onchange="updateRating()" value="0" <?php printDisabled($_GET['id']); ?>>

				<textarea class="form-control" name="comment" rows="5" cols="30" id="reviewComment" <?php printDisabled($_GET['id']); ?>></textarea>

				<button type="button" class="btn btn-primary my-3 mx-auto" name="button" onclick="submitReview(<?php print($_GET['id']) ?>)" <?php printDisabled($_GET['id']); ?>>Submit review</button>
			</form>
		</div>
	</div>
</div>
