<?php
$id = $_POST['id'];
include "connection.php";
$sql = "SELECT * FROM college WHERE Id = '$id'";
$result = mysqli_query($conn, $sql); // Assuming you have a valid database connection
if ($result) {
    $row_count = mysqli_num_rows($result);
    if ($row_count == 0) {
        echo "404";
    } 
    else if ($row_count > 0) {
        $sql = "SELECT Id FROM questions WHERE Id = '$id'";
        $result = mysqli_query($conn, $sql); // Assuming you have a valid database connection
        $row_count = mysqli_num_rows($result);
        if ($row_count == 0) {
            $sql = "INSERT INTO questions (Id) VALUES (?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $id); // 's' represents string datatype
            $stmt->execute();
            session_start();
            $_SESSION["id"] = $id;
            echo "202";
            $stmt->close();
        }
        else {
            session_start();
            $_SESSION["id"] = $id;
            echo "202";
        }
    }
} else {
    echo "Error executing the query: " . mysqli_error($conn);
}
// Prepare and execute SQL statement for inserting data into table (replace 'table_name' with your actual table name)
$conn->close();
?>