<?php
// update_product.php

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
        // Prepare SQL statement to update product data
        $stmt = $conn->prepare("UPDATE `products` SET `ProductName`=?, `Description`=?, `QuantityOnHand`= QuantityOnHand + ?, `UnitPrice`=?, `block_id`=?, `roof_id`=? WHERE `code`=?");
        
        // Bind parameters
        $stmt->bindParam(1, $productName);
        $stmt->bindParam(2, $description);
        $stmt->bindParam(3, $quantity);
        $stmt->bindParam(4, $price);
        $stmt->bindParam(5, $block);
        $stmt->bindParam(6, $roof);
        $stmt->bindParam(7, $code);

        // Execute the prepared statement
        $stmt->execute();

        // Check if any rows were affected
        $rowsAffected = $stmt->rowCount();
        if ($rowsAffected > 0) {
            // Return success message if update was successful
            echo json_encode(['success' => 'Product updated successfully!']);
        } else {
            // Return error message if no rows were affected (probably no matching product found)
            echo json_encode(['error' => 'No matching product found for update.']);
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
