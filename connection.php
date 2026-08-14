<?php

$host = "db";
$username = "crud_user";
$password = "crud_password";
$database = "crud_db";

$conn = new mysqli("db", "crud_user", "crud_password", "crud_db");

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

?>