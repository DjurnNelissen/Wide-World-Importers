<!-- include the header of the page -->
<?php
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
                    <div class="card-header" id="headingOne">
                        <div class="row">
                            <h6 class="col-12 col-sm-2 my-auto">15</h6>
                            <h6 class="col-12 col-sm-3 my-auto"> 03-01-1997</h6>
                            <h6 class="col-12 col-sm-3 my-auto">€97,12</h6>
                            <h6 class="col-12 col-sm-3 my-auto">Verwerkt</h6>
                            <button class="btn btn-link col-1" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="True" aria-controls="collapseOne">
                                Open</button>
                        </div>
                    </div>
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                            <div class="row">
                                <h6 class="col-12 col-sm-2 my-auto">Productnr</h6>
                                <h6 class="col-12 col-sm-3 my-auto">Artikel</h6>
                                <h6 class="col-12 col-sm-3 my-auto">Aantal</h6>
                                <h6 class="col-12 col-sm-3 my-auto">Prijs p.s.</h6>
                                <h6 class="col-12 col-sm-1 my-auto">Prijs totaal</h6>
                            </div>
                            <div class="row">
                                <p class="col-12 col-sm-2 my-auto">3461</p>
                                <p class="col-12 col-sm-3 my-auto">Mugs</p>
                                <p class="col-12 col-sm-3 my-auto">2</p>
                                <p class="col-12 col-sm-3 my-auto">€1,34</p>
                                <p class="col-12 col-sm-1 my-auto">€2,68</p>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <div class="row">
                                <h6 class="col-12 col-sm-2 my-auto">16</h6>
                                <h6 class="col-12 col-sm-3 my-auto">03-05-2017</h6>
                                <h6 class="col-12 col-sm-3 my-auto">€106,23</h6>
                                <h6 class="col-12 col-sm-3 my-auto">Verwerkt</h6>
                                <button class="btn btn-link col-1 collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Open
                                </button>

                            </div>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                            <div class="card-body">
                                <div class="row">
                                    <h6 class="col-12 col-sm-2 my-auto">Productnr</h6>
                                    <h6 class="col-12 col-sm-3 my-auto">Artikel</h6>
                                    <h6 class="col-12 col-sm-3 my-auto">Aantal</h6>
                                    <h6 class="col-12 col-sm-3 my-auto">Prijs p.s.</h6>
                                    <h6 class="col-12 col-sm-1 my-auto">Prijs totaal</h6>
                                </div>
                                <div class="row">
                                    <p class="col-12 col-sm-2 my-auto">3461</p>
                                    <p class="col-12 col-sm-3 my-auto">Mugs</p>
                                    <p class="col-12 col-sm-3 my-auto">2</p>
                                    <p class="col-12 col-sm-3 my-auto">€1,34</p>
                                    <p class="col-12 col-sm-1 my-auto">€2,68</p>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingThree">
                                <div class="row">
                                    <h6 class="col-12 col-sm-2 my-auto">17</h6>
                                    <h6 class="col-12 col-sm-3 my-auto"> 03-02-2018</h6>
                                    <h6 class="col-12 col-sm-3 my-auto">€57,12</h6>
                                    <h6 class="col-12 col-sm-3 my-auto">Verwerkt</h6>
                                    <button class="btn btn-link col-1" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="True" aria-controls="collapseThree">
                                        Open</button>
                                </div>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="row">
                                        <h6 class="col-12 col-sm-2 my-auto">Productnr</h6>
                                        <h6 class="col-12 col-sm-3 my-auto">Artikel</h6>
                                        <h6 class="col-12 col-sm-3 my-auto">Aantal</h6>
                                        <h6 class="col-12 col-sm-3 my-auto">Prijs p.s.</h6>
                                        <h6 class="col-12 col-sm-1 my-auto">Prijs totaal</h6>
                                    </div>
                                    <div class="row">
                                        <p class="col-12 col-sm-2 my-auto">3461</p>
                                        <p class="col-12 col-sm-3 my-auto">Mugs</p>
                                        <p class="col-12 col-sm-3 my-auto">2</p>
                                        <p class="col-12 col-sm-3 my-auto">€1,34</p>
                                        <p class="col-12 col-sm-1 my-auto">€2,68</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include("includes/page-foot.php");
