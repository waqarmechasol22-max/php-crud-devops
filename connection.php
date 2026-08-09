<?php

$host = "db";
$username = "crud_user";
$password = "crud_password";
$database = "crud_db";

$conn = new mysqli(
    $host,
    $username,
    $password,
    $database
);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

?>