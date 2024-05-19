<?php
// Include the connection script
include 'connection.php';

// Handle the AJAX request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve supplier details from the POST data
    $supplierID = $_POST['supplierID'];
    $supplierName = $_POST['supplierName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    try {
        // Prepare SQL statement to update supplier data
        $stmt = $conn->prepare("UPDATE `supplier` SET `supplier_name`=?, `email`=?, `phone`=? WHERE `supplier_id`=?");
        
        // Bind parameters
        $stmt->bindParam(1, $supplierName);
        $stmt->bindParam(2, $email);
        $stmt->bindParam(3, $phone);
        $stmt->bindParam(4, $supplierID);

        // Execute the prepared statement
        $stmt->execute();

        // Check if any rows were affected
        $rowsAffected = $stmt->rowCount();
        if ($rowsAffected > 0) {
            // Return success message if update was successful
            echo json_encode(['success' => 'Supplier updated successfully!']);
        } else {
            // Return error message if no rows were affected (probably no matching supplier found)
            echo json_encode(['error' => 'No matching supplier found for update.']);
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
