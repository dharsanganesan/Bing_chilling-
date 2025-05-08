<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "bing_chilling";

$conn = new mysqli($host, $user, $pass, $dbname);
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
