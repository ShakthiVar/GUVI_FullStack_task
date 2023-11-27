<?php
// Start the session
session_start();

require_once __DIR__ . '/../vendor/autoload.php';

use MongoDB\Client;

$mongoClient = new Client("mongodb://localhost:27017");

// Select the database and collection
$database = $mongoClient->selectDatabase('userdetails');
$collection = $database->selectCollection('users');

// Get data from POST request
$dateOfBirth = $_POST['dateOfBirth'];
$contact = $_POST['contact'];

// Insert data into MongoDB
$result = $collection->insertOne([
    'dateOfBirth' => $dateOfBirth,
    'contact' => $contact
]);

// Check if the data was inserted successfully
if ($result->getInsertedCount() > 0) {
    // Set user details in the PHP session
    $_SESSION['dateOfBirth'] = $dateOfBirth;
    $_SESSION['contact'] = $contact;

    // Set the user details in Redis (assuming Redis is running on localhost)
    $redis = new Redis();
    $redis->connect('127.0.0.1', 6379); // Update with your Redis host and port

    // Set the user details in Redis with a key (you can customize the key as needed)
    $redisKey = 'profile:' . $_SESSION['username'];
    $redis->set($redisKey, json_encode(['dateOfBirth' => $dateOfBirth, 'contact' => $contact]));

    // Close the Redis connection
    $redis->close();

    echo json_encode(['message' => 'Profile updated successfully']);
} else {
    echo json_encode(['message' => 'Error updating profile']);
}
?>
