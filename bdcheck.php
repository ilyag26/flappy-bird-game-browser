<?php
$servername = "localhost";
$username = "id11922656_root";
$password = "";
$dbname = "id11922656_users";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM `users`";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "id: " . $row["id"]. " - Name: " . $row["login"]. " " . $row["score"]. "<br>";
    }
} else {
    echo "0 results";
}

mysqli_close($conn);
?>