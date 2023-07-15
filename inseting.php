<?php
include "connection.php";
session_start();
$id = $_SESSION['id'];
// Retrieve the textarea data sent from the form
$q1 = $_POST['q1'];
$q2= $_POST['q2'];
$q3 = $_POST['q3'];
$q4 = $_POST['q4'];

// Prepare and execute SQL statement for inserting data into table (replace 'table_name' with your actual table name)
$sql = "INSERT INTO questions (Id,q1,q2,q3,q4) VALUES (?,?,?,?,?)
        ON DUPLICATE KEY UPDATE q1=VALUES(q1), q2=VALUES(q2), q3=VALUES(q3), q4=VALUES(q4)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss",$id, $q1,$q2,$q3,$q4); // 's' represents string datatype
if ($stmt->execute()) {
    echo "Codes successfully Saved!";
} else {
    echo "Error: ".$stmt->error;
}
$stmt->close();

$conn->close();
?>