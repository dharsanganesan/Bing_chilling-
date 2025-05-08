<?php include('header.php'); ?>
<?php

  $gameTitle = "Play & Learn !";
  $gameText = "Boost your brain power with fun, interactive games. Every level brings new challenges and rewards!";
  $gameImg = "../image/communication.gif";

 
  $quizTitle = "Quiz Yourself !";
  $quizText = "Test your knowledge with quick quizzes. Improve your accuracy and climb the leaderboard!";
  $quizImg = "../image/mind_game_main.gif";
?>
<?php
if (isset($_SESSION['user_id'])) {
    $button_link = "learning.php";  
} else {
    $button_link = "login.php"; 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Professional Skills Development Platform</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="../style/gmaification.css" rel="stylesheet">
  <style>
    :root {
      --primary-color: #3498db;
      --secondary-color: #2c3e50;
      --accent-color: #e74c3c;
      --light-bg: #f8f9fa;
      --dark-text: #2c3e50;
      --light-text: #7f8c8d;
    }
    
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      color: var(--dark-text);
      line-height: 1.6;
    }
    
    .hero-section {
      background: linear-gradient(135deg, var(--light-bg) 0%, #ffffff 100%);
      padding: 4rem 0;
      border-bottom: 1px solid rgba(0,0,0,0.05);
    }
    
    .hero-content h1 {
      font-weight: 700;
      font-size: 2.5rem;
      margin-bottom: 1.5rem;
      color: var(--secondary-color);
    }
    
    .hero-content p {
      font-size: 1.2rem;
      color: var(--light-text);
      margin-bottom: 2rem;
    }
    
    .hero-buttons .btn {
      padding: 0.75rem 1.5rem;
      margin-right: 1rem;
      border-radius: 50px;
      font-weight: 500;
    }
    
    .btn-primary {
      background-color: var(--primary-color);
      border-color: var(--primary-color);
    }
    
    .btn-outline {
      border: 2px solid var(--primary-color);
      color: var(--primary-color);
    }
    
    .btn-outline:hover {
      background-color: var(--primary-color);
      color: white;
    }
    
    .feature-card {
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 10px 30px rgba(0,0,0,0.05);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      margin-bottom: 2rem;
      border: none;
    }
    
    .feature-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    }
    
    .gif-container {
      height: 100%;
      overflow: hidden;
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: #f5f7fa;
    }
    
  .gif-container img {
    max-width: 100%;
    height: 90% !important;
    object-fit: contain;
    border-radius: 8px 0 0 8px;
}
.text-gradient-primary {
  background: linear-gradient(90deg, #3a7bd5 0%, #00d2ff 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent;
  display: inline-block;
}

/* Font classes */
.font-playfair {
  font-family: 'Playfair Display', serif;
}

.font-open-sans {
  font-family: 'Open Sans', sans-serif;
}

/* Hover animation */
.hover-grow {
  transition: all 0.3s ease;
}
.hover-grow:hover {
  transform: translateY(-2px);
  box-shadow: 0 7px 14px rgba(0,0,0,0.1);
}

/* Image container */
.gif-container {
  transition: transform 0.5s ease;
}
.gif-container:hover {
  transform: scale(1.02);
}
    .card-body {
      padding: 3rem;
    }
    
    .card-text {
      color: var(--light-text);
      font-size: 1.1rem;
    }
    
    .section-title {
      font-weight: 700;
      color: var(--secondary-color);
      margin-bottom: 1.5rem;
      position: relative;
      display: inline-block;
    }
    
    .section-title:after {
      content: '';
      position: absolute;
      width: 50%;
      height: 3px;
      background: var(--primary-color);
      bottom: -10px;
      left: 0;
    }
    
    @media (max-width: 768px) {
      .gif-container img {
        border-radius: 8px 8px 0 0;
      }
      
      .card-body {
        padding: 2rem;
      }
      
      .hero-content h1 {
        font-size: 2rem;
      }
    }
  </style>
</head>

<body class="bg-light"> 
  <section class="hero-section">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 order-lg-1 order-2">
          <div class="hero-content pe-lg-5">
            <h1>Enhance Your Technical Skills, Communication & Mindset</h1>
            <p>Join thousands of students on their journey to professional excellence through personalized learning paths, challenges, and community collaboration.</p>
            <div class="hero-buttons">
              <a href="<?php echo $button_link; ?>" class="btn btn-primary btn-lg">
                <i class="fas fa-rocket me-2"></i>Get Started
              </a>
              <a href="#features" class="btn btn-outline btn-lg">
                <i class="fas fa-info-circle me-2"></i>Learn More
              </a>
            </div>
          </div>
        </div>
        <div class="col-lg-6 order-lg-2 order-1 mb-4 mb-lg-0">
          <div class="gif-container">
            <img src="../image/game_world.gif" alt="Interactive learning experience" class="img-fluid shadow-sm">
          </div>
        </div>
      </div>
    </div>
  </section>


  <section id="features" class="py-5">
    <div class="container">
      <h2 class="text-center section-title mb-5">Discover Our Platform</h2>
      
      <div class="card feature-card mb-5">
  <div class="row g-0">
    <div class="col-md-6">
      <div class="card-body">
        <h3 class="card-title mb-4 fw-bold font-playfair display-6 text-gradient-primary">
          <?php echo $gameTitle; ?>
        </h3>
        <p class="card-text font-open-sans fs-5 lh-base text-muted">
          <?php echo $gameText; ?>
        </p>
        <a href="#" class="btn btn-primary mt-3 px-4 py-2 rounded-pill shadow-sm hover-grow">
          <i class="fas fa-gamepad me-2"></i>Level Up Hub
        </a>
      </div>
    </div>
    <div class="col-md-6 d-flex align-items-center">
      <div class="gif-container rounded-4 overflow-hidden shadow-lg">
        <img src="<?php echo $gameImg; ?>" alt="Platform features" class="img-fluid h-100 w-100 object-fit-cover">
      </div>
    </div>
  </div>
</div>
<div class="card feature-card mb-5">
  <div class="row g-0">
    <div class="col-md-6">
    <div class="gif-container rounded-4 overflow-hidden shadow-lg">
        <img src="<?php echo $quizImg; ?>" alt="Platform features" class="img-fluid h-100 w-100 object-fit-cover">
      </div>

    </div>
    <div class="col-md-6 d-flex align-items-center">
    <div class="card-body">
        <h3 class="card-title mb-4 fw-bold font-playfair display-6 text-gradient-primary">
          <?php echo $quizTitle; ?>
        </h3>
        
        <p class="card-text font-open-sans fs-5 lh-base text-muted">
          <?php echo $quizText; ?>
        </p>

        <a href="game_category.php" class="btn btn-primary mt-3 px-4 py-2 rounded-pill shadow-sm hover-grow">
          <i class="fas fa-brain me-2"></i>Mind Sprint
        </a>
      </div>
    </div>
  </div>
</div>
<section class="container py-5">
  <h2 class="text-center section-title mb-5 display-4 fw-bold">About Game & Quizee</h2>
  
  <div class="row g-4">
    <!-- Level Up Hub Card -->
    <div class="col-lg-6">
      <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">
        <div class="card-body p-4">
          <h2 class="card-title mb-3 fw-bold font-playfair display-5 text-gradient-primary">Level Up Hub</h2>
          <h3 class="h4 text-muted mb-4">Fuel your skills with fun-packed challenges that entertain and educate.</h3>
          
          <div class="d-flex mb-3">
            <div class="me-3">
              <img src="https://cdn-icons-png.flaticon.com/512/1828/1828884.png" width="24" alt="checkmark">
            </div>
            <p class="mb-0 fs-5">
              Ready to turn learning into a thrilling experience? Dive into our interactive games designed to sharpen your logic, boost your focus, and level up your thinking—while having a blast!
            </p>
          </div>
          
          <ul class="list-unstyled row g-3">
            <li class="col-md-6 d-flex align-items-start">
              <span class="badge bg-primary-soft rounded-pill me-2 p-2">✅</span>
              <span class="fs-5">Unlock levels</span>
            </li>
            <li class="col-md-6 d-flex align-items-start">
              <span class="badge bg-primary-soft rounded-pill me-2 p-2">🎯</span>
              <span class="fs-5">Boost problem-solving</span>
            </li>
            <li class="col-md-6 d-flex align-items-start">
              <span class="badge bg-primary-soft rounded-pill me-2 p-2">🧩</span>
              <span class="fs-5">Train with puzzles</span>
            </li>
            <li class="col-md-6 d-flex align-items-start">
              <span class="badge bg-primary-soft rounded-pill me-2 p-2">🏆</span>
              <span class="fs-5">Compete on leaderboard</span>
            </li>
          </ul>
        </div>
      </div>
    </div>
    
    <!-- Trivia Trials Card -->
    <div class="col-lg-6">
      <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">
        <div class="card-body p-4">
          <h2 class="card-title mb-3 fw-bold font-playfair display-5 text-gradient-primary">Trivia Trials</h2>
          <h3 class="h4 text-muted mb-4">Quick quizzes to challenge your knowledge and earn rewards.</h3>
          
          <div class="d-flex mb-3">
            <div class="me-3">
              <img src="https://cdn-icons-png.flaticon.com/512/1828/1828884.png" width="24" alt="checkmark">
            </div>
            <p class="mb-0 fs-5">
              Think you've got what it takes to top the leaderboard? Our quiz arena is loaded with fast-paced, skill-based questions to test your brainpower.
            </p>
          </div>
          
          <ul class="list-unstyled row g-3">
            <li class="col-md-6 d-flex align-items-start">
              <span class="badge bg-success-soft rounded-pill me-2 p-2">🎓</span>
              <span class="fs-5">Reinforce knowledge</span>
            </li>
            <li class="col-md-6 d-flex align-items-start">
              <span class="badge bg-success-soft rounded-pill me-2 p-2">⚡</span>
              <span class="fs-5">Timed rounds</span>
            </li>
            <li class="col-md-6 d-flex align-items-start">
              <span class="badge bg-success-soft rounded-pill me-2 p-2">📈</span>
              <span class="fs-5">Instant feedback</span>
            </li>
            <li class="col-md-6 d-flex align-items-start">
              <span class="badge bg-success-soft rounded-pill me-2 p-2">🥇</span>
              <span class="fs-5">Earn badges</span>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
          behavior: 'smooth'
        });
      });
    });
  </script>
</body>
</html>
<?php include('footer.php'); ?>