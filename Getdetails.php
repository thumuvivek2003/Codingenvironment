<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<?php
include "connection.php";
$sql = "SELECT * FROM questions";
$result = mysqli_query($conn, $sql);

// Assuming you have a valid database connection
echo '<form id="myForm" method="POST" action="qserver.php">
<table class="table table-striped">
  <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
  <input  name = "id" type="hidden" id="value">
 ';
while ($row = $result->fetch_assoc()) {
    $id = $row["Id"];
    $s = "SELECT Name FROM college where Id = '$id'";
    $res = mysqli_query($conn, $s); // Assuming you have a valid database connection
    $name = $student = $res->fetch_assoc()["Name"];
    echo '
    <tr>
      <td>' . $id . '</td> 
      <td>' . $name . '</td> 
      <td> <button class="btn btn-primary" type="button" onclick="'."send('$id')".'">GET</button>
      </td>
    </tr>
    ';
}
echo '</tbody></table></form>'
    ?>


<script>
function send(value) {
    console.log("clicke");
  // Set the clicked button value in the hidden input field
  document.getElementById("value").value = value;
  // Submit the form
  document.getElementById("myForm").submit();
}
</script>