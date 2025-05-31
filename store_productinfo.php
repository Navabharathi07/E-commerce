<?php
include 'db_connection.php'; // Include your database connection file

session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve SellerID from session
    $sellerID = $_SESSION['SellerID'];

    // Retrieve product info data
    $productName = $_POST['productName'];
    $productCategory = $_POST['productCategory'];
    $numberOfProducts = $_POST['numberOfProducts'];
    $price = $_POST['price'];
    $productDescription = $_POST['productDescription'];
    $materialUsed = $_POST['materialUsed'];
    $weight = $_POST['weight'];
    $length = $_POST['length'];
    $width = $_POST['width'];
    $numberOfColors = $_POST['colorCount'];

    // Insert data into Productinfo table
    $sql = "INSERT INTO ProductInfo (SellerID, ProductName, ProductCategory, NumberOfProducts, Price, ProductDescription, MaterialUsed, Weight, Length, Width, NumberOfColors) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssidssdddi", $sellerID, $productName, $productCategory, $numberOfProducts, $price, $productDescription, $materialUsed, $weight, $length, $width, $numberOfColors);

    if ($stmt->execute()) {
        // Get the last inserted product ID
        $lastInsertedProductId = $stmt->insert_id;

        // Store color information in a separate table
        for ($i = 1; $i <= $numberOfColors; $i++) {
            $colorName = $_POST['color' . $i];
            $colorSql = "INSERT INTO ColorInfo (ProductID, ColorName) VALUES (?, ?)";
            $colorStmt = $conn->prepare($colorSql);
            $colorStmt->bind_param("is", $lastInsertedProductId, $colorName);
            $colorStmt->execute();
            $colorStmt->close();
        }

        header("Location: seller.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
