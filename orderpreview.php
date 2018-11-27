<?php
$title = "Overview";
$stylesheet = 'css/orderpreview.css';
$sidebar = FALSE;
include("includes/page-head.php");
include_once('php/order.php');
 ?>

  <div class="row mt-1 mx-5 order">
    <div class="col-8 items">
      <div class="row item">
        <!-- item -->
        <div class="col-3">
          <!-- item image -->
          <img class="img-fluid rounded img-thumbnail mx-auto" src="https://sc02.alicdn.com/kf/HTB1wYdzPFXXXXaXapXXq6xXFXXX2/USB-Flash-Drive-8-GB-Memory-Stick.jpg_350x350.jpg" />
        </div>
        <div class="col-3">
          <!-- item name -->
          <p>
            <a href="product.php?id=1">USB green</a>
          </p>
        </div>
        <div class="col-2">
          <!-- item price -->
          <p>
            23.24
          </p>
        </div>
        <div class="col-2">
          <!-- amount -->
          <p>
            3
          </p>
        </div>
        <div class="col-2">
          <!-- total price -->
          69.72
        </div>
      </div>
    </div>
    <!-- users NAW gegevens -->
    <div class="col-4 naw">
        <?php
          printDeliveryDetails();
        ?>
      </div>
      <!-- user input -->
      <div class="row">
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
          <!-- -->
          <div class="row">
            <div class="col-12">
              <p>
                <label for="deliveryComments">Delivery Comment</label>
              </p>
              <textarea class="form-control" name="deliveryComments" rows="4" cols="25" placeholder="comments"></textarea>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
  <!--footer for total price and stuff -->
  <div class="row order-foot">
    <!--price, weight etc.. -->
    <div class="col-8">

    </div>
    <!-- buttons for continue shopping and confirm -->
    <div class="col-4">

    </div>
  </div>

 <?php
  include('includes/page-foot.php');
  ?>
