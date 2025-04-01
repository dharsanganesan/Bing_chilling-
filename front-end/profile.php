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
$profile_pic_path = (!empty($profile_pic) && file_exists($upload_dir . $profile_pic)) ? $upload_dir . $profile_pic : $default_image;

// Store in session
$_SESSION['profile_pic'] = $profile_pic_path;
$_SESSION['name'] = $name;
$_SESSION['email'] = $email;
$_SESSION['phone'] = $phone;

// Handle profile update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updates = [];

    if (!empty($_POST['name'])) {
        $new_name = htmlspecialchars(trim($_POST['name']));
        $updates['name'] = $new_name;
        $_SESSION['name'] = $new_name;
    }

    if (!empty($_POST['email'])) {
        $new_email = htmlspecialchars(trim($_POST['email']));
        $updates['email'] = $new_email;
        $_SESSION['email'] = $new_email;
    }

    if (!empty($_POST['phone'])) {
        $new_phone = htmlspecialchars(trim($_POST['phone']));
        $updates['phone'] = $new_phone;
        $_SESSION['phone'] = $new_phone;
    }

    // Handle profile picture upload
    if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] == UPLOAD_ERR_OK) {
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }
        $file_name = uniqid() . '_' . basename($_FILES["profile_pic"]["name"]);
        $target_file = $upload_dir . $file_name;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if (getimagesize($_FILES["profile_pic"]["tmp_name"])) {
            $allowed_extensions = ["jpg", "jpeg", "png", "gif"];
            if (in_array($imageFileType, $allowed_extensions)) {
                if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) {
                    if ($profile_pic_path !== $default_image && file_exists($profile_pic_path)) {
                        unlink($profile_pic_path);
                    }
                    $updates['profile_pic'] = $file_name;
                    $_SESSION['profile_pic'] = $target_file;
                } else {
                    $error_message = "Error uploading file.";
                }
            } else {
                $error_message = "Only JPG, JPEG, PNG & GIF files allowed.";
            }
        } else {
            $error_message = "File is not an image.";
        }
    }

    // Update the database with new values
    if (!empty($updates)) {
        $set_clause = implode(", ", array_map(fn($key) => "$key = ?", array_keys($updates)));
        $stmt = $conn->prepare("UPDATE signup SET $set_clause WHERE s_no = ?");
        $values = array_values($updates);
        $values[] = $user_id;
        $stmt->bind_param(str_repeat("s", count($updates)) . "i", ...$values);

        if ($stmt->execute()) {
            $update_success = true;
        } else {
            $error_message = "Failed to update profile.";
        }
        $stmt->close();
    }

    if ($update_success) {
        $edit_mode = false;
    }
}
$conn->close();
?>

<?php include 'header.php'; ?>
<style>

:root {
  --primary-color: #8B5CF6;
  --primary-light: #A78BFA;
  --primary-dark: #7C3AED;
  --secondary-color: #0EA5E9;
  --accent-color: #F97316;
  --text-color: #1A1F2C;
  --text-muted: #6B7280;
  --bg-color: #FFFFFF;
  --bg-secondary: #F9FAFB;
  --bg-accent: #F3F4F6;
  --border-color: #E5E7EB;
  --success-color: #10B981;
  --error-color: #EF4444;
  --warning-color: #F59E0B;
  --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
  --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
  --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
  --radius-sm: 0.25rem;
  --radius-md: 0.375rem;
  --radius-lg: 0.5rem;
  --radius-xl: 1rem;
  --font-sans: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
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
    .action-buttons {
        display: flex;
        width: 100%;
        border: 1px solid var(--primary-color);
        border-radius: 8px;
        overflow: hidden;
        margin-bottom: 1rem;
    }
    .action-buttons a,
    .action-buttons button {
        flex: 1;
        text-align: center;
        padding: 0.8rem 0;
        color: white;
        text-decoration: none;
        font-size: 1rem;
        font-weight: 500;
        transition: background 0.3s;
    }
    .action-buttons a.edit-btn,
    .action-buttons button.edit-btn {
        background: var(--primary-color);
        border-right: 1px solid rgba(255, 255, 255, 0.2);
    }
    .action-buttons a.logout-btn{
        background: var(--secondary-color);
    }
    
    .action-buttons a.cancel-btn {
    background: #ff6b6b; /* New red background color */
    color: white;
    text-decoration: none;
    padding: 0.8rem 0;
    font-size: 1rem;
    font-weight: 500;
    text-align: center;
    border-radius: 0px;
    transition: background 0.3s;
}
.action-buttons button.edit-btn {
    background: var(--success-color); /* Green background for Save Changes */
    color: white;
    text-decoration: none;
    padding: 0.8rem 0;
    font-size: 1rem;
    font-weight: 500;
    text-align: center;
    border-radius: 0px;
    transition: background 0.3s;
    border: none; /* Remove default button border */
    cursor: pointer;
}


.action-buttons a.cancel-btn:hover {
    background: #e63946; /* Darker red for hover effect */
}
.action-buttons button.edit-btn:hover {
    background: #218838; /* Darker green for hover effect */
}
    .action-buttons a:hover,
    .action-buttons button:hover {
        filter: brightness(1.1);
    }
    .alert {
        padding: 0.8rem 1rem;
        border-radius: 8px;
        margin-bottom: 1.5rem;
        font-size: 0.9rem;
    }
    .alert-success {
        background-color: rgba(255, 255, 255, 0.1);
        color: var(--success-color);
        border: 1px solid rgba(40, 167, 69, 0.2);
    }
    .alert-error {
        background-color: rgba(220, 53, 69, 0.1);
        color: var(--error-color);
        border: 1px solid rgba(220, 53, 69, 0.2);
    }
</style>
<body>
    <section class="profile-section">
        <div class="profile-card">
            <!-- Show profile header only when not in edit mode -->
            <?php if (!$edit_mode): ?>
                <div class="profile-header">
                    <img src="<?php echo htmlspecialchars($profile_pic_path); ?>" alt="Profile Picture" class="profile-picture" id="profileImagePreview">
                    <h2 class="profile-name"><?php echo htmlspecialchars($name); ?></h2>
                    <p class="profile-email"><?php echo htmlspecialchars($email); ?></p>
                </div>
            <?php endif; ?>
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
                <!-- Show profile info only when not in edit mode -->
                <?php if (!$edit_mode): ?>
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
                <?php endif; ?>
                <!-- Action Buttons -->
                <?php if (!$edit_mode): ?>
                    <div class="action-buttons">
                        <a href="?edit=true" class="edit-btn">
                            <i class="fas fa-edit"></i> Edit Profile
                        </a>
                        <a href="logout.php" class="logout-btn" title="Logout">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </div>
                <?php endif; ?>
                <!-- Edit Profile Form -->
                <?php if ($edit_mode): ?>
                    <form action="" method="POST" enctype="multipart/form-data" class="profile-form">
                        <div class="form-group">
                            <label for="name">Update Your Name</label>
                            <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($name); ?>" placeholder="Enter your new name">
                        </div>
                        <div class="form-group">
                            <label for="email">Update Your Email</label>
                            <input type="email" id="email" name="email" class="form-control" value="<?php echo htmlspecialchars($email); ?>" placeholder="Enter your new email">
                        </div>
                        <div class="form-group">
                            <label for="phone">Update Your Phone Number</label>
                            <input type="text" id="phone" name="phone" class="form-control" value="<?php echo htmlspecialchars($phone); ?>" placeholder="Enter your new phone number">
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
                        <!-- Save Changes and Cancel Buttons -->
                        <div class="action-buttons">
                            <button type="submit" class="edit-btn">
                                <i class="fas fa-save"></i> Save Changes
                            </button>
                            <a href="?" class="cancel-btn">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                        </div>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <script>
        // Preview image before upload
        document.getElementById('profilePicInput')?.addEventListener('change', function(e) {
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