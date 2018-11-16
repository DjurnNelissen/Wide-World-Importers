<?php
session_start();
include_once('common.php');
 ?>
<script src="js/main.js" charset="utf-8"></script>
<div class="row review">
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
<!--only show this if the user isnt logged in -->
<div class="row login-error">
  <div class="col-md-12">
    Login to review this product.
  </div>
</div>
<!--only show this if the user is logged in and hasnt purchased the product -->
<div class="row not-purchased-error">
  <div class="col-md-12">
    Purchase this product to review it.
  </div>
</div>
