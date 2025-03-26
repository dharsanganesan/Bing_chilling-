<?php
session_start();
require '../backend/connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$update_success = false;
$error_message = '';
$edit_mode = isset($_GET['edit']) && $_GET['edit'] == 'true';

// Fetch user details
$stmt = $conn->prepare("SELECT name, email, phone, profile_pic FROM signup WHERE s_no = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($name, $email, $phone, $profile_pic);
$stmt->fetch();
$stmt->close();

// Set defaults
$name = $name ?? 'User';
$email = $email ?? 'Not Provided';
$phone = $phone ?? 'Not Provided';

// Handle profile picture path
$upload_dir = "../uploads/";
$default_image = "../assets/images/default-profile.png";

if (!empty($profile_pic) && file_exists($upload_dir . $profile_pic)) {
    $profile_pic_path = $upload_dir . $profile_pic;
} else {
    $profile_pic_path = $default_image;
}

// Store in session
$_SESSION['profile_pic'] = $profile_pic_path;
$_SESSION['name'] = $name;
$_SESSION['email'] = $email;
$_SESSION['phone'] = $phone;

// Handle profile update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Update name if provided
    if (!empty($_POST['name'])) {
        $new_name = htmlspecialchars(trim($_POST['name']));
        $stmt = $conn->prepare("UPDATE signup SET name = ? WHERE s_no = ?");
        $stmt->bind_param("si", $new_name, $user_id);
        if ($stmt->execute()) {
            $_SESSION['name'] = $new_name;
            $name = $new_name;
            $update_success = true;
        } else {
            $error_message = "Failed to update name.";
        }
        $stmt->close();
    }

    // Handle profile picture upload
    if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] == UPLOAD_ERR_OK) {
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }
        
        $file_name = uniqid() . '_' . basename($_FILES["profile_pic"]["name"]);
        $target_file = $upload_dir . $file_name;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        
        $check = getimagesize($_FILES["profile_pic"]["tmp_name"]);
        if ($check !== false) {
            $allowed_extensions = ["jpg", "jpeg", "png", "gif"];
            if (in_array($imageFileType, $allowed_extensions)) {
                if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) {
                    if ($profile_pic_path !== $default_image && file_exists($profile_pic_path)) {
                        unlink($profile_pic_path);
                    }
                    
                    $stmt = $conn->prepare("UPDATE signup SET profile_pic = ? WHERE s_no = ?");
                    $stmt->bind_param("si", $file_name, $user_id);
                    if ($stmt->execute()) {
                        $_SESSION['profile_pic'] = $target_file;
                        $profile_pic_path = $target_file;
                        $update_success = true;
                    } else {
                        $error_message = "Failed to update profile picture in database.";
                    }
                    $stmt->close();
                } else {
                    $error_message = "Sorry, there was an error uploading your file.";
                }
            } else {
                $error_message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            }
        } else {
            $error_message = "File is not an image.";
        }
    }
    
    // After successful update, exit edit mode
    if ($update_success) {
        $edit_mode = false;
    }
}
$conn->close();
?>

<?php include 'header.php'; ?>
   <style>
        :root {
            --primary-color: #4a6bff;
            --secondary-color: #3a5bef;
            --light-gray: #f8f9fa;
            --dark-gray: #343a40;
            --success-color: #28a745;
            --error-color: #dc3545;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: var(--light-gray);
            color: #333;
            line-height: 1.6;
        }
        .profile-info {
    display: block;
    align-items: center;
    margin-bottom: 1rem;
}

        .profile-section {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 2rem;
        }

        .profile-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 420px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .profile-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        .profile-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 2rem 1rem;
            text-align: center;
            position: relative;
        }

        .profile-picture {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid white;
            margin: 0 auto 1rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease;
        }

        .profile-picture:hover {
            transform: scale(1.05);
        }

        .profile-name {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .profile-email {
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .profile-body {
            padding: 2rem;
        }

        .profile-info {
            margin-bottom: 1.5rem;
        }

        .info-item {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #eee;
        }

        .info-icon {
            width: 40px;
            height: 40px;
            background: var(--light-gray);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            color: var(--primary-color);
        }

        .info-content h4 {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 0.2rem;
        }

        .info-content p {
            font-size: 1rem;
            font-weight: 500;
            color: #333;
        }



        .form-group {
            margin-bottom: 1.2rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #555;
        }

        .form-control {
            width: 100%;
            padding: 0.8rem 1rem;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 0.95rem;
            transition: border-color 0.3s;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(74, 107, 255, 0.1);
        }

        .file-input-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
            width: 100%;
        }

        .file-input-button {
            width: 100%;
            padding: 0.8rem 1rem;
            background: var(--light-gray);
            border: 1px dashed #ccc;
            border-radius: 8px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
        }

        .file-input-button:hover {
            background: #e9ecef;
            border-color: var(--primary-color);
        }

        .file-input {
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        .btn {
            display: inline-block;
            padding: 0.8rem 1.5rem;
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.3s;
            width: 100%;
        }

        .btn:hover {
            background: var(--secondary-color);
        }

        .btn-edit {
            background: transparent;
            color: var(--primary-color);
            border: 1px solid var(--primary-color);
            margin-bottom: 1rem;
        }

        .btn-edit:hover {
            background: rgba(74, 107, 255, 0.1);
        }

        .btn-cancel {
            background: #f8f9fa;
            color: #6c757d;
            border: 1px solid #dee2e6;
            margin-top: 1rem;
        }

        .btn-cancel:hover {
            background: #e9ecef;
        }



        .logout-btn {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 45px;
            height: 45px;
            background: var(--primary-color);
            color: white;
            border-radius: 50%;
            margin: 1.5rem auto 0;
            font-size: 1.2rem;
            text-decoration: none;
            transition: all 0.3s;
        }

        .logout-btn:hover {
            background: var(--secondary-color);
            transform: scale(1.1);
        }

        .alert {
            padding: 0.8rem 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
        }

        .alert-success {
            background-color: rgba(40, 167, 69, 0.1);
            color: var(--success-color);
            border: 1px solid rgba(40, 167, 69, 0.2);
        }

        .alert-error {
            background-color: rgba(220, 53, 69, 0.1);
            color: var(--error-color);
            border: 1px solid rgba(220, 53, 69, 0.2);
        }

        @media (max-width: 480px) {
            .profile-section {
                padding: 1rem;
            }
            
            .profile-card {
                border-radius: 12px;
            }
            
            .profile-header {
                padding: 1.5rem 1rem;
            }
            
            .profile-picture {
                width: 100px;
                height: 100px;
            }
        }
    </style>
<body>
    <section class="profile-section">
        <div class="profile-card">
            <div class="profile-header">
                <img src="<?php echo htmlspecialchars($profile_pic_path); ?>" alt="Profile Picture" class="profile-picture" id="profileImagePreview">
                <h2 class="profile-name"><?php echo htmlspecialchars($name); ?></h2>
                <p class="profile-email"><?php echo htmlspecialchars($email); ?></p>
            </div>
            
            <div class="profile-body">
                <?php if ($update_success): ?>
                    <div class="alert alert-success">
                        Profile updated successfully!
                    </div>
                <?php elseif (!empty($error_message)): ?>
                    <div class="alert alert-error">
                        <?php echo htmlspecialchars($error_message); ?>
                    </div>
                <?php endif; ?>
                
                <div class="profile-info">
                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="info-content">
                            <h4>Full Name</h4>
                            <p><?php echo htmlspecialchars($name); ?></p>
                        </div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="info-content">
                            <h4>Email Address</h4>
                            <p><?php echo htmlspecialchars($email); ?></p>
                        </div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="info-content">
                            <h4>Phone Number</h4>
                            <p><?php echo htmlspecialchars($phone); ?></p>
                        </div>
                    </div>
                </div>
                
                <div class="action-buttons">
                    <a href="?edit=true" class="btn btn-edit">
                        <i class="fas fa-edit"></i> Edit Profile
                    </a>
                    <a href="logout.php" class="logout-btn" title="Logout">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </div>
                
                <form action="" method="POST" enctype="multipart/form-data" class="profile-form">
                    <div class="form-group">
                        <label for="name">Update Your Name</label>
                        <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($name); ?>" placeholder="Enter your new name">
                    </div>
                    
                    <div class="form-group">
                        <label>Update Profile Picture</label>
                        <div class="file-input-wrapper">
                            <div class="file-input-button">
                                <i class="fas fa-camera"></i> Choose a new photo
                            </div>
                            <input type="file" class="file-input" name="profile_pic" id="profilePicInput" accept="image/*">
                        </div>
                    </div>
                    
                    <button type="submit" class="btn">Save Changes</button>
                    <a href="?" class="btn btn-cancel">Cancel</a>
                </form>
            </div>
        </div>
    </section>

    <script>
        // Preview image before upload
        document.getElementById('profilePicInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    document.getElementById('profileImagePreview').src = event.target.result;
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>
<?php include 'footer.php'; ?>