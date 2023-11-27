<?php
// Start the session
session_start();

header('Content-Type: application/json');

// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "userdetails");

if ($conn === false) {
    echo json_encode(['message' => 'Could not connect to the database']);
    exit();
}

// Retrieve data from the AJAX request
$username = mysqli_real_escape_string($conn, $_POST['username']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

// Validate data (you should add more robust validation)
if (empty($username) || empty($email) || empty($password)) {
    echo json_encode(['message' => 'Please fill in all the fields']);
    exit();
}

// Hash the password (use a stronger hashing algorithm in production)
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Prepare and bind the statement
$stmt = mysqli_prepare($conn, "INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
mysqli_stmt_bind_param($stmt, 'sss', $username, $email, $hashedPassword);

// Execute the statement
if (mysqli_stmt_execute($stmt)) {
    // Set user details in the PHP session
    $_SESSION['username'] = $username;

    // Set the user details in Redis (assuming Redis is running on localhost)
    $redis = new Redis();
    $redis->connect('127.0.0.1', 6379); // Update with your Redis host and port

    // Set the user details in Redis with a key (you can customize the key as needed)
    $redisKey = 'user:' . $username;
    $redis->set($redisKey, json_encode(['username' => $username, 'email' => $email]));

    // Close the Redis connection
    $redis->close();

    echo json_encode(['message' => 'Registration successful']);
} else {
    echo json_encode(['message' => 'Registration failed']);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
