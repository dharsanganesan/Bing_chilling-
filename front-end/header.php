<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bing Chilling</title>
  <link rel="stylesheet" href="../style/styles.css">
  <link rel="stylesheet" href="../style/dashboard-style.css">
  <link rel="stylesheet" href="../style/leaderboard_style.css">
  <link rel="stylesheet" href="../style/login_style.css">
  <link rel="icon" type="image/png" href="../image/home-log.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.23.0/ace.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.23.0/mode-javascript.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.23.0/mode-python.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.23.0/mode-java.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.23.0/theme-monokai.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
} else {
   
}
?>


  <header id="main-header">
    <div class="container">
      <div class="logo">
        <a href="index.php"><span>Bing Chilling</span></a>
      </div>
      <nav>
        <ul class="nav-links">
          <?php
          $current_page = basename($_SERVER['PHP_SELF']);
          $nav_items = [
            'index.php' => 'Home',
            'dashboard.php' => 'Dashboard',
            'gamification.php' => 'Learning',
            'challenges.php' => 'Challenges',
            'leaderboard.php' => 'Leaderboard'
          ];

          foreach ($nav_items as $page => $title) {
            $active_class = ($current_page == $page) ? 'active' : '';
            echo "<li><a href=\"$page\" class=\"$active_class\">$title</a></li>";
          }
          ?>
        </ul>
      </nav>
      <div class="auth-buttons">
      <div class="profile-icon" id="profile-icon">
        <a href="<?php echo isset($_SESSION['user_id']) ? 'profile.php' : 'login.php'; ?>">
          <i class="fas fa-user-circle"style="font-size:35px;"></i>
        </a>
      </div>
    </div>
      <!-- <div class="mobile-menu-btn">
      <i class="fa fa-phone" aria-hidden="true"></i>
      </div> -->
    </div>
  </header>