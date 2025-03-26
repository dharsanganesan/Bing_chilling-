<?php
$conn = new mysqli("localhost", "root", "", "your_database_name");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT name, email, profile_pic FROM users";
$result = $conn->query($sql);

echo "<h2>Uploaded Profiles</h2>";
while ($row = $result->fetch_assoc()) {
    echo "<p><strong>Name:</strong> " . $row['name'] . "<br>";
    echo "<strong>Email:</strong> " . $row['email'] . "<br>";
    echo "<img src='uploads/" . $row['profile_pic'] . "' width='100'></p>";
}

$conn->close();
?>
