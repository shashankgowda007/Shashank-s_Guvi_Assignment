<?php
require 'vendor/autoload.php'; // Include the MongoDB PHP Library

// Connection to MongoDB
//mongodb+srv://GuviAssignmentShashank:Shashank1234@cluster0.lwqk5bw.mongodb.net/?retryWrites=true&w=majority
// $client = new MongoDB\Client('mongodb+srv://GuviAssignmentShashank:Shashank1234@cluster0.lwqk5bw.mongodb.net/guvi_assignment_shashank?retryWrites=true&w=majority');
$client = new MongoDB\Client('mongodb+srv://GuviAssignmentShashank:Shashank1234@cluster0.lwqk5bw.mongodb.net/?retryWrites=true&w=majority');

$collection = $client->selectDatabase('guvi_assignment_shashank')->selectCollection('users');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect user data from the form
    $userData = [
        'firstName' => $_POST['firstName'],
        'lastName' => $_POST['lastName'],
        'address' => $_POST['address'],
        'postCode' => $_POST['postCode'],
        'country' => $_POST['country'],
        'email' => $_POST['email'],
        'phoneNumber' => $_POST['phoneNumber'],
        'password' => $_POST['password'],
        'confirmPassword' => $_POST['confirmPassword']
    ];

    // Insert the data into MongoDB
    $collection->insertOne($userData);

    echo json_encode(['status' => 'success', 'message' => 'User data inserted successfully']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}