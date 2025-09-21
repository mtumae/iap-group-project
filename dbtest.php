<?php
require_once 'config.php';       
require_once 'ClassAutoLoad.php'; 

// Create Database object
$db = new Database($conf);

// Test connection
$conn = $db->connect();

if ($conn) {
    echo "Database connection successful!<br>";

    // Try a SELECT test query using the new helper method
    $users = $db->fetch("SELECT * FROM users LIMIT 5");

    if ($users) {
        echo "SELECT query successful, showing sample users:<br>";
        foreach ($users as $user) {
            echo "ID: {$user['id']} | Username: {$user['username']} | Email: {$user['email']}<br>";
        }
    } else {
        echo "No users found or query failed.";
    }

    // Try an INSERT test query 
    /*
    $insertId = $db->insert(
        "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)",
        [
            'username' => 'tester1',
            'email'    => 'tester1@example.com',
            'password' => password_hash("StrongPass123!", PASSWORD_DEFAULT)
        ]
    );

    if ($insertId) {
        echo "Insert successful! New user ID: $insertId";
    } else {
        echo "Insert failed.";
    }
    */

} else {
    echo "Database connection failed.";
}
