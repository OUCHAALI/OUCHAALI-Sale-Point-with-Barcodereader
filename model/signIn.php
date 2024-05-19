<?php
// Include the connection.php file
include 'connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $clientName = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["number"];
    $password = $_POST["pwd"];

    try {
        // Prepare and execute the SQL statement to insert user data
        $stmt = $conn->prepare("INSERT INTO `clients` (ClientName, Email, Phone, pwd) VALUES (?, ?, ?, ?)");
        $stmt->execute([$clientName, $email, $phone, $password]);

        // Redirect to the login page or any other appropriate page after successful insertion
        header('Location: ../vue/login.php');
        exit();
    } catch (PDOException $e) {
        // Handle database errors
        echo "Error: " . $e->getMessage();
    }
} else {
    // Redirect users if they try to access this page directly
    header("Location: ../vue/signup.php");
    exit();
}
