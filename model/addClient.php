<?php
// add_client.php

// Include the connection script
include 'connection.php';

// Handle the AJAX request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve client details from the POST data
    $clientName = $_POST['clientName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    try {
        // Prepare SQL statement to insert client data
        $stmt = $conn->prepare("INSERT INTO `clients` (`ClientName`, `Email`, `Phone`) VALUES (?, ?, ?)");
        
        // Bind parameters
        $stmt->bindParam(1, $clientName);
        $stmt->bindParam(2, $email);
        $stmt->bindParam(3, $phone);

        // Execute the prepared statement
        $stmt->execute();

        // Check if any rows were affected
        $rowsAffected = $stmt->rowCount();
        if ($rowsAffected > 0) {
            // Return success message if insertion was successful
            echo json_encode(['success' => 'Client added successfully!']);
        } else {
            // Return error message if no rows were affected
            echo json_encode(['error' => 'Failed to add client.']);
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
