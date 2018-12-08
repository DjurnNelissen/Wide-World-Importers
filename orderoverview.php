<?php
session_start();
include_once('php/account.php');
if (! checkLogin()) {
  header('location: login.php');
} else if (! isset($_SESSION['devOptions'])) {
  header('location: delivery.php');
}
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
      <div class="col-8 card shadow-sm items ">
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
      <div class="col-4 details">
        <div class="row">
          <!-- NAW -->
          <div class="col-12">
            <?php
              printDeliveryDetails();
             ?>
          </div>
        </div>
        <div class="row">
          <div class="col-12 card shadow-sm py-1">
            <h3>Delivery details</h3>
            <div class="row">
             <div class="col-6">
               <p>
                 Delivery date
               </p>
             </div>
             <div class="col-6">
                 <p>
                   <?php print($_SESSION['devOptions']['date']); ?>
                 </p>
             </div>
            </div>
            <div class="row">
             <div class="col-6">
               <p>
                 Preferred delivery time
               </p>
             </div>
             <div class="col-6">
                 <p>
                   <?php print($_SESSION['devOptions']['time']); ?>
                 </p>
             </div>
            </div>
            <div class="row">
             <div class="col-6">
               <p>
                 Delivery method
               </p>
             </div>
             <div class="col-6">
                 <p>
                   <?php print(getDeliveryMethodName($_SESSION['devOptions']['method'])); ?>
                 </p>
             </div>
            </div>
            <div class="row">
             <div class="col-6">
               <p>
                 Delivery cost
               </p>
             </div>
             <div class="col-6">
                 <p>
                   € <?php print(getDeliveryCosts($_SESSION['devOptions']['method'])); ?>
                 </p>
             </div>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- delivery comments -->
          <div class="col-12 card shadow-sm pb-2">
            <div class="row">
              <div class="col-12">
                <h3>Delivery instructions</h3>
                <textarea class="form-control" name="deliveryIntructions" rows="4" cols="25" placeholder="Delivery Instructions" disabled>
                  <?php
                    print($_SESSION['devOptions']['instruction']);
                   ?>
                </textarea>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
    <!-- footer showing total cost and confirm button -->
    <div class="row mt-1 mx-5 order-footer">
      <!--items footer -->
      <div class="col-8 card shadow-sm py-2">
        <div class="row">
          <div class="col-3">
            <a href="delivery.php"><button class="btn btn-info" type="button" name="button">Back</button></a>
          </div>
          <div class="col-3">

          </div>
          <div class="col-2">
            <p>
              Weight: <?php print(getCartWeight()) ?> KG
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
      <div class="col-4 card shadow-sm py-2">
        <div class="row">
            <div class="col-6">
              <button type="button" name="button" class="btn btn-info">Continue shopping</button>
            </div>
            <div class="col-6">
              <button type="button" name="button" class="btn btn-info">Checkout</button>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
 include('includes/page-foot.php');
 ?>
