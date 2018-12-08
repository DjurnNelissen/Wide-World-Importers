function searchProducts (cat) {
  var orderElement = document.getElementById('orderSelect');

  if (orderElement != null) {
    var order = orderElement.value;
  }

  var search = document.getElementById('search').value;

  var url = new URL(window.location.href);

  var query_string = url.search;
  //gets the params from the url
  var search_params = new URLSearchParams(query_string);

  search_params.delete('q');
  if (search != '') {
    search_params.append('q',search);
  }

  search_params.delete('o');
  if (order != '' && order != null) {
    search_params.append('o', order);
  }

  if (cat) {
    search_params.delete('c');
    if (cat != 'all') {
      search_params.append('c', cat);
    }
  }

  search_params.delete('id');

  url.search = search_params.toString();
  //convert to string
  url.pathname = '/index.php';
  var new_url = url.toString();

  //navigate to new url
  location.href = new_url;

}

//places an order
function placeOrder () {
  window.location.href = "delivery.php";
}

//adds a product to the cart
function addToCart (ID, amount) {
  sendPostRequest('api/addToCart.php', 'id=' + ID.toString() + '&amount=' + amount.toString(), function (res) {
    //do stuff with the response
    setTimeout(function(){

        $('.add-to-cart-button').popover('hide');

      }, 5000);
  });
}

function removeFromCart (ID, amount) {
  sendPostRequest('api/removeFromCart.php', 'id=' + ID.toString() + '&amount=' + amount.toString(), function (res) {
    //do stuff with the response

  });
}

function setProductAmount (ID) {
  var amount = document.getElementById(ID).value;
  if (amount > 0) {
  sendPostRequest('api/setAmount.php', 'id=' + ID.toString() + '&amount=' + amount.toString(), function (res) {
    //do stuff with the response
      getProductPrice(ID, function (res) {
        document.getElementById(ID + '-total').innerHTML = "€ " + (res * amount).toFixed(2);
      })
      getCartTotalPrice(function (res) {
        document.getElementById('cart-totaal-prijs').innerHTML = "Totaal: € " + res;
      })
    });
  }
}

function login () {
  var user = document.getElementById('name').value;

  if (user == null || user == '') {
    alert('Please fill in all fields.');
  } else {
    var password = document.getElementById('pass').value;

    if (password == null || password == '') {
      alert('Please fill in all fields.');
    } else {
      //try to login
      sendPostRequest('api/login.php', 'name=' + user + "&pass=" + password, function (res) {
        if (res == 'success') {
          //login succesful
          window.location.href = "/";
        } else {
          //name and password do not match
          alert('Credentials do not match');
          document.getElementById('pass').value = "";
          document.getElementById('pass').focus();
        }
      });
    }
  }
}

//returns the price of a product
function getProductPrice (ID, callback) {
  sendPostRequest('api/getProductPrice.php', 'id=' + ID.toString() , callback);
}

//returns the total price of the shopping cart
function getCartTotalPrice (callback) {
  sendPostRequest('api/getCartTotalPrice.php','',callback);
}

//empties the cart
function emptyCart() {
  sendPostRequest('api/emptyCart.php','',function (res) {
    location.reload();
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

$(function () {
  $('.add-to-cart-button').popover({
    container: 'body'
  })
})
