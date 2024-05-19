<?php
include '../connection.php'; // Include your database connection file

try {
    // Query to get the count of clients
    $query = "SELECT COUNT(*) AS client_count FROM clients";

    // Prepare the query
    $stmt = $conn->prepare($query);

    // Execute the query
    $stmt->execute();

    // Fetch the result as an associative array
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Return the client count as JSON
    echo json_encode($row);
} catch(PDOException $e) {
    // Handle database error
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}
?>
