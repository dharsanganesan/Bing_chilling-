<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_username = "admin";
    $admin_password = "password";

    $username = $_POST["username"];
    $password = $_POST["password"];

    if ($username === $admin_username && $password === $admin_password) {
        $_SESSION["admin_logged_in"] = true;
        header("Location: admin_index.php");
        exit();
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bing Chilling Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../image/home-log.png">
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    body {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        padding: 20px;
    }

    .container {
        width: 100%;
        max-width: 800px;
        animation: fadeInUp 0.8s ease-out;
    }

    .login-card {
        display: flex;
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
    }

    .image-side {
        flex: 1;
        background: linear-gradient(135deg, #007acc 0%, #00c6fb 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px;
    }

    .image-side img {
        max-width: 100%;
        height: auto;
        animation: float 3s ease-in-out infinite;
    }

    .form-side {
        flex: 1;
        padding: 40px;
    }

    h2 {
        background: linear-gradient(to right, #8B5CF6, #0EA5E9);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent;
        margin-bottom: 30px;
        font-size: 28px;
        text-align: center;
    }

    input {
        width: 100%;
        padding: 12px 15px;
        margin: 10px 0;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 16px;
        transition: all 0.3s;
    }

    input:focus {
        border-color: #007acc;
        box-shadow: 0 0 0 3px rgba(0, 122, 204, 0.2);
        outline: none;
    }

    .btn-login {
        background: linear-gradient(to right, #007acc, #00c6fb);
        color: white;
        padding: 12px;
        width: 100%;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 16px;
        font-weight: bold;
        margin-top: 20px;
        transition: all 0.4s;
        position: relative;
        overflow: hidden;
    }

    .btn-login:hover {
        background: linear-gradient(to right, #0066b3, #00a8e8);
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .btn-login:active {
        transform: translateY(-1px);
    }

    .btn-login::after {
        content: "";
        display: block;
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        background: linear-gradient(to right, #00c6fb, #007acc);
        opacity: 0;
        transition: all 0.4s;
        z-index: -1;
    }

    .btn-login:hover::after {
        opacity: 1;
    }

    .error {
        color: #e74c3c;
        font-size: 14px;
        text-align: center;
        margin-top: 10px;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes float {
        0% {
            transform: translateY(0px);
        }
        50% {
            transform: translateY(-10px);
        }
        100% {
            transform: translateY(0px);
        }
    }

    @media (max-width: 768px) {
        .login-card {
            flex-direction: column;
        }
        
        .image-side {
            padding: 20px;
        }
        
        .form-side {
            padding: 30px;
        }
    }
</style>
<body>
    <div class="container">
        <div class="login-card">
            <div class="image-side">
                <img src="https://cdn-icons-png.flaticon.com/512/295/295128.png" alt="Admin Login">
            </div>
            <div class="form-side">
                <h2>Admin Sign In</h2>
                <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
                <form method="POST" action="admin_index.php">
                    <input type="text" name="username" placeholder="Username" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <button type="submit" class="btn-login">SIGN IN</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>