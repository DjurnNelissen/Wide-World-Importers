var input = document.getElementById("search");
input.addEventListener("keyup", function(event) {
    event.preventDefault();
    if (event.keyCode === 13) {
        searchProducts();
    }
});
