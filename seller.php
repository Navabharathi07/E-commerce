<?php
session_start();
include 'db_connection.php'; // Include your database connection file

// Assume user is logged in and email is stored in session
$email = $_SESSION['email'];

// Initialize seller information array
$sellerInfo = [];
$businessInfo = [];

if ($email) {
    // Fetch seller information based on the session email
    $sellerSql = "SELECT SellerID, FirstName, LastName, Email FROM SellerInfo WHERE Email = ?";
    $sellerStmt = $conn->prepare($sellerSql);
    $sellerStmt->bind_param("s", $email);
    $sellerStmt->execute();
    $sellerResult = $sellerStmt->get_result();
    $sellerInfo = $sellerResult->fetch_assoc();
   

    if ($sellerInfo) {
        // Fetch business information if the seller exists
        $sellerID = $sellerInfo['SellerID'];
        $_SESSION['SellerID'] = $sellerID;
        
        $businessSql = "SELECT BusinessName FROM Businessinfo WHERE SellerID = ?";
        $businessStmt = $conn->prepare($businessSql);
        $businessStmt->bind_param("s", $sellerID);
        $businessStmt->execute();
        $businessResult = $businessStmt->get_result();
        $businessInfo = $businessResult->fetch_assoc();

        $businessStmt->close();
        $_SESSION['SellerID'] = $sellerID;
    }

    $sellerStmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Become a Seller</title>
    <link rel="stylesheet" href="seller.css">
</head>
<body>
    <main>
        <section class="main-content">
            <div class="left-side">
                <h2>Seller Information</h2>
                <!-- Display seller information if registered -->
                <?php if ($sellerInfo): ?>
                <div class="seller-info">
                    <p><strong>Name:</strong> <?php echo htmlspecialchars($sellerInfo['FirstName'] . ' ' . $sellerInfo['LastName']); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($sellerInfo['Email']); ?></p>
                    <p><strong>Business Name:</strong> <?php echo htmlspecialchars($businessInfo['BusinessName']); ?></p>
                    <section class="call-to-action">
                        <a href="productinfo.html">Add</a>
                    </section>
                </div>
                <?php else: ?>
               
                <?php endif; ?>
            </div>

            <div class="right-side">
                <section class="welcome-banner">
                    <div class="overlay">
                        <h1>Welcome to Our Seller Community!</h1>
                        <p>Start Selling Your Products Today.</p>
                    </div>
                </section>

                <section class="intro">
                    <p>Join our platform and enjoy the benefits of reaching a wide audience with our easy-to-use tools and support services.</p>
                </section>

                <section class="how-it-works">
                    <div class="step">
                        <h2>Step 1: Register</h2>
                        <p>Fill in your details to create a seller account.</p>
                    </div>
                    <div class="step">
                        <h2>Step 2: List Products</h2>
                        <p>Easily add your products with our intuitive tools.</p>
                    </div>
                    <div class="step">
                        <h2>Step 3: Start Selling</h2>
                        <p>Reach thousands of potential customers and grow your business.</p>
                    </div>
                </section>

                <section class="why-sell">
                    <h2>Why Sell with Us?</h2>
                    <ul>
                        <li>Wide Customer Reach</li>
                        <li>Easy Product Management</li>
                        <li>Secure Transactions</li>
                        <li>Dedicated Support Team</li>
                        <li>Detailed Analytics and Reports</li>
                    </ul>
                </section>

                <section class="testimonials">
                    <h2>What Our Sellers Say</h2>
                    <div class="testimonial">
                        <p>"Selling on this platform has boosted my business tremendously!" - Jane Doe</p>
                    </div>
                    <div class="testimonial">
                        <p>"The tools and support are fantastic. Highly recommend!" - John Smith</p>
                    </div>
                </section>

                <section class="faq">
                    <h2>Frequently Asked Questions</h2>
                    <div class="question">
                        <h3>How do I register as a seller?</h3>
                        <p>Click the 'Register' button and fill out the form.</p>
                    </div>
                    <div class="question">
                        <h3>What fees do you charge?</h3>
                        <p>Our fee structure is transparent and competitive. Please visit our fees page for more details.</p>
                    </div>
                </section>
            </div>
        </section>
    </main>

    <footer>
        <div class="footer-content">
            <div class="footer-links">
                <a href="#">Home</a>
                <a href="#">Shop</a>
                <a href="#">About Us</a>
                <a href="#">Contact</a>
                <a href="#">FAQs</a>
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
            </div>
            <div class="contact-info">
                <p>Email: <a href="mailto:support@myecommerce.com">support@myecommerce.com</a></p>
                <p>Phone: <a href="tel:123-456-7890">123-456-7890</a></p>
                <p>Address: 123 E-commerce St, Shopville</p>
            </div>
            <div class="social-media">
                <a href="#"><img src="facebook-icon.png" alt="Facebook"></a>
                <a href="#"><img src="twitter-icon.png" alt="Twitter"></a>
                <a href="#"><img src="instagram-icon.png" alt="Instagram"></a>
                <a href="#"><img src="linkedin-icon.png" alt="LinkedIn"></a>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; 2024 MyEcommerce. All rights reserved.</p>
        </div>
    </footer>

    <script>
        document.querySelectorAll('.faq .question h3').forEach(item => {
            item.addEventListener('click', () => {
                const answer = item.nextElementSibling;
                answer.style.display = answer.style.display === 'block' ? 'none' : 'block';
            });
        });
    </script>
</body>
</html>
