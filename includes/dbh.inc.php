<?php

$serverName = "localhost:3309";
$dbUsername = "root";
$dbPassword = "";
$dbName = "ces_db";

// Create a connection to the database
$conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);

// Handles error in case database connection cannot be established
if(!$conn) {
    die("Connection failed: ".mysqli_connect_error());
}