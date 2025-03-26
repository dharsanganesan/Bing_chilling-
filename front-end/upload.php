<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Database connection
$conn = new mysqli("localhost", "root", "", "bing_chilling");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input
    $name = htmlspecialchars(trim($_POST['name']));
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars(trim($_POST['phone']));
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];

    // Check if email already exists
    $check_stmt = $conn->prepare("SELECT name FROM signup WHERE email = ?");
    $check_stmt->bind_param("s", $email);
    $check_stmt->execute();
    $check_stmt->store_result();
    
    if ($check_stmt->num_rows > 0) {
        echo "<script type='text/javascript'>
            alert('Error: The email is already registered. Please use a different email.');
            window.location.href = 'register.php';
              </script>";
    }
    $check_stmt->close();


    if ($password !== $confirm_password) {
        echo "<script type='text/javascript'>
        alert('Error: Passwords do not match!);
        window.location.href = 'register.php';
          </script>";
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    
    $profile_pic = "default.png"; 
    if (isset($_FILES['myfile']) && $_FILES['myfile']['error'] == 0) {
        $target_dir = "../uploads/";

        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $file_name = time() . "_" . basename($_FILES["myfile"]["name"]);
        $target_file = $target_dir . $file_name;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Allowed file types
        $allowed_extensions = ["jpg", "jpeg", "png", "gif"];
        if (!in_array($imageFileType, $allowed_extensions)) {
            die("Invalid file format. Only JPG, JPEG, PNG & GIF files are allowed.");
        }

        // Move file to 'uploads/' folder
        if (move_uploaded_file($_FILES["myfile"]["tmp_name"], $target_file)) {
            $profile_pic = $file_name;
        } else {
            die("Error: File upload failed.");
        }
    }

    // Insert user data
    $stmt = $conn->prepare("INSERT INTO signup (name, email, phone, password, profile_pic) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $email, $phone, $hashedPassword, $profile_pic);

    if ($stmt->execute()) {
        $_SESSION['user_id'] = $stmt->insert_id;
        header("URL=login.php"); // Redirect after 2 seconds
    } else {
        echo "Error: Could not register.";
    }

    $stmt->close();
}
$conn->close();
?>
