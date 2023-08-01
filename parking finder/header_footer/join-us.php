<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Parking Spot</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #1c1c1c;
      color: #FFFFFF;
      margin: 0;
      padding: 0;
    }

    h2 {
      text-align: center;
      margin-top: 50px;
      color: #FFFFFF;
    }

    form {
      max-width: 400px;
      margin: 0 auto;
      padding: 20px;
      background-color: #222222;
      border-radius: 10px;
    }

    label {
      display: block;
      margin-bottom: 10px;
      font-weight: bold;
      color: #FFFFFF;
    }

    input[type="text"],
    input[type="number"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 20px;
      background-color: #333333;
      border: none;
      color: #FFFFFF;
    }

    input[type="submit"] {
      width: 100%;
      padding: 10px;
      background-color: #1d7b54;
      color: #FFFFFF;
      border: none;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #1a6349;
    }

    .success {
      margin-top: 20px;
      padding: 10px;
      background-color: #008000;
      color: #FFFFFF;
      text-align: center;
      border-radius: 5px;
    }

    .error {
      margin-top: 20px;
      padding: 10px;
      background-color: #FF0000;
      color: #FFFFFF;
      text-align: center;
      border-radius: 5px;
    }
  </style>
</head>
<body>
  <h2>Add Parking Spot</h2>
  <form action="#" method="POST">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>

    <label for="latitude">Latitude:</label>
    <input type="text" id="latitude" name="latitude" required>

    <label for="longitude">Longitude:</label>
    <input type="text" id="longitude" name="longitude" required>

    <label for="price_per_hour">Price:</label>
<input type="number" id="price_per_hour" name="price_per_hour" required>


    <input type="submit" value="Add Parking Spot">
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Retrieve the form data
      $name = isset($_POST['name']) ? $_POST['name'] : '';
      $latitude = isset($_POST['latitude']) ? $_POST['latitude'] : '';
      $longitude = isset($_POST['longitude']) ? $_POST['longitude'] : '';
      $price_per_hour = isset($_POST['price_per_hour']) ? $_POST['price_per_hour'] : '';

      // Create a connection to the database
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

      // Escape the input values
      $name = mysqli_real_escape_string($connection, $name);
      $latitude = mysqli_real_escape_string($connection, $latitude);
      $longitude = mysqli_real_escape_string($connection, $longitude);
      $price_per_hour = mysqli_real_escape_string($connection, $price_per_hour);

      // Check if the parking lot already exists
      $query = "SELECT * FROM $table WHERE name='$name'";
      $result = mysqli_query($connection, $query);

      if (mysqli_num_rows($result) > 0) {
        echo '<div class="error">Parking spot already exists!</div>';
      } else {
        // Insert the parking spot data into the table
        $query = "INSERT INTO $table (name, latitude, longitude, price_per_hour) VALUES ('$name', '$latitude', '$longitude', '$price_per_hour')";
        $insertResult = mysqli_query($connection, $query);

        if ($insertResult) {
          echo '<div class="success">Parking spot added successfully!</div>';
        } else {
          echo '<div class="error">Error: ' . mysqli_error($connection) . '</div>';
        }
      }

      // Close the database connection
      mysqli_close($connection);
    }
    ?>
  </form>
</body>
</html>
