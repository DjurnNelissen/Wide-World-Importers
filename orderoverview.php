<?php
$title = "Overview";
$stylesheet = 'css/orderpreview.css';
$sidebar = FALSE;
include("includes/page-head.php");
include_once('php/order.php');
include_once('php/cart.php');
 ?>
<div class="row">
  <div class="col-12">
    <div class="row mt-1 mx-5 order">
      <!--order items are displayed here -->
      <div class="col-6 card shadow-sm items">
        <h3>Order Items</h3>
        <div class="row mb-2 shadow-sm items-header">
          <div class="col-3">

          </div>
          <div class="col-3">
            <p>
              Product-name
            </p>
          </div>
          <div class="col-2">
            <p>
              Product-price
            </p>
          </div>
          <div class="col-2">
            <p>
              Quantity
            </p>
          </div>
          <div class="col-2">
            <p>
              Total-price
            </p>
          </div>
        </div>
        <?php
          printOrderItems();
         ?>

      </div>
      <!-- order details are displayed here -->
      <div class="col-6 details">
        <div class="row">
          <!-- NAW -->
          <div class="col-6 card shadow-sm">
            <?php
              printDeliveryDetails();
             ?>
          </div>
          <!-- delivery date-->
          <div class="col-6 card shadow-sm">
            <h3>Delivery date</h3>
            <input type="date" name="delivery-date" value="">
          </div>
        </div>
        <div class="row">
          <!-- delivery comments -->
          <div class="col-6 card shadow-sm pb-2">
            <div class="row">
              <div class="col-12">
                <h3>Delivery instructions</h3>
                <textarea class="form-control" name="deliveryIntructions" rows="4" cols="25" placeholder="Delivery Instructions"></textarea>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <h3>Delivery comments</h3>
                <textarea class="form-control" name="deliveryComments" rows="4" cols="25" placeholder="Comments"></textarea>
              </div>
            </div>
          </div>
          <!-- delivery method -->
          <div class="col-6 card shadow-sm">
            <h3>Delivery methods</h3>
            <?php
              printDeliveryMethods();
             ?>
          </div>
        </div>
      </div>
    </div>
    <!-- footer showing total cost and confirm button -->
    <div class="row mt-1 mx-5 order-footer">
      <!--items footer -->
      <div class="col-6 card shadow-sm py-2">
        <div class="row">
          <div class="col-3">

          </div>
          <div class="col-3">

          </div>
          <div class="col-2">
            <p>
              Weight: <?php print(getOrderWeight()) ?> KG
            </p>
          </div>
          <div class="col-2">
            <p>
              Items: <?php print(getTotalItemsInCart()); ?>
            </p>
          </div>
          <div class="col-2">
            <p>
              Total: € <?php print(getTotalCartPrice()); ?>
            </p>
          </div>
        </div>
      </div>
      <!-- comments / naw footer-->
      <div class="col-3 card shadow-sm py-2">
        <div class="row">
            <div class="col-6">
              <button type="button" name="button" class="btn btn-info">Continue shopping</button>
            </div>
            <div class="col-6">
              <button type="button" name="button" class="btn btn-info">Checkout</button>
            </div>
        </div>
      </div>
      <!-- delivery options footer -->
      <div class="col-3 card shadow-sm py-2">

      </div>
    </div>
  </div>
</div>

<?php
 include('includes/page-foot.php');
 ?>
