<?php
include '../connection.php'; // Include your database connection file

try {
    // Query to fetch the details of the last 10 orders
    $query = "SELECT p.ProductName, od.UnitPrice AS ProductPrice, od.Quantity, o.OrderDate
              FROM orders o
              INNER JOIN orderdetails od ON o.OrderID = od.OrderID
              INNER JOIN products p ON od.ProductID = p.ProductID
              ORDER BY o.OrderDate DESC
              LIMIT 10";

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
