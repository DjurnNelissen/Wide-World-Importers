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
      <div class="col-6 items card shadow-sm">
        <h3>Order Items</h3>
        <div class="row items-header shadow-sm mb-2">
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
      <!-- users NAW gegevens -->
      <div class="col-3 naw">
          <?php
            printDeliveryDetails();
          ?>

        <!-- user input -->
        <div class="row card shadow-sm pb-3 mt-2">
          <div class="col-12">
            <h3>Delivery Comments</h3>
            <!-- delivery intructions -->
            <div class="row">
              <div class="col-12">
                <p>
                  <label for="deliveryInstructions">Delivery instructions</label>

                </p>
                <textarea class="form-control" name="deliveryIntructions" rows="4" cols="25" placeholder="Delivery Instructions"></textarea>
              </div>
            </div>
            <!-- comments -->
            <div class="row">
              <div class="col-12">
                <p>
                  <label for="deliveryComments">Delivery Comment</label>
                </p>
                <textarea class="form-control" name="deliveryComments" rows="4" cols="25" placeholder="Comments"></textarea>
              </div>
            </div>

          </div>
        </div>
        </div>
        <div class="col-3  delivery-method">
          <div class="row card shadow-sm">
            <div class="col-12">
              <h3>Delivery Date</h3>
              <input type="date" name="devDate" value="">
            </div>
          </div>
          <div class="row card shadow-sm">
            <div class="col-12">
              <h3>Delivery method</h3>
              <?php
                printDeliveryMethods();
               ?>
               
            </div>
          </div>
        </div>

      </div>
      <!--footer for total price and stuff -->
      <div class="row card shadow-sm mx-5 mt-1 order-foot">
        <!--price, weight etc.. -->
        <div class="col-6">
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
        <!-- buttons for continue shopping and confirm -->
        <div class="col-3 footer-buttons">
          <div class="row">
              <div class="col-6">
                <button type="button" name="button" class="btn btn-info">Continue shopping</button>
              </div>
              <div class="col-6">
                <button type="button" name="button" class="btn btn-info">Checkout</button>
              </div>
          </div>
        </div>
        <div class="col-3">

        </div>
      </div>
    </div>

  </div>
</div>


 <?php
  include('includes/page-foot.php');
  ?>
