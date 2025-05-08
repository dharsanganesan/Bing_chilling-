<?php
session_start();
require '../backend/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Modified query to use 'name' instead of 'username'
    $stmt = $conn->prepare("SELECT s_no, password, name FROM signup WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $hashedPassword, $name);  // Changed variable to $name

    if ($stmt->num_rows > 0) {
        $stmt->fetch();
        if (password_verify($password, $hashedPassword)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $name;  // Store the name in session
            header("Location: ../front-end/dashboard.php"); 
            exit();
        } else {
            $error_message = "Invalid credentials!";
        }
    } else { 
        header("Location: ../front-end/register.php");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bing Chilling</title>
  <link rel="icon" type="image/png" href="../image/home-log.png">
  <link rel="stylesheet" href="../style/styles.css">
  <link rel="stylesheet" href="../style/login_style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    body {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      background-color: #f4f4f4;
      margin: 0;
      padding: 20px;
    }
    .container {
      display: flex;
      max-width: 900px;
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      overflow: hidden;
      margin: 0 auto;
    }
    .auth-form-container {
      flex-direction: column;
      padding: 25px 15px 20px;
    }
    .form-group {
      margin-bottom: 15px;
      width: 100%;
    }
    .password-input-wrapper {
      display: flex;
      align-items: center;
    }
    .toggle-password {
      background: none;
      border: none;
      cursor: pointer;
      font-size: 16px;
    }
    .auth-submit button {
      width: 100%;
    }
    .auth-image-container {
      width: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 50px;
      position: relative;
      overflow: hidden;
    }
    .auth-image-container img {
      position: relative;
      z-index: 2;
    }
    .auth-divider {
      display: flex;
      align-items: center;
      margin: 9px 0;
      gap: 1rem;
    }
    .auth-footer {
      text-align: center;
      margin-top: 15px;
      font-size: 0.875rem;
      color: var(--text-muted);
    }
    .login-gif{
    width: 100%;
    margin-left: 90px;
    }
  </style>
</head>

<body>
  <main>
    <div class="container">
      <div class="auth-form-container">
        <div class="auth-header">
          <h1>Welcome Back</h1>
          <p>Enter your credentials to access your account</p>
        </div>
        <?php if (isset($error_message)): ?>
          <div class="error-message" style="color: red; text-align: center; margin-bottom: 15px;">
            <?php echo $error_message; ?>
          </div>
        <?php endif; ?>
        <form class="auth-form" id="login-form" method="POST">
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="your.email@example.com" required>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <div class="password-input-wrapper">
              <input type="password" id="password" name="password" placeholder="••••••••" required>
              <button type="button" class="toggle-password" aria-label="Toggle password visibility">
                <i class="fas fa-eye"></i>
              </button>
            </div>
          </div>
          <div class="forgot-password">
            <a href="#">Forgot password?</a>
          </div>
          <div class="auth-submit">
            <button type="submit" class="btn btn-primary">Log In</button>
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
          Don't have an account? <a href="register.php">Sign up</a>
        </div>
      </div>
      <div class="auth-image-container">
        <img src="../image/login.gif" alt="Login" class="right login-gif">
      </div>
    </div>
  </main>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const togglePassword = document.querySelector('.toggle-password');
      const passwordInput = document.getElementById('password');

      togglePassword.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.querySelector('i').classList.toggle('fa-eye');
        this.querySelector('i').classList.toggle('fa-eye-slash');
      });

      const loginForm = document.getElementById('login-form');
      loginForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        console.log('Logging in with:', { email, password });
        this.submit(); // Submit the form
      });

      const socialButtons = document.querySelectorAll('.social-btn');
      socialButtons.forEach(button => {
        button.addEventListener('click', function() {
          const provider = this.classList.contains('google-btn') ? 'Google' : 'Facebook';
          alert(`${provider} login is not implemented in this demo.`);
        });
      });
    });
  </script>
</body>
</html>