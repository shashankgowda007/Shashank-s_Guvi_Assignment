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

$response = array(); // Initialize response array

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $email = $_GET["email"];
    $sql = "SELECT * FROM user WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $response['status'] = 'success';
        $response['user'] = $user;
    } else {
        $response['status'] = 'error';
        $response['message'] = 'User not found!';
    }

    $stmt->close();
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($response);