<?php
// db.php

$host = 'localhost'; // Change this to your database host
$dbname = 'fcc_amateur'; // The database name
$username = 'fcc_amateur'; // Your database username
$password = ''; // Your database password

// Create a PDO instance
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
