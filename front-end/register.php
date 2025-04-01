<?php
include '../backend/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $reg_no = mysqli_real_escape_string($conn, $_POST['reg_no']);
    $profile_pic = mysqli_real_escape_string($conn, $_POST['profile_pic']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Secure password

    // Check if email already exists
    $checkEmailQuery = "SELECT * FROM signup WHERE email = '$email'";
    $result = mysqli_query($conn, $checkEmailQuery);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>
                alert('Email already exists! Please use a different email.');
                window.location.href = 'register.php';
              </script>";
        exit();
    }

    $profile_pic = "../uploads/default.png"; // Default profile pic

    if (!empty($_FILES['profile_pic']['name'])) {
      $target_dir = "../uploads/"; // Ensure this folder exists
      if (!file_exists($target_dir)) {
          mkdir($target_dir, 0777, true);
      }
  
      $file_name = time() . "_" . basename($_FILES["profile_pic"]["name"]); // Unique file name
      $target_file = $target_dir . $file_name;
  
      if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) {
          $profile_pic = $file_name; // Save only the file name in DB
      }
  }

    // Insert new user data into the database
    $query = "INSERT INTO signup (name,reg_no, email, phone, profile_pic, password) 
              VALUES ('$name','$reg_no', '$email', '$phone', '$profile_pic', '$password')";

    if (mysqli_query($conn, $query)) {
        echo "<script>
                alert('Registration successful!');
                window.location.href = 'dashboard.php';
              </script>";
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bing Chilling</title>
  <link rel="icon" type="image/png" href="../image/home-log.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    body {
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: #f4f4f4;
      margin: 0;
      padding: 20px;
    }
    .container {
      display: flex;
      max-width: 900px;
      width: 90%;
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      overflow: hidden;
      margin: 0 auto; 
    }
    .auth-image-container {
      width: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      color: white;
      padding: 0px;
      position: relative;
      overflow: hidden;
    }
    .auth-form-container {
      width: 50%;
      padding: 50px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }
    @media (max-width: 768px) {
      .container {
        flex-direction: column;
        width: 90%;
      }
      .auth-form-container, .auth-image-container {
        width: 100%;
      }
    }
    .auth-form {
      display: flex;
      flex-direction: column;
      gap: 15px !important;
    }
    .auth-image-container img {
      position: relative;
      z-index: 2;
      width: 100%;
      margin-left: 40px !important;
    }
    .form-group {
      display: flex;
      flex-direction: column;
      gap: 10px;
      padding-top: 0px;
    }
    .form-group label {
      font-weight: 500;
    }
    .form-group input {
      padding: 0.75rem 1rem;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 1rem;
      transition: border-color 0.3s;
    }
    .form-group input:focus {
      outline: none;
      border-color: #8b5cf6;
      box-shadow: 0 0 0 2px rgba(139, 92, 246, 0.2);
    }
    .form-checkbox {
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .form-checkbox input[type="checkbox"] {
      width: 1rem;
      height: 1rem;
    }
    .form-checkbox label {
      font-size: 0.875rem;
      color: #666;
    }
    .form-checkbox a{      text-decoration: none;
      transition: color 0.3s;
      font-weight: 600;}
    .auth-submit {
      margin-top: 0px;
    }
    .auth-submit input {
      width: 100%;
      padding: 0.75rem;
      font-size: 1rem;
      background-color: #8b5cf6;
      color: white;
      border: none;
      border-radius: 8px;
      font-size: bold;
      cursor: pointer;
    }
    .auth-submit input:hover {
      background-color: #7c4dff;
    }
    .auth-divider {
      display: flex;
      align-items: center;
      margin: 4.5px 0;
      gap: 1rem;
    }
    .auth-divider hr {
      flex: 1;
      border: none;
      height: 1px;
      background-color: #ccc;
    }
    .auth-divider span {
      color: #666;
      font-size: 0.875rem;
    }
    .social-login {
      display: flex;
      gap: 1rem;
    }
    .social-btn {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
      padding: 0.75rem;
      border: 1px solid #ccc;
      border-radius: 8px;
      background-color: #f4f4f4;
      cursor: pointer;
      transition: background-color 0.3s;
    }
    .social-btn:hover {
      background-color: #e0e0e0;
    }
    .social-btn i {
      font-size: 1.125rem;
    }
    .google-btn i {
      color: #DB4437;
    }
    .facebook-btn i {
      color: #4267B2;
    }
    .auth-footer {
      text-align: center;
      margin-top: 2rem;
      font-size: 0.875rem;
      color: #666;
    }
    .auth-footer a {
      color: #8b5cf6;
      font-weight: 500;
      text-decoration: none;
      transition: color 0.3s;
      font-weight: 600;
    }
    .password-input-wrapper {
      position: relative;
    }
    .toggle-password {
      position: absolute;
      right: 1rem;
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      cursor: pointer;
      color: #666;
    }
    .password-strength {
      margin-top: 0.5rem;
      height: 0.25rem;
      width: 100%;
      background-color: #e0e0e0;
      border-radius: 4px;
      overflow: hidden;
    }
    .password-strength-meter {
      height: 100%;
      width: 0%;
      transition: width 0.3s, background-color 0.3s;
    }
    .password-strength-text {
      font-size: 0.75rem;
      color: #666;
      margin-top: 0.25rem;
    }
  </style>
</head>
<body>
  <main style="height:80%;">
    <div class="container">
      <div class="auth-image-container">
        <img src="../image/signup-11.gif" alt="Signup" class="right">
      </div>
      <div class="auth-form-container">
        <div class="auth-header">
          <h1>Create an Account</h1>
          <p>Start your journey with Bing Chilling</p>
        </div>
        <form class="auth-form" id="register-form" method="POST" enctype="multipart/form-data" action="register.php">
          <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" placeholder="John Doe" required>
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="your.email@example.com" required>
          </div>
          <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="text" id="phone" name="phone" placeholder="+91 456321789" required maxlength="10">
          </div>
          <div class="form-group">
            <label for="reg_no">Register Number</label>
            <input type="text" id="reg_no" name="reg_no" placeholder="6113221031023" required maxlength="13">
          </div>
          <div class="form-group">
            <label for="photo">Profile Phone</label>
        <input type="file" id="profile_pic" name="profile_pic"  required>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <div class="password-input-wrapper">
              <input type="password" id="password" name="password" placeholder="••••••••" required>
              <button type="button" class="toggle-password" aria-label="Toggle password visibility">
                <i class="fas fa-eye"></i>
              </button>
            </div>
            <div class="password-strength">
              <div class="password-strength-meter" id="password-meter"></div>
            </div>
            <div class="password-strength-text" id="password-strength-text">Password strength</div>
          </div>
          <div class="form-group">
            <label for="confirm-password">Confirm Password</label>
            <div class="password-input-wrapper">
              <input type="password" id="confirm-password" name="confirm-password" placeholder="••••••••" required>
              <button type="button" class="toggle-password" aria-label="Toggle confirm password visibility">
                <i class="fas fa-eye"></i>
              </button>
            </div>
          </div>
          <div class="form-checkbox">
            <input type="checkbox" id="terms" name="terms" required>
            <label for="terms">I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a></label>
          </div>
          
          <div class="auth-submit">
            <input type="submit" class="btn btn-primary" value="Create Account">
          </div>
        </form>
        <div class="auth-divider">
          <hr><span>OR</span><hr>
        </div>
        <div class="social-login">
          <button class="social-btn google-btn">
            <i class="fab fa-google"></i>
            <span>Google</span>
          </button>
          <button class="social-btn facebook-btn">
            <i class="fab fa-facebook-f"></i>
            <span>Facebook</span>
          </button>
        </div>
        <div class="auth-footer">
          Already have an account? <a href="login.php">Log in</a>
        </div>
      </div>
    </div>
  </main>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Toggle password visibility
      const togglePasswordButtons = document.querySelectorAll('.toggle-password');
      togglePasswordButtons.forEach(button => {
        button.addEventListener('click', function() {
          const input = this.previousElementSibling;
          const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
          input.setAttribute('type', type);
          this.querySelector('i').classList.toggle('fa-eye');
          this.querySelector('i').classList.toggle('fa-eye-slash');
        });
      });

      // Password strength meter
      const passwordInput = document.getElementById('password');
      const passwordMeter = document.getElementById('password-meter');
      const passwordText = document.getElementById('password-strength-text');
      passwordInput.addEventListener('input', function() {
        const password = this.value;
        let strength = 0;
        if (password.length >= 8) strength += 25;
        if (/[A-Z]/.test(password)) strength += 25;
        if (/[0-9]/.test(password)) strength += 25;
        if (/[^A-Za-z0-9]/.test(password)) strength += 25;
        passwordMeter.style.width = strength + '%';
        if (strength <= 25) {
          passwordMeter.style.backgroundColor = '#ff4444';
          passwordText.textContent = 'Weak';
        } else if (strength <= 50) {
          passwordMeter.style.backgroundColor = '#ffbb33';
          passwordText.textContent = 'Fair';
        } else if (strength <= 75) {
          passwordMeter.style.backgroundColor = '#00C851';
          passwordText.textContent = 'Good';
        } else {
          passwordMeter.style.backgroundColor = '#00C851';
          passwordText.textContent = 'Strong';
        }
      });

      // Handle form submission
      const registerForm = document.getElementById('register-form');
      registerForm.addEventListener('submit', function(e) {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirm-password').value;
        if (password !== confirmPassword) {
          e.preventDefault();
          alert('Passwords do not match!');
        }
      });

      // Handle social login buttons
      const socialButtons = document.querySelectorAll('.social-btn');
      socialButtons.forEach(button => {
        button.addEventListener('click', function() {
          const provider = this.classList.contains('google-btn') ? 'Google' : 'Facebook';
          alert(`${provider} sign-up is not implemented in this demo.`);
        });
      });
    });
  </script>
</body>
</html>