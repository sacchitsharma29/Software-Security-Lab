<?php
$conn = mysqli_connect("localhost", "root", "", "testdb");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get user input safely
$username = $_POST['username'];
$password = $_POST['password'];

// Use prepared statement (prevents SQL Injection)
$stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND password=?");
$stmt->bind_param("ss", $username, $password);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "Login Successful";
} else {
    echo "Invalid Credentials";
}

$stmt->close();
$conn->close();
?>