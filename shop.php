<?php
include 'db_connection.php'; // Include your database connection file

// Fetch all product information from the database
$sql = "SELECT * FROM ProductInfo";
$result = $conn->query($sql);

$products = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <link rel="stylesheet" href="shop.css">
    <style>

    </style>
</head>
<body>
<div class="navbar">
    
    <i class="fa-solid fa-list" onclick="opentog()"></i>
        <div class="navbar-items">
            <a href="main.html" class="navbar-item">Home</a>
            <a href="shop.html" class="navbar-item">Shop</a>
            <a href="wishlist.html" class="navbar-item">Wishlist</a>
            <a href="cart.html" class="navbar-item">Cart</a>
            <a href="personal.html" class="navbar-item">Seller</a>
            <a href="#" class="navbar-item">Profile</a>
            <a href=""  class="navbar-item-list"><i class="fa-solid fa-list"></i></a>
        </div>
</div>

<div class="category" id="category">

    <h1 style="color: white; margin-left: 20px;">Category</h1>
    <p style="color: white; cursor: pointer;" class="close" onclick="closetog()"><i class="fa-solid fa-xmark"></i></p>
    
        <div class="cat-item">
            <p><a href="">Home Decor</a></p>
            <p><a href="">Jewelry</a></p>
            <p><a href="">Fashion</a></p>
            <p><a href="">Art & Craft Supplies</a></p>
            <p><a href="">Gifts & Accessories</a></p>   
        </div>
    
</div>

<br><br><br>
        
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $product): ?>
                    <section class="product">
                        <!-- Modify the src attribute to point to the product image if available -->
                        <h2 class="product-title"><?php echo htmlspecialchars($product['ProductName']); ?></h2>
                        <p class="product-desc"><?php echo htmlspecialchars($product['ProductDescription']); ?></p>
                        <p class="product-cat"><?php echo htmlspecialchars($product['ProductCategory']); ?></p>
                        <p class="Price">Price: $<?php echo htmlspecialchars($product['Price']); ?></p>
                        <br><br>
                        <button class="heart-icon"><i class="fa-regular fa-heart"></i></button>
                        <button class="cart-icon"><i class="fa-solid fa-cart-plus"></i></button>
                    </section>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No products found. <a href="add_product.html">Add a product</a></p>
            <?php endif; ?>
        
    
</body>
</html>
