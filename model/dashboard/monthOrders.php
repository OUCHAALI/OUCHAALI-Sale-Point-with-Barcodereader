<?php
include '../connection.php'; // Include your database connection file

try {
    // Query to get the count of orders placed this month
    $query = "SELECT COUNT(*) AS count_this_month_orders FROM orders 
              WHERE MONTH(OrderDate) = MONTH(CURRENT_DATE()) AND YEAR(OrderDate) = YEAR(CURRENT_DATE())";

    // Prepare the query
    $stmt = $conn->prepare($query);

    // Execute the query
    $stmt->execute();

    // Fetch the result as an associative array
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Return the count of orders placed this month as JSON
    echo json_encode($row);
} catch(PDOException $e) {
    // Handle database error
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}
?>
