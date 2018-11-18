<?php
session_start();
include_once('php/review.php');
 ?>
 <!-- include main.js for js functions -->
 <head>



   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
   <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">


      <link rel="stylesheet" href="css/review.css" media="screen" title="no title">
   <script src="js/main.js" charset="utf-8"></script>
   <script src="js/review.js" charset="utf-8"></script>
 </head>
 <body>
   <div class="container-fluid">
     <div class="row">
      <div class="col-md-9">
        <div id="carouselExample" class="carousel slide" data-ride="carousel" data-interval="9000">
          <div class="carousel-inner row w-100 mx-auto" role="listbox">
           <?php
             printReviews($_GET['id']);
            ?>
          </div>
            <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next text-faded" href="#carouselExample" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
      </div>
      <div class="col-md-3 place-review">
        <form class="form-group" action="" method="post">
          <div class="row">
            <div class="col-md-3">
              <label for="formControlRange" >Rating</label>
            </div>
            <div class="col-md-6">
              <input type="range" class="form-control-range" id="formControlRange" name="rating" min="1" max="5" step="0.1" onchange="updateRating()" value="1">
            </div>
            <div class="col-md-3">
              <span id='givenRating'>1</span>
            </div>
          </div>
          <textarea class="form-control" name="comment" rows="5" cols="30" id="reviewComment"></textarea>
          <button class="btn btn-success" type="button" name="button" onclick="submitReview(<?php print($_GET['id']) ?>)">Place review</button>
        </form>
      </div>
     </div>

 </div>
 </body>
