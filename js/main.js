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
  sendPostRequest('api/addToCart.php', 'id=' + ID.toString() + '&amount=' + amount.toString(), function (res) {
    //do stuff with the response

  });
}

function removeFromCart (ID, amount) {
  sendPostRequest('api/removeFromCart.php', 'id=' + ID.toString() + '&amount=' + amount.toString(), function (res) {
    //do stuff with the response

  });
}

function sendPostRequest (url, params, callback) {
  var http = new XMLHttpRequest();
  http.open('POST', url, true);

  //Send the proper header information along with the request
  http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

  http.onreadystatechange = function() {//Call a function when the state changes.
    if(http.readyState == 4 && http.status == 200) {
        callback(http.responseText);
    }
  }

  http.send(params);
}
