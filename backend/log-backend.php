<?php
session_start();
require 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $hashedPassword);

    if ($stmt->num_rows > 0) {
        $stmt->fetch();
        if (password_verify($password, $hashedPassword)) { 
            $_SESSION['user_id'] = $id;
            header("Location: ../front-end/dashboard.php");
            exit();
        } else {
            echo "Invalid credentials!";
        }
    } else {
        header("Location: ../front-end/register.php"); 
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>
