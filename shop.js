document.addEventListener('DOMContentLoaded', function() {
    var heartIcons = document.querySelectorAll('.heart-icon');
    heartIcons.forEach(function(icon) {
        icon.addEventListener('click', function(event) {
            event.preventDefault();
            // Retrieve product details
            var product = {
                image: this.parentNode.querySelector('img').src,
                title: this.parentNode.querySelector('.product-title').textContent,
                price: this.parentNode.querySelector('.Price').textContent
            };
            // Store product details in local storage
            var wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];
            wishlist.push(product);
            localStorage.setItem('wishlist', JSON.stringify(wishlist));
            alert('Product added to wishlist!');
        });
    });
});
