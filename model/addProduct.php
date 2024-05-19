<?php
session_start(); // Start the session

include 'connection.php';

// Check if form fields are filled
if (isset($_POST['productName']) && isset($_POST['description']) && isset($_POST['quantity']) && isset($_POST['price']) && isset($_POST['roof']) && isset($_POST['block'])) {
    // Check if any of the required fields are empty
    if (empty($_POST['productName']) || empty($_POST['description']) || empty($_POST['quantity']) || empty($_POST['price']) || empty($_POST['roof']) || empty($_POST['block'])) {
        $_SESSION['message']['text'] = "Please fill all the fields";
        $_SESSION['message']['type'] = "danger";
        header('Location: ../vue/product.php');
        exit; // Stop further execution
    }

    try {
        // Prepare SQL statement to insert data into the table
        $stmt = $conn->prepare("INSERT INTO `products`(`ProductName`, `Description`, `UnitPrice`, `QuantityOnHand`, `roof_id`, `block_id`) 
                                VALUES (?, ?, ?, ?, ?, ?)");

        // Bind parameters
        $stmt->bindParam(1, $_POST['productName']);
        $stmt->bindParam(2, $_POST['description']);
        $stmt->bindParam(3, $_POST['price']);
        $stmt->bindParam(4, $_POST['quantity']);
        $stmt->bindParam(5, $_POST['roof']);
        $stmt->bindParam(6, $_POST['block']);

        // Execute the statement
        $stmt->execute();

        $_SESSION['message']['text'] = 'The product was added successfully.';
        $_SESSION['message']['type'] = 'success';
    } catch(PDOException $e) {
        $_SESSION['message']['text'] = "Error: " . $e->getMessage();
        $_SESSION['message']['type'] = 'danger';
    }

    $conn = null;
} else {
    $_SESSION['message']['text'] = 'Form fields are not set';
    $_SESSION['message']['type'] = 'danger';
}

header('Location: ../vue/product.php');
exit;
?>
