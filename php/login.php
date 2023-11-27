<?php
// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "userdetails");

if ($conn === false) {
    echo json_encode(['message' => 'Could not connect to the database']);
    exit();
}

// Get the entered username and password
$username = $_POST['username'];
$password = $_POST['password'];

// Use prepared statement to prevent SQL injection
$sql = "SELECT username, password FROM users WHERE username=?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);

// Get the result
$result = mysqli_stmt_get_result($stmt);

if ($result) {
    // Check the number of rows returned
    if (mysqli_num_rows($result) >= 1) {
        // Fetch user details
        $row = mysqli_fetch_assoc($result);

        // Verify hashed password
        if (password_verify($password, $row['password'])) {
            // Password is correct

            // Set the user details in Redis (assuming Redis is running on localhost)
            $redis = new Redis();
            $redis->connect('127.0.0.1', 6379); // Update with your Redis host and port

            // Set the user details in Redis with a key (you can customize the key as needed)
            $redisKey = 'user:' . $username;
            $redis->set($redisKey, json_encode(['username' => $username]));

            // Close the Redis connection
            $redis->close();

            // Generate a JWT token with user details
            $token = base64_encode(json_encode(['user' => $row, 'username' => $username]));

            // Set the token and username in the response
            echo json_encode(['message' => 'Login successful', 'token' => $token, 'username' => $username]);
            exit(); // Ensure that no further code is executed after the response
        } else {
            // Password is incorrect
            echo json_encode(['message' => 'Login failed. Incorrect username or password.']);
        }
    } else {
        // No user found with the provided username
        echo json_encode(['message' => 'Login failed. Incorrect username or password.']);
    }
} else {
    // Error in executing the query
    echo json_encode(['message' => 'Error: ' . mysqli_error($conn)]);
}

// Close statement and connection
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
