<!-- include the header of the page -->
<?php
    $title = "Orderhistory";
    $stylesheet = "css/product.css";
    $sidebar = FALSE;
    include("includes/page-head.php");
?>

<div class="row px-5 py-4">
    <div class="card col shadow-sm">
        <div class="row p-3">
            <h1>Orderhistory</h1>
        </div>

        <div class="row p-3">
            <div class="accordion col-12" id="accordionExample">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <div class="row">
                        <h6 class="col-12 col-md-2 my-auto">15</h6>
                        <h6 class="col-12 col-md-3 my-auto"> 03-01-1997</h6>
                        <h6 class="col-12 col-md-3 my-auto">€97,12</h6>
                        <h6 class="col-12 col-md-3 my-auto">Verwerkt</h6>
                        <button class="btn btn-link col-1" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="True" aria-controls="collapseOne">
                        Open</button>

                        </div>
                    </div>

                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <div class="row">
                            <h6 class="col-2 my-auto">15</h6>
                            <h6 class="col-3 my-auto">03-05-2017</h6>
                            <h6 class="col-3 my-auto">€97,23</h6>
                            <h6 class="col-3 my-auto">Verwerkt</h6>
                            <button class="btn btn-link col-1 collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Open
                            </button>

                        </div>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="card-body">
                            <div class="row">
                                <h6 class="col-2 my-auto">Productnr</h6>
                                <h6 class="col-3 my-auto">Artikel</h6>
                                <h6 class="col-3 my-auto">Aantal</h6>
                                <h6 class="col-3 my-auto">Prijs p.s</h6>
                                <h6 class="col-1 my-auto">Prijs totaal</h6>
                            </div>
                            <div class="row">
                                <p class="col-2 my-auto">3461</p>
                                <p class="col-3 my-auto">Mugs</p>
                                <p class="col-3 my-auto">2</p>
                                <p class="col-3 my-auto">€1,34</p>
                                <p class="col-1 my-auto">€2,68</p>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Collapsible Group Item #3
                                </button>
                            </h5>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                            <div class="card-body">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
</div>


<?php include("includes/page-foot.php");
