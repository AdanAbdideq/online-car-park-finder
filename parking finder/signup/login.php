<?php
require '../session/session.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <style>
           body {
            font-family: sans-serif;
            background-color: #f1f8fc;
        }

        .container {
            width: 400px;
            margin: 100px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .login,
        .signup {
            margin-top: 20px;
        }

        .login h2,
        .signup h2 {
            text-align: center;
        }

        form {
            width: 100%;
        }

        input[type="text"],
        [type="password"] {
            margin-left: 30px;
            width: 80%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        input[type="submit"] {
            width: 97%;
            background-color: #000;
            color: #fff;
            cursor: pointer;
            border: none;
            height: 36px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        input[type="submit"]:hover {
            background-color: #333;
        }

        
    </style>
</head>
<body>
<div class="container">
<div id="loginPopup">
    <div class="popup-content">
        <form method="post" action="#">
            <div>
                <h1>Login</h1>
            </div>
            <div class="form-group">
                <input type="text" name="username" placeholder="Username" id="username-email" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Password" id="password" required>
            </div>
        
            <input type="submit" name="login">
            <p>Don't have an account? <a href="signup.php">Sign up</a></p>
            
            <?php
$conn = new mysqli('localhost', 'root', '', 'farhan');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM register WHERE (firstname = ? OR lastname = ? OR email = ?) AND password = ?");
    $stmt->bind_param("ssss", $username, $username, $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $row['email'];
        if ($_SESSION['username'] == 'adanhassan10294340843@zetech.ac.ke') {
            header("Location: ../admin/index.php");
        } else {
            header("Location: ../header_footer/index.php");
        }
        exit();
    } else {
        echo "<script>
            var errorMsg = document.createElement('div');
            errorMsg.classList.add('error-msg');

            var icon = document.createElement('i');
            icon.classList.add('fa', 'fa-exclamation-circle');
            icon.style.marginRight = '5px';
            icon.style.display = 'inline-block';
            icon.style.verticalAlign = 'middle';

            var message = document.createElement('span');
            message.innerText = 'Incorrect username or password. Please try again.';
            message.style.display = 'inline-block';
            message.style.verticalAlign = 'middle';

            errorMsg.appendChild(icon);
            errorMsg.appendChild(message);

            document.body.appendChild(errorMsg);

            document.addEventListener('click', function() {
                errorMsg.style.display = 'none';
            });
        </script>";

        echo "<style>
            .error-msg {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                background-color: #ff0000;
                color: #ffffff;
                padding: 10px;
                margin-bottom: 10px;
                text-align: center;
            }
        </style>";
    }

    $stmt->close();
}

$conn->close();
?>



        </form>
    </div>
</div>
</div>
</body>
</html>


    