function searchCategory (categoryID) {

  var url = new URL(window.location.href);

  var query_string = url.search;

  var search_params = new URLSearchParams(query_string);

  search_params.delete('c');

  search_params.append('c',categoryID);

  url.search = search_params.toString();

  var new_url = url.toString();

  location.href = new_url;

}
