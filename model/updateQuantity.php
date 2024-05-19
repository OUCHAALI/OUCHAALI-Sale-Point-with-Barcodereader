<?php
// Include the connection script
include 'connection.php';

// Handle the AJAX request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve product IDs and quantities from the POST data
    $productsToUpdate = json_decode(file_get_contents('php://input'), true);
    
    // Check if there is a client ID provided
    if (isset($productsToUpdate[0]['lcode'])) {
        // If there is a client ID, use it
        $clientId = $productsToUpdate[0]['lcode'];
    } else {
        // If there is no client ID, set it to NULL
        $clientId = NULL;
    }

    try {
        // Begin transaction
        $conn->beginTransaction();

        // Prepare SQL statement to insert order
        $stmtOrder = $conn->prepare("INSERT INTO `orders`(`ClientID`, `OrderDate`) VALUES (?, CURRENT_DATE)");
        $stmtOrder->execute([$clientId]);

        // Retrieve the generated order ID
        $orderId = $conn->lastInsertId();

        // Prepare SQL statement to update product quantities
        $stmtUpdate = $conn->prepare("UPDATE products SET QuantityOnHand = QuantityOnHand - ? WHERE ProductID = ?");
        
        // Prepare SQL statement to insert order details
        $stmtOrderDetail = $conn->prepare("INSERT INTO `orderdetails`(`OrderID`, `ProductID`, `Quantity`, `UnitPrice`) VALUES (?, ?, ?, ?)");

        foreach ($productsToUpdate as $product) {
            $productId = $product['productId'];
            $quantity = $product['quantity'];
            $unitPrice = $product['price']; // Assuming you're passing unit price from the client

            // Update product quantity
            $stmtUpdate->execute([$quantity, $productId]);

            // Insert order detail
            $stmtOrderDetail->execute([$orderId, $productId, $quantity, $unitPrice]);
        }

        // Commit transaction
        $conn->commit();

        // Return success message
        echo json_encode(['success' => 'Order placed successfully']);
    } catch(PDOException $e) {
        // Rollback transaction on error
        $conn->rollBack();
        // Handle database errors
        echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    // Handle non-POST requests
    echo json_encode(['error' => 'Invalid request method']);
}
?>
