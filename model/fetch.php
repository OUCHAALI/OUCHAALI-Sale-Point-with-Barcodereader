<?php
// fetch_product.php

// Include the connection script
include 'connection.php';

// Handle the AJAX request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the scanned product code from the POST data
    $scannedCode = $_POST['code'];

    try {
        // Prepare SQL statement to fetch product details based on the scanned code
        $stmt = $conn->prepare("SELECT ProductID, `ProductName`, `Description`, `QuantityOnHand`, `UnitPrice`, `block_id`, `roof_id` FROM `products` WHERE `code` = ?");
        
        // Bind parameters
        $stmt->bindParam(1, $scannedCode);

        // Execute the prepared statement
        $stmt->execute();

        // Fetch product details
        $productData = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if product data is found
        if ($productData) {
            // Send the product data as a JSON response
            header('Content-Type: application/json');
            echo json_encode($productData);
        } else {
            // Product not found
            echo json_encode(null); // Return null for not found
        }
    } catch(PDOException $e) {
        // Handle database errors
        echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    // Handle non-POST requests
    echo json_encode(['error' => 'Invalid request method']);
}
?>
