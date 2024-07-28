<?php
session_start();
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "therapy";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// User Registration
if (isset($_POST['signup'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO user (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $email, $password);

    if ($stmt->execute()) {
        header('Location: \hackathon-week-1\login.php');
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
}

// User Login
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT id, username, email, password FROM user WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($user_id, $user_username, $user_email, $hashed_password);
    $stmt->fetch();

    if ($stmt->num_rows > 0 && password_verify($password, $hashed_password)) {
        // Store user data in session
        // $_SESSION['user_id'] = $user_id;
        // $_SESSION['username'] = $user_username;
        // $_SESSION['email'] = $user_email;
        $_SESSION['is_logged_in'] = true;
        $_SESSION['user_data'] = array(
            "id"	=> $user_id,
            "pame"	=> $user_username,
            "email"	=> $user_email
        );
        header('Location: \hackathon-week-1\p_dashboard');
    } else {
        echo "Invalid username or password.";
    }
    $stmt->close();
}
$conn->close();
?>