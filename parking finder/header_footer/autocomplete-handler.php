<?php
if (isset($_GET['query'])) {
  $searchQuery = $_GET['query'];
  $similarNames = generateSimilarNames($searchQuery);
  echo json_encode($similarNames);
}

function generateSimilarNames($searchQuery)
{
  // Connect to the database
  $host = "localhost";
  $username = "root";
  $password = "";
  $database = "farhan";
  $table = "parking_spots";
  $connection = mysqli_connect($host, $username, $password, $database);

  // Check if the connection was successful
  if (mysqli_connect_errno()) {
    die("Database connection failed: " . mysqli_connect_error());
  }

  // Generate similar names
  $similarNames = [];
  $query = "SELECT name FROM $table WHERE name LIKE '%$searchQuery%'";
  $result = mysqli_query($connection, $query);

  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $similarNames[] = $row['name'];
    }
  }

  // Close the database connection
  mysqli_close($connection);

  return $similarNames;
}
