<?php
session_start();

include 'connection.php';

// Handle the AJAX request
if (isset($_SESSION['id'])) {
    // Retrieve the scanned product code from the POST data
    $id = $_SESSION['id'];

    try {
        // Prepare SQL statement to fetch product details based on the scanned code
        $stmt = $conn->prepare("SELECT 
            od.ProductID,
            p.ProductName,
            p.UnitPrice AS ProductPrice,
            od.Quantity
        FROM 
            orders o
        JOIN 
            orderdetails od ON o.OrderID = od.OrderID
        JOIN 
            products p ON od.ProductID = p.ProductID
        WHERE 
            o.ClientID = ?
            AND DATE(o.OrderDate) = CURDATE();");
        
        // Bind parameters
        $stmt->bindParam(1, $id);

        // Execute the prepared statement
        $stmt->execute();

        // Fetch all product details as an associative array
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Send the product data as a JSON response
        header('Content-Type: application/json');
        echo json_encode($data);
    } catch(PDOException $e) {
        // Handle database errors
        echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    // Handle non-POST requests
    header('location: ../vue/login.php');
}
?>
