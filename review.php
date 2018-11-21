<?php
include_once('php/review.php');
include_once('php/account.php');
 ?>
<!-- include main.js for js functions -->
<link rel="stylesheet" href="css/review.css" media="screen" title="no title">
<script src="js/review.js" charset="utf-8"></script>

<div class="col-12 my-5 mx-3">
  <h5><?php
  if (productHasReviews($_GET['id'])) {
      print("rating: " . getAverageRating($_GET['id'])  . " out of 5, ");
  }
   print(getReviewCount($_GET['id'])); ?> Review(s):</h5>
	<?php printReviews($_GET['id']); ?>
</div>

<div class="col-12 my-5 mx-3">
	<div class='card'>
		<div class='card-header'>
			<b>Write your own review:</b>
		</div>
		<div class='card-body'>
			<form class="form-group" action="" method="post">
				<h5 class='card-title'><span id='givenRating'>0</span>/5 stars</h5>

				<input type="range" class="form-control-range my-3 mx-auto" id="formControlRange" name="rating" min="1" max="5" step="0.5" onchange="updateRating()" value="1" <?php printDisabled($_GET['id']); ?>>

				<textarea class="form-control" name="comment" rows="5" cols="30" id="reviewComment" <?php printDisabled($_GET['id']); ?>></textarea>

				<button type="button" class="btn btn-primary my-3 mx-auto" name="button" onclick="submitReview(<?php print($_GET['id']) ?>)" <?php printDisabled($_GET['id']); ?>>Submit review</button>
			</form>
		</div>
	</div>
</div>
