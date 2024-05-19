<?php
// insert_product.php

// Include the connection script
include 'connection.php';

// Handle the AJAX request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve product details from the POST data
    $code = $_POST['code'];
    $productName = $_POST['productName'];
    $description = $_POST['description'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $block = $_POST['block'];
    $roof = $_POST['roof'];

    try {
        // Prepare SQL statement to insert new product data
        $stmt = $conn->prepare("INSERT INTO `products` (`code`, `ProductName`, `Description`, `QuantityOnHand`, `UnitPrice`, `block_id`, `roof_id`) VALUES (?, ?, ?, ?, ?, ?, ?)");
        
        // Bind parameters
        $stmt->bindParam(1, $code);
        $stmt->bindParam(2, $productName);
        $stmt->bindParam(3, $description);
        $stmt->bindParam(4, $quantity);
        $stmt->bindParam(5, $price);
        $stmt->bindParam(6, $block);
        $stmt->bindParam(7, $roof);

        // Execute the prepared statement
        $stmt->execute();

        // Return success message
        echo json_encode(['success' => 'New product inserted successfully!']);
    } catch(PDOException $e) {
        // Handle database errors
        echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    // Handle non-POST requests
    echo json_encode(['error' => 'Invalid request method']);
}
?>
