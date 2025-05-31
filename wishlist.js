document.addEventListener('DOMContentLoaded', function() {
    var wishlistContainer = document.getElementById('wishlist');
    var wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];
    
    if (wishlist.length === 0) {
        wishlistContainer.innerHTML = '<p>Your wishlist is empty.</p>';
    } else {
        wishlist.forEach(function(product, index) {
            var productElement = document.createElement('div');
            productElement.classList.add('wishlist-item');
            productElement.innerHTML = `
                <img src="${product.image}" alt="${product.title}">
                <h2>${product.title}</h2>
                <p>Price: ${product.price}</p>
                <button class="remove-from-wishlist" data-index="${index}">Remove from Wishlist</button>
            `;
            wishlistContainer.appendChild(productElement);
        });
    }

    wishlistContainer.addEventListener('click', function(event) {
        if (event.target.classList.contains('remove-from-wishlist')) {
            var index = event.target.getAttribute('data-index');
            wishlist.splice(index, 1);
            localStorage.setItem('wishlist', JSON.stringify(wishlist));
            location.reload(); // Refresh the page to reflect changes
            alert('Product removed from wishlist!')
        }
    });
});
