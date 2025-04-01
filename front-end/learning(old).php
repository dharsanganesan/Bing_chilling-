<?php include 'header.php'; ?>
  <style>
    /* Path Card Styles */
    .path-card {
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
      padding: 0;
      margin-bottom: 20px;
      display: flex;
      overflow: hidden;
    }

    .path-image {
      width: 200px;
      background: #f5f5f5;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .path-image img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .path-content {
      flex: 1;
      padding: 20px;
    }

    .path-content h3 {
      margin-top: 0;
      color: #333;
    }

    .path-meta {
      display: flex;
      gap: 15px;
      margin: 10px 0;
      color: #666;
      font-size: 14px;
    }

    .path-progress {
      margin: 15px 0;
    }

    .progress-bar {
      height: 8px;
      background: #eee;
      border-radius: 4px;
      margin-bottom: 5px;
    }

    .progress {
      height: 100%;
      border-radius: 4px;
      background: #007bff;
    }

    .btn-primary {
      background: #007bff;
      color: white;
      border: none;
      padding: 10px 15px;
      border-radius: 4px;
      cursor: pointer;
      text-decoration: none;
      display: inline-block;
      text-align: center;
    }

    .btn-primary:hover {
      background: #0069d9;
    }

    .learning-tabs {
      display: flex;
      gap: 10px;
      margin-bottom: 20px;
    }

    .tab-btn {
      padding: 10px 20px;
      background: #f8f9fa;
      border: 1px solid #ddd;
      border-radius: 4px;
      cursor: pointer;
    }

    .tab-btn:hover {
      background: #e9ecef;
    }

    .tab-btn.active {
      background: #007bff;
      color: white;
      border-color: #007bff;
    }

    .tab-content {
      display: none;
    }

    .tab-content.active {
      display: block;
    }
  </style>
</head>
<body>
  <section class="page-header">
    <div class="container">
      <h1>Learning Paths</h1>
      <p>Personalized learning experiences designed for your growth</p>
    </div>
  </section>

  <section class="learning-paths">
    <div class="container">
      <div class="learning-tabs">
        <button class="tab-btn active" data-target="communication">Communication</button>
        <button class="tab-btn" data-target="mindset">Mindset & Attitude</button>
        <button class="tab-btn" data-target="technical">Technical Skills</button>
      </div>
      
      <div class="tab-content active" id="communication">
        <div class="path-cards">
          <div class="path-card">
            <div class="path-image">
              <img src="../image/verbal-1.jpeg" alt="Communication Skills">
            </div>
            <div class="path-content">
              <h3>Verbal / Non-Verbal</h3>
              <div class="path-meta">
                <span><i class="fas fa-clock"></i> 6 weeks</span>
                <span><i class="fas fa-signal"></i> Beginner</span>
                <span><i class="fas fa-certificate"></i> Certificate</span>
              </div>
              <p>Improve verbal and written communication skills to enhance professional and personal interactions.</p>
              <div class="path-progress">
                <div class="progress-bar">
                  <div class="progress" style="width: 0%"></div>
                </div>
                <span>Not started</span>
              </div>
              <a href="verbal_nonverbal.php" class="btn btn-primary">Start Learning</a>
            </div>
          </div>
        </div>
        <div class="path-cards">
          <div class="path-card">
            <div class="path-image">
              <img src="../image/body_1.jpeg" alt="Communication Skills">
            </div>
            <div class="path-content">
              <h3>Body Language and Eye Contact</h3>
              <div class="path-meta">
                <span><i class="fas fa-clock"></i> 6 weeks</span>
                <span><i class="fas fa-signal"></i> Beginner</span>
                <span><i class="fas fa-certificate"></i> Certificate</span>
              </div>
              <p>Master the art of body language and eye contact to improve your interpersonal communication.</p>
              <div class="path-progress">
                <div class="progress-bar">
                  <div class="progress" style="width: 0%"></div>
                </div>
                <span>Not started</span>
              </div>
              <a href="body_language.php" class="btn btn-primary">Start Learning</a>
            </div>
          </div>
        </div>
        <div class="path-cards">
          <div class="path-card">
            <div class="path-image">
              <img src="https://images.unsplash.com/photo-1584697964404-934ff96b8d5c" alt="Communication Skills">
            </div>
            <div class="path-content">
              <h3>Formal / Informal Communication</h3>
              <div class="path-meta">
                <span><i class="fas fa-clock"></i> 6 weeks</span>
                <span><i class="fas fa-signal"></i> Beginner</span>
                <span><i class="fas fa-certificate"></i> Certificate</span>
              </div>
              <p>Learn the differences between formal and informal communication and when to use each.</p>
              <div class="path-progress">
                <div class="progress-bar">
                  <div class="progress" style="width: 0%"></div>
                </div>
                <span>Not started</span>
              </div>
              <a href="formal_informal.php" class="btn btn-primary">Start Learning</a>
            </div>
          </div>
        </div>
        <div class="path-cards">
          <div class="path-card">
            <div class="path-image">
              <img src="https://images.unsplash.com/photo-1584697964404-934ff96b8d5c" alt="Communication Skills">
            </div>
            <div class="path-content">
              <h3>Practicing Mock Interview</h3>
              <div class="path-meta">
                <span><i class="fas fa-clock"></i> 6 weeks</span>
                <span><i class="fas fa-signal"></i> Beginner</span>
                <span><i class="fas fa-certificate"></i> Certificate</span>
              </div>
              <p>Prepare for job interviews with realistic mock interview practice sessions.</p>
              <div class="path-progress">
                <div class="progress-bar">
                  <div class="progress" style="width: 0%"></div>
                </div>
                <span>Not started</span>
              </div>
              <a href="mock_interview.php" class="btn btn-primary">Start Learning</a>
            </div>
          </div>
        </div>
      </div>

      <div class="tab-content" id="mindset">
        <div class="path-cards">
          <div class="path-card">
            <div class="path-image">
              <img src="https://images.unsplash.com/photo-1557426272-fc759fdf7a8d" alt="Aptitude Skills">
            </div>
            <div class="path-content">
              <h3>Aptitude Mastery</h3>
              <div class="path-meta">
                <span><i class="fas fa-clock"></i> 8 weeks</span>
                <span><i class="fas fa-signal"></i> Intermediate</span>
                <span><i class="fas fa-certificate"></i> Certificate</span>
              </div>
              <p>Enhance problem-solving and logical reasoning skills to excel in competitive exams and job assessments.</p>
              <div class="path-progress">
                <div class="progress-bar">
                  <div class="progress" style="width: 0%"></div>
                </div>
                <span>Not started</span>
              </div>
              <a href="aptitude_mastery.php" class="btn btn-primary">Start Learning</a>
            </div>
          </div>
        </div>
      </div>

      <div class="tab-content" id="technical">
        <div class="path-cards">
          <div class="path-card">
            <div class="path-image">
              <img src="https://images.unsplash.com/photo-1461749280684-dccba630e2f6" alt="Web Development">
            </div>
            <div class="path-content">
              <h3>Web Development Fundamentals</h3>
              <div class="path-meta">
                <span><i class="fas fa-clock"></i> 8 weeks</span>
                <span><i class="fas fa-signal"></i> Beginner</span>
                <span><i class="fas fa-certificate"></i> Certificate</span>
              </div>
              <p>Master the core technologies of the web: HTML, CSS, and JavaScript. Build responsive websites from scratch.</p>
              <div class="path-progress">
                <div class="progress-bar">
                  <div class="progress" style="width: 0%"></div>
                </div>
                <span>Not started</span>
              </div>
              <a href="web_development.php" class="btn btn-primary">Start Learning</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php include 'footer.php'; ?>

  <script>
    // Tab switching functionality
    document.querySelectorAll('.tab-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        // Remove active class from all buttons and content
        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
        document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
        
        // Add active class to clicked button
        btn.classList.add('active');
        
        // Show corresponding content
        const target = btn.getAttribute('data-target');
        document.getElementById(target).classList.add('active');
      });
    });
  </script>
</body>
</html>