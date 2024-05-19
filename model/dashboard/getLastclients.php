<?php
include '../connection.php'; // Include your database connection file

try {
    // Query to fetch the details of the last 10 clients
    $query = "SELECT ClientName AS Name, Email FROM clients ORDER BY ClientID DESC LIMIT 10";

    // Prepare the query
    $stmt = $conn->prepare($query);

    // Execute the query
    $stmt->execute();

    // Fetch the results as an associative array
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Output the data as JSON
    echo json_encode($rows);
} catch(PDOException $e) {
    // Handle database error
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}
?>
