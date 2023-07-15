<?php
// Establish connection to your MySQL database (replace these values with your own)
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "database";

$conn = new mysqli($servername, $username, $password, $dbname, 3308);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>