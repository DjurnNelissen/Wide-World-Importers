<!-- include the header of the page -->
<?php
session_start();
include_once('php/account.php');
if (! checkLogin()) {
  header('location: login.php');
}
    $title = "Orderhistory";
    $stylesheet = "css/product.css";
    $sidebar = FALSE;
    include("includes/page-head.php");

include('php/order.php')


?>


<div class="row px-5 py-4">
    <div class="card col shadow-sm">
        <div class="row p-3">
            <h1>Order history</h1>
        </div>

        <div class="row p-3">
            <div class="accordion col-12" id="accordionExample">
                <div class="card">
                  <div class='card-header' >
                      <div class='row'>
                          <h6 class='col-12 col-sm-2 my-auto'> Order ID</h6>
                          <h6 class='col-12 col-sm-2 my-auto'>Placed Date</h6>
                          <h6 class='col-12 col-sm-2 my-auto'>Expected Delivery Date</h6>
                          <h6 class='col-12 col-sm-2 my-auto'>Total price</h6>
                          <h6 class='col-12 col-sm-3 my-auto'>Status </h6>
                      </div>
                  </div>
                  <?php
                    printPlacedOrders();
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include("includes/page-foot.php"); ?>
