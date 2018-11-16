<?php
session_start();
include_once('php/review.php');
setUser('henk', '123');
 ?>
<script src="js/main.js" charset="utf-8"></script>
<div class="row review" <?php if (!(checkLogin() && userHasPurchashedProduct($_GET['id']) && ! userHasReviewedProduct($_GET['id']))) {
  print ('hidden');}?> >
  <!--only show this if the user has logged in and purchased the product -->
  <div class="col-md 12 rating">
    <input id='rating' type="number" name="rating" value="" min="1" max="5" required>
  </div>
  <div class="col-md-12 comment">
      <input id='comment' type="textarea" name="comment" value="" required>
  </div>
  <button type="submit" name="button" onclick="submitReview(<?php
  //sets the ID of the current product so we know which product we are reviewing
  if (isset($_GET['id'])) {
    print($_GET['id']);
  }
  ?>)">Submit</button>
</div>
</div>
