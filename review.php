<?php
session_start();
include_once('php/review.php');
setUser('henk', '123');
//var_dump($_SESSION);
//var_dump(checkLogin());
//var_dump(userHasPurchashedProduct($_GET['id']));
$hasPurchased = true;
//var_dump(userHasReviewedProduct($_GET['id']));
 ?>
 <!-- include main.js for js functions -->
<script src="js/main.js" charset="utf-8"></script>
<div class="row review" <?php if (!(checkLogin() && $hasPurchased && ! userHasReviewedProduct($_GET['id']))) {
  print ('hidden');}?> >
  <!--only show this if the user has logged in and purchased the product -->
  <div class="col-md 12 rating">
    <input id='rating' type="number" name="rating" value="1" min="1" max="5" required>
  </div>
  <div class="col-md-12 comment">
        <textarea name="coment" rows="8" cols="40" required id='comment' placeholder="Tell us about your expierence with the product."></textarea>
  </div>
  <button type="submit" name="button" onclick="submitReview(<?php
  //sets the ID of the current product so we know which product we are reviewing
  if (isset($_GET['id'])) {
    print($_GET['id']);
  }
  ?>)">Submit</button>
</div>
</div>
