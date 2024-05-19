<?php

// Include the connection.php file
include 'connection.php';
session_start();


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST["email"];
    $password = $_POST["pwd"];
    $stmt = $conn->prepare("SELECT * FROM `clients` WHERE `Email`=?");
    $stmt->bindParam(1, $email);
    $stmt->execute();
    $client = $stmt->fetch(PDO::FETCH_ASSOC);

    // Example: Authenticate user (you should replace this with your actual authentication logic)
    if ($email === $client['Email'] && $password === $client['pwd']) {
        if ($client['admin'] === 1){
            header('Location: ../vue/dashboard.php');
            exit();
        };
        $_SESSION['name'] = $client['ClientName'];
        $_SESSION['id'] = $client['ClientID'];
        $_SESSION['email'] = $client['Email'];
        header('Location: ../vue/pageinfo.php');
        exit();
    } else {
        // Redirect the user back to the login page with an error message
        header("Location: ../vue/login.php?error=1");
        exit();
    }
} else {
    // Redirect users if they try to access this page directly
    header("Location: ../vue/login.php");
    exit();
}
























// // Retrieve the JSON data from the request body
// $data = json_decode(file_get_contents("php://input"));

// // Extract email from the received data
// $email = $data->email;
// $pwd = $data->pwd;

// $stmt = $conn->prepare("SELECT * FROM `clients` WHERE `Email`=?");
// $stmt->bindParam(1, $email);

// $stmt->execute();

// if ($stmt->rowCount() == 1) {
//     $client = $stmt->fetch(PDO::FETCH_ASSOC);
//     if ($pwd == $client['pwd']) {
//         $_SESSION['EMAIL'] = $client['Email'];
//         $_SESSION['ID'] = $client['ClientID'];
//         $_SESSION['NAME'] = $client['ClientName'];
//         header('location: ../vue/pageinfo.php');
//         $response = array('status' => 'success', 'email' => 'you are loged in Now CONGRATS!!' . $client['ClientName']);
//         echo json_encode($response);
//         exit();
//     } else {
//         $response = array('status' => 'fail', 'error' => 'Password incorrect');
//         echo json_encode($response);
//         exit();
//     }
// } else {
//     $response = array('status' => 'fail', 'error' => 'No user found with this email address');
//     echo json_encode($response);
//     exit();
// }
