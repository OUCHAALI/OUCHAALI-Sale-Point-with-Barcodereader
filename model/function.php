<?php

include 'connection.php';

// Define the getSuppliers() function
function getSuppliers() {
    global $conn; // Assuming $conn is your database connection object

    try {
        // Prepare the SQL query to select supplier information
        $query = "SELECT supplier_id, supplier_name, phone, email FROM supplier";

        // Prepare the statement
        $statement = $conn->prepare($query);

        // Execute the statement
        $statement->execute();

        // Fetch all rows as associative arrays
        $suppliers = $statement->fetchAll(PDO::FETCH_ASSOC);

        // Return the array of suppliers
        return $suppliers;
    } catch(PDOException $e) {
        // Handle database errors
        echo "Error: " . $e->getMessage();
        return array(); // Return an empty array in case of error
    }
}

function getProduct()
{
    global $conn; // Assuming $conn is your PDO connection object

    try {
        // Prepare SQL statement to fetch all products
        $stmt = $conn->prepare("SELECT * FROM products");

        // Execute the statement
        $stmt->execute();

        // Fetch all rows as associative array
        $products = $stmt->fetchAll();

        return $products;
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}

function getClients()
{
    global $conn; // Assuming $conn is your PDO connection object

    try {
        // Prepare SQL statement to fetch all clients
        $stmt = $conn->prepare("SELECT * FROM clients");

        // Execute the statement
        $stmt->execute();

        // Fetch all rows as associative array
        $clients = $stmt->fetchAll();

        return $clients;
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}



function getID($email) {
    global $conn; // Assuming $conn is your PDO connection object

    $stmt = $conn->prepare("SELECT ClientID FROM clients WHERE Email = ?");
        
    // Bind parameter
    $stmt->bindParam(1, $email);

    // Execute the prepared statement
    $stmt->execute();

    // Fetch client ID
    $clientID = $stmt->fetchColumn();

    return $clientID;
}



