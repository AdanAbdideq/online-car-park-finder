<?php
include '../session/session.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form input values
    $name = isset($_POST['fullname']) ? $_POST['fullname'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $feedback_text = isset($_POST['feedback_text']) ? $_POST['feedback_text'] : '';

    // Replace with your database credentials
    $host = 'localhost';
    $db = 'farhan';
    $user = 'root';
    $pass = '';

    // Create a PDO connection to the database
    $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
    $pdo = new PDO($dsn, $user, $pass);

    // Get the user ID from the register table
    $query = "SELECT id FROM register WHERE email = :email";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['email' => $email]);
    $userRow = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($userRow) {
        $userID = $userRow['id'];

        // Insert the feedback into the database
        $query = "INSERT INTO feedback (user_id, feedback_text) VALUES (?, ?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$userID, $feedback_text]);

        // Display a confirmation message
        $confirmationMessage = 'Thank you for your feedback!';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Contact Us</title>
    <link rel="stylesheet" type="text/css" href="style.css">
        <style>
                    body {
            margin-top: 20px;
            background-color: #f1f8fc;
        }

        .container {
            margin-bottom: 50px;
        }

        header {
            margin-bottom: 50px;
        }

        footer {
            margin-top: 50px;
        }

        .container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
        }

        h2 {
            text-align: center;
            font-size: 32;
            font-weight: bolder;
        }

        .form-group {
            margin-bottom: 20px;
        }

        input:-webkit-autofill,
        textarea:-webkit-autofill,
        select:-webkit-autofill {
            box-shadow: 0 0 0px 1000px #f1f8fc inset !important;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        textarea {
            margin-left: 20%;
            width: 60%;
            padding: 10px;
            border: none;
            border-bottom: 2px solid #000;
            border-radius: 0;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        textarea:focus {
            outline: none;
            border-bottom-color: #4CAF50;
        }

        button[type="submit"] {
            background-color: #FF0000;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-left: 40%;
            width: 30%;
        }

        button[type="submit"]:hover {
            background-color: #FF4500;
        }

        ::placeholder {
            color: #000;
            font-size: bold;
        }

        .form-group.fullname {
            display: none; /* Hide the full name field by default */
        }

        .confirmation {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #4CAF50;
            color: #fff;
            padding: 10px;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 9999;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s, visibility 0.3s;
        }

        .confirmation.show {
            opacity: 1;
            visibility: visible;
        }

        .confirmation .icon {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <header>
        <?php include "header.html"   ?>
    </header>
    <main>
    <div class="container">
            <h2>Contact Us</h2>
            <?php if (isset($confirmationMessage)) { ?>
                <div class="confirmation show">
                    <span class="icon">&#10003;</span>
                    <?php echo $confirmationMessage; ?>
                </div>
                <script>
                    setTimeout(function() {
                        var confirmation = document.querySelector('.confirmation');
                        confirmation.classList.remove('show');
                    }, 3000);
                </script>
            <?php } ?>
            <form action="#" method="POST">
                <!-- <div class="form-group">
                    <input type="text" id="name" placeholder="Name" name="fullname" value="<?php echo isset($_SESSION['fullname']) ? $_SESSION['fullname'] : ''; ?>">
                </div> -->
                <div class="form-group">
                    <input type="email" id="email" placeholder="Email" name="email" value="<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>" required>
                </div>
                <div class="form-group">
                    <textarea id="feedback_text" name="feedback_text" placeholder="Enter your feedback" required></textarea>
                </div>
                <button type="submit">Submit</button>
            </form>
        </div>
    </main>
    <footer>
        <?php include "footer.html"   ?>
    </footer>
</body>
</html>
