<?php
// Include the connection script
include 'connection.php';

// Handle the AJAX request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Decode the JSON data sent by the client
    $data = json_decode(file_get_contents('php://input'), true);

    // Check if the data contains client IDs
    if (isset($data['clientIDs']) && is_array($data['clientIDs'])) {
        try {
            // Prepare the SQL query
            $sql = "SELECT c.ClientID, c.ClientName, p.ProductID, p.ProductName, 
                    COALESCE(SUM(od.Quantity), 0) AS TotalQuantityOrdered, p.UnitPrice,c.Email
                    FROM Clients c
                    JOIN Orders o ON c.ClientID = o.ClientID
                    LEFT JOIN OrderDetails od ON o.OrderID = od.OrderID
                    JOIN Products p ON od.ProductID = p.ProductID
                    WHERE c.ClientID IN (" . implode(',', $data['clientIDs']) . ")
                    GROUP BY c.ClientID, c.ClientName, p.ProductID, p.ProductName
                    ORDER BY c.ClientID, TotalQuantityOrdered DESC;";

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
        // Return error if client IDs are missing or not in array format
        echo json_encode(['error' => 'Invalid client IDs provided']);
    }
} else {
    // Handle non-POST requests
    echo json_encode(['error' => 'Invalid request method']);
}
?>
