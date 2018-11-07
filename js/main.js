function searchCategory (categoryID) {

  var url = new URL(window.location.href);

  var query_string = url.search;

  var search_params = new URLSearchParams(query_string);

  search_params.delete('c');

if (categoryID != 'all') {
  search_params.append('c',categoryID);
}
  url.search = search_params.toString();

  var new_url = url.toString();

  location.href = new_url;
}

//adds a product to the cart
function addToCart (ID, amount) {
  var http = new XMLHttpRequest();
  var url = 'api/addToCart.php';
  var params = 'id=' + ID.toString() + '&amount=' + amount.toString();
  http.open('POST', url, true);

  //Send the proper header information along with the request
  http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

  http.onreadystatechange = function() {//Call a function when the state changes.
    if(http.readyState == 4 && http.status == 200) {
        alert(http.responseText);
    }
  }

  http.send(params);
}
