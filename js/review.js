$('#carouselExample').on('slide.bs.carousel', function (e) {


    var $e = $(e.relatedTarget);
    var idx = $e.index();
    var itemsPerSlide = 4;
    var totalItems = $('.carousel-item').length;

    if (idx >= totalItems-(itemsPerSlide-1)) {
        var it = itemsPerSlide - (totalItems - idx);
        for (var i=0; i<it; i++) {
            // append slides to end
            if (e.direction=="left") {
                $('.carousel-item').eq(i).appendTo('.carousel-inner');
            }
            else {
                $('.carousel-item').eq(0).appendTo('.carousel-inner');
            }
        }
    }
});


  $('#carouselExample').carousel({
                interval: 2000
        });


  $(document).ready(function() {
/* show lightbox when clicking a thumbnail */
    $('a.thumb').click(function(event){
      event.preventDefault();
      var content = $('.modal-body');
      content.empty();
        var title = $(this).attr("title");
        $('.modal-title').html(title);
        content.html($(this).html());
        $(".modal-profile").modal({show:true});
    });

    $('#carouselExample').carousel('pause');


  });

function updateRating () {
  document.getElementById('givenRating').innerHTML = document.getElementById('formControlRange').value;

}

//submits a review
function submitReview (ID) {
  //gets the rating the user has given
  var rating = document.getElementById('formControlRange').value;
  //gets the comment the user has given
  var comment = document.getElementById('reviewComment').value;
  //checks if no fields have been left empty
  if ((rating > 0 || comment != '') && ID != null) {
    //sends the data to the server
    sendPostRequest('api/submitReview.php', 'rating=' + rating.toString() + '&comment=' + comment + '&productID=' + ID.toString(), function (res) {
      //do stuff with the response
        if (res == 'success') {
          location.reload();
        } else {
          alert("There was an issue submitting your review, please try again later.");
        }
      });
  } else {
    //please fill in all fields
    alert('Please fill in all fields');
  }
}
