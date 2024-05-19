<?php
include '../connection.php'; // Include your database connection file

try {
    // Query to get the count of orders placed today
    $query = "SELECT COUNT(*) AS count_today_orders FROM orders WHERE DATE(OrderDate) = CURDATE()";

    // Prepare the query
    $stmt = $conn->prepare($query);

    // Execute the query
    $stmt->execute();

    // Fetch the result as an associative array
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Return the count of orders placed today as JSON
    echo json_encode($row);
} catch(PDOException $e) {
    // Handle database error
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}
?>
