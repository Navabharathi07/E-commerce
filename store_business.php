<?php
include 'db_connection.php'; // Include your database connection file

session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve business info data
    $sellerID = $_SESSION['SellerID']; // Retrieve SellerID from session
    $businessName = $_POST['businessName'];
    $flatNo = $_POST['flatNo'];
    $road = $_POST['road'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $pincode = $_POST['pincode'];
    $gstinNo = $_POST['gstinNo'];
    $businessWebsiteURL = $_POST['businessWebsiteURL'];
    $contactPhoneNumber = $_POST['contactPhoneNumber'];
    $contactEmail = $_POST['contactEmail'];

    // Insert data into Businessinfo table
    $sql = "INSERT INTO Businessinfo (SellerID, BusinessName, FlatNo, Road, City, State, Pincode, GSTINNo, BusinessWebsiteURL, ContactPhoneNumber, ContactEmail) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssss", $sellerID, $businessName, $flatNo, $road, $city, $state, $pincode, $gstinNo, $businessWebsiteURL, $contactPhoneNumber, $contactEmail);

    if ($stmt->execute()) {
        $_SESSION['SellerID'] = $sellerID;
        header("Location: seller.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
