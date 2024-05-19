<?php

// Include the connection script
include 'connection.php';

// Handle the AJAX request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve loyalty code from the POST data
    $loyaltyCode = $_POST['loyaltyCode'];

    try {
        // Prepare SQL statement to fetch client data based on loyalty code
        $stmt = $conn->prepare("SELECT * FROM `clients` WHERE `ClientID` = ?");
        
        // Bind parameter
        $stmt->bindParam(1, $loyaltyCode);

        // Execute the prepared statement
        $stmt->execute();

        // Fetch client data
        $clientData = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if client data is retrieved
        if ($clientData) {
            // Return client details if found
            echo json_encode($clientData);
        } else {
            // Return error message if client is not found
            echo json_encode(['error' => 'Client not found.']);
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

