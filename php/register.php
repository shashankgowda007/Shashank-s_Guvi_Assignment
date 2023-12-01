<?php

// Database connection details
$host = "sql12.freesqldatabase.com";
$database = "sql12666680";
$username = "sql12666680";
$password = "HQgTRrvBfs";
$port = 3306;

$conn = new mysqli($host, $username, $password, $database, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $firstName = mysqli_real_escape_string($conn, $_POST["firstName"]);
    $lastName = mysqli_real_escape_string($conn, $_POST["lastName"]);
    $gender = mysqli_real_escape_string($conn, $_POST["gender"]);
    $DOB = mysqli_real_escape_string($conn, $_POST["DOB"]);
    $address = mysqli_real_escape_string($conn, $_POST["address"]);
    $postCode = mysqli_real_escape_string($conn, $_POST["postCode"]);
    $country = mysqli_real_escape_string($conn, $_POST["country"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $phoneNumber = mysqli_real_escape_string($conn, $_POST["phoneNumber"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash the password
    $confirmPassword = mysqli_real_escape_string($conn, $_POST["confirmPassword"]);

    // Check if email already exists
    $checkQuery = "SELECT * FROM users WHERE email = ?";
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bind_param("s", $email);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if ($checkResult->num_rows > 0) {
        echo "User with the same email already exists!";
    } else {
        // Insert new user data
        $insertQuery = "INSERT INTO users (firstName, lastName, gender, DOB, address, postCode, country, email, phoneNumber, password, confirmPassword) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $insertStmt = $conn->prepare($insertQuery);
        $insertStmt->bind_param("sssssssssss", $firstName, $lastName, $gender, $DOB, $address, $postCode, $country, $email, $phoneNumber, $password, $confirmPassword);

        if ($insertStmt->execute()) {
            echo "Registration successful!";
        } else {
            echo "Error during registration: " . $insertStmt->error;
        }

        $insertStmt->close();
    }

    $checkStmt->close();
}

$conn->close();