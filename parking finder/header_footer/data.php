<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "farhan";
$table = "parking_spots";

// Create a connection to the database
$connection = mysqli_connect($host, $username, $password, $database);

// Check if the connection was successful
if (mysqli_connect_errno()) {
  die("Database connection failed: " . mysqli_connect_error());
}

// Fetch parking lot data from the database
$query = "SELECT name, latitude, longitude, price_per_hour FROM $table"; // Include the "price" column in the query
$result = mysqli_query($connection, $query);

// Fetch rows as an associative array
$data = [];
while ($row = mysqli_fetch_assoc($result)) {
  $data[] = $row;
}

// Close the database connection
mysqli_close($connection);

// Output the data as JSON
header('Content-Type: application/json');
echo json_encode($data, JSON_NUMERIC_CHECK);
?>
