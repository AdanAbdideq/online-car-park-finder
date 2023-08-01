<?php
session_start();

function authenticateUser($loginIdentifier, $password) {
    $host = 'localhost';
    $db = 'farhan';
    $user = 'root';
    $pass = '';
    $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
    $pdo = new PDO($dsn, $user, $pass);
    $query = "SELECT * FROM register WHERE (firstname = :loginIdentifier OR lastname = :loginIdentifier OR email = :loginIdentifier)";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['loginIdentifier' => $loginIdentifier]);
    $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($userRow && password_verify($password, $userRow['password'])) {
        $_SESSION['user_id'] = $userRow['user_id']; // Set the user ID in the session
        $_SESSION['username'] = $loginIdentifier;
        $_SESSION['isLoggedIn'] = true;
        $_SESSION['firstname'] = $userRow['firstname'];
        $_SESSION['lastname'] = $userRow['lastname'];
        $_SESSION['fullname'] = isset($userRow['full_name']) ? $userRow['full_name'] : '';

        return true;
    } else {
        return false;
    }
}

if (isset($_POST['login'])) {
    $loginIdentifier = isset($_POST['loginIdentifier']) ? $_POST['loginIdentifier'] : ''; // Can be either first name, last name, or email
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    if (authenticateUser($loginIdentifier, $password)) {
        $_SESSION['isLoggedIn'] = true;
        $_SESSION['firstname'] = $_SESSION['firstname'] ?? '';
        $_SESSION['lastname'] = $_SESSION['lastname'] ?? '';
        $_SESSION['fullname'] = $_SESSION['fullname'] ?? '';
    } else {
        $error = 'Invalid username or password';
    }
}

if (isset($_POST['update'])) {
    $_SESSION['firstname'] = isset($_POST['firstname']) ? $_POST['firstname'] : '';
    $_SESSION['lastname'] = isset($_POST['lastname']) ? $_POST['lastname'] : '';
    $host = 'localhost';
    $db = 'farhan';
    $user = 'root';
    $pass = '';

    $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
    $pdo = new PDO($dsn, $user, $pass);
    $query = "UPDATE register SET firstname = :firstname, lastname = :lastname WHERE user_id = :user_id"; // Update based on user ID
    $stmt = $pdo->prepare($query);
    $stmt->execute(['firstname' => $_SESSION['firstname'], 'lastname' => $_SESSION['lastname'], 'user_id' => $_SESSION['user_id']]);
    $stmt->closeCursor();
}
?>
