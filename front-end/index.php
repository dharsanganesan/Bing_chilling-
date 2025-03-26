<?php 
include 'header.php';
?>
<?php


if (isset($_SESSION['user_id'])) {
    $button_link = "learning.php";  
} else {
    $button_link = "login.php"; 
}
?>
 <section class="hero">
    <div class="container">
        <div class="hero-content">
            <h1>Enhance Your Technical Skills, Communication & Mindset</h1>
            <p>Join thousands of students on their journey to professional excellence through personalized learning paths, challenges, and community collaboration.</p>
            <div class="hero-buttons">
                <a href="<?php echo $button_link; ?>" class="btn btn-primary btn-lg">Get Started</a>
                <a href="#features" class="btn btn-outline btn-lg">Learn More</a>
            </div>
        </div>
        <div>
            <img src="../image/home-page.png" alt="Student learning online">
        </div>
    </div>
</section>
  <section id="features" class="features">
    <div class="container">
      <div class="section-header">
        <h2>Unlock Your Potential</h2>
        <p>Our platform offers everything you need to enhance your skills and advance your career</p>
      </div>
      <div class="feature-cards">
        <div class="feature-card">
          <div class="feature-icon">
            <i class="fas fa-road"></i>
          </div>
          <h3>Personalized Learning</h3>
          <p>Custom learning paths tailored to your skills, goals, and learning style.</p>
        </div>
        <div class="feature-card">
          <div class="feature-icon">
            <i class="fas fa-trophy"></i>
          </div>
          <h3>Daily Challenges</h3>
          <p>Practice with fun, engaging challenges that reinforce key concepts.</p>
        </div>
        <div class="feature-card">
          <div class="feature-icon">
            <i class="fas fa-medal"></i>
          </div>
          <h3>Skill Assessment</h3>
          <p>Track your progress with comprehensive assessments and detailed feedback.</p>
        </div>
        <div class="feature-card">
          <div class="feature-icon">
            <i class="fas fa-users"></i>
          </div>
          <h3>Community Learning</h3>
          <p>Connect with peers, share knowledge, and collaborate on projects.</p>
        </div>
        <div class="feature-card">
          <div class="feature-icon">
            <i class="fas fa-certificate"></i>
          </div>
          <h3>Earn Certificates</h3>
          <p>Showcase your achievements with shareable certificates and badges.</p>
        </div>
        <div class="feature-card">
          <div class="feature-icon">
            <i class="fas fa-robot"></i>
          </div>
          <h3>AI Assistance</h3>
          <p>Get instant help and guidance from our intelligent learning assistant.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="cta">
    <div class="container">
      <div class="cta-content">
        <h2>Ready to start your learning journey?</h2>
        <p>Join thousands of students already enhancing their skills on LearnVerse.</p>
        <div class="hero-buttons" style="margin-left:35%;">
                <a href="<?php echo $button_link; ?>" class="btn btn-primary btn-lg">Get Started Now</a>
            </div>
      </div>
    </div>
  </section>

  <?php include 'footer.php'; ?>
  <script src="../script/script.js"></script>
</body>
</html>
