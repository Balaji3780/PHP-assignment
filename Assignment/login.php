<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $loginEmail = $_POST["loginEmail"];
    $loginPassword = $_POST["loginPassword"];

    $mysqli = new mysqli("localhost", "balaji", "root1234", "user_registration");

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    $stmt = $mysqli->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $loginEmail);
    $stmt->execute();
    $stmt->bind_result($userId, $hashedPassword);
    $stmt->fetch();

    if (password_verify($loginPassword, $hashedPassword)) {
        echo "Login successful. User ID: " . $userId;
    } else {
        echo "Invalid email or password";
    }

    $stmt->close();
    $mysqli->close();
}
?>
