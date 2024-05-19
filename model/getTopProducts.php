<?php
// Include the connection script
include 'connection.php';

// Handle the AJAX request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // SQL query
        $sql = "SELECT p.ProductID, p.ProductName, SUM(od.Quantity) AS TotalQuantity
                FROM Products p
                JOIN OrderDetails od ON p.ProductID = od.ProductID
                GROUP BY p.ProductID, p.ProductName
                ORDER BY TotalQuantity DESC
                LIMIT 10";

        // Prepare statement
        $stmt = $conn->prepare($sql);

        // Execute query
        $stmt->execute();

        // Fetch all rows as an associative array
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Check if there are results
        if ($products) {
            // Return products data as JSON
            echo json_encode($products);
        } else {
            // Return error message if no results found
            echo json_encode(['error' => 'No products found.']);
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
