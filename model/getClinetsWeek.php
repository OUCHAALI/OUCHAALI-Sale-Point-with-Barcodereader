<?php
// Include the connection script
include 'connection.php';

// Handle the AJAX request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // SQL query
        $sql = "SELECT DISTINCT c.ClientID, c.ClientName, c.Email, c.Phone, 
                MAX(o1.OrderDate) AS LastOrderDate
                FROM Clients c
                JOIN Orders o1 ON c.ClientID = o1.ClientID
                JOIN Orders o2 ON c.ClientID = o2.ClientID
                LEFT JOIN Orders o3 ON c.ClientID = o3.ClientID 
                                    AND o3.OrderDate > DATE_SUB(CURDATE(), INTERVAL 7 DAY)
                                    AND o3.OrderDate <= CURDATE()
                WHERE o2.OrderDate = DATE_ADD(o1.OrderDate, INTERVAL 7 DAY)
                    AND o3.OrderID IS NULL
                GROUP BY c.ClientID, c.ClientName, c.Email, c.Phone";

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
