<?php

$host = "sql12.freesqldatabase.com";
$database = "sql12666680";
$username = "sql12666680";
$password = "HQgTRrvBfs";
$port = 3306;

$conn = new mysqli($host, $username, $password, $database, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Login successful
            $response['status'] = 'success';
            $response['message'] = 'Login successful!';
        } else {
            // Login failed - Incorrect password
            $response['status'] = 'error';
            $response['message'] = 'Incorrect email or password.';
        }
    } else {
        // Login failed - User not found
        $response['status'] = 'error';
        $response['message'] = 'Incorrect email or password.';
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($response);