<?php
// Database configuration made by CHANCHAN
$servername = "localhost"; // Change this to your MySQL server hostname if different
$username = "root"; // Change this to your MySQL username
$password = ""; // Change this to your MySQL password
$database = "corememories"; // Change this to your MySQL database name

// Create connection
$mysqli = new mysqli($servername, $username, $password, $database);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "corememories"; 

$conn = new mysqli($servername, $username, $password, $dbname) or die("Connect failed: %s\n" . $conn->error);

if (!$conn) {
    die("Connection Failed. " . mysqli_connect_error());
    echo "can't connect to the database";
}

function executeQuery($query)
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "corememories"; 

    $conn = new mysqli($servername, $username, $password, $dbname) or die("Connect failed: %s\n" . $conn->error);

    $results = mysqli_query($conn, $query);

   
    mysqli_close($conn);

    return $results;
}
?>
