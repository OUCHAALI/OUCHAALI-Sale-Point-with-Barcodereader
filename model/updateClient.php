<?php
// update_client.php

// Include the connection script
include 'connection.php';

// Handle the AJAX request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve client details from the POST data
    $clientID = $_POST['clientID'];
    $clientName = $_POST['clientName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    try {
        // Prepare SQL statement to update client data
        $stmt = $conn->prepare("UPDATE `clients` SET `ClientName`=?, `Email`=?, `Phone`=? WHERE `ClientID`=?");
        
        // Bind parameters
        $stmt->bindParam(1, $clientName);
        $stmt->bindParam(2, $email);
        $stmt->bindParam(3, $phone);
        $stmt->bindParam(4, $clientID);

        // Execute the prepared statement
        $stmt->execute();

        // Check if any rows were affected
        $rowsAffected = $stmt->rowCount();
        if ($rowsAffected > 0) {
            // Return success message if update was successful
            echo json_encode(['success' => 'Client updated successfully!']);
        } else {
            // Return error message if no rows were affected (probably no matching client found)
            echo json_encode(['error' => 'No matching client found for update.']);
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
