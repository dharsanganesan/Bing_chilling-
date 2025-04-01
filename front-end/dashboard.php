<?php include 'header.php'; ?>
<?php $username = $_SESSION['username'] ?? 'Student'; ?>
  <section class="page-header">
    <div class="container">
    <h1>Welcome Back, <span id="username"><?php echo htmlspecialchars($username); ?></span>!</h1>
      <p>Track your progress and continue your learning journey</p>
    </div>
  </section>

  <section class="dashboard">
    <div class="container">
      <div class="stats-grid">
        <div class="stat-card">
          <h3>Challenges Completed</h3>
          <div class="stat-value">26</div>
          <div class="stat-trend trend-up">
            <i class="fas fa-arrow-up"></i> 12% from last week
          </div>
        </div>
        <div class="stat-card">
          <h3>Current Streak</h3>
          <div class="stat-value">8 days</div>
          <div class="stat-trend trend-up">
            <i class="fas fa-arrow-up"></i> 3 days from last week
          </div>
        </div>
        <div class="stat-card">
          <h3>Points Earned</h3>
          <div class="stat-value">3,450</div>
          <div class="stat-trend trend-up">
            <i class="fas fa-arrow-up"></i> 550 new points
          </div>
        </div>
      </div>
      <section class="body-grid">
        <div class="header">33 submissions in the past one year</div>
        <div class="months">
            <span>Jan</span><span>Feb</span><span>Mar</span><span>Apr</span><span>May</span>
            <span>Jun</span><span>Jul</span><span>Aug</span><span>Sep</span><span>Oct</span>
            <span>Nov</span><span>Dec</span>
        </div>
        <div class="grid-container" id="activity-grid"></div>
        <div id="tooltip" class="tooltip"></div>
        <div class="stats">Total active days: 29 • Max streak: 28</div>
     </section>   
      <div class="dashboard-grid">
        <div class="main-content">
          <div class="recent-activity">
            <div class="section-title">
              <h2>Recent Activity</h2>
              <a href="#" class="btn btn-outline">View All</a>
            </div>
            <div class="activity-list">
              <div class="activity-item">
                <div class="activity-icon">
                  <i class="fas fa-trophy"></i>
                </div>
                <div class="activity-content">
                  <p>Completed <strong>Array Manipulation</strong> challenge</p>
                  <div class="activity-time">Today, 10:45 AM</div>
                </div>
              </div>
              <div class="activity-item">
                <div class="activity-icon">
                  <i class="fas fa-book"></i>
                </div>
                <div class="activity-content">
                  <p>Started <strong>Web Development Fundamentals</strong> path</p>
                  <div class="activity-time">Yesterday, 3:20 PM</div>
                </div>
              </div>
              <div class="activity-item">
                <div class="activity-icon">
                  <i class="fas fa-certificate"></i>
                </div>
                <div class="activity-content">
                  <p>Earned <strong>Problem Solver</strong> badge</p>
                  <div class="activity-time">2 days ago</div>
                </div>
              </div>
              <div class="activity-item">
                <div class="activity-icon">
                  <i class="fas fa-comment"></i>
                </div>
                <div class="activity-content">
                  <p>Commented on <strong>JavaScript Best Practices</strong> discussion</p>
                  <div class="activity-time">3 days ago</div>
                </div>
              </div>
            </div>
          </div>

          <div class="recommended-challenges">
            <div class="section-title">
              <h2>Recommended Challenges</h2>
              <a href="challenges.php" class="btn btn-outline">View All</a>
            </div>
            <div class="challenge-list">
              <div class="mini-challenge">
                <h3>String Manipulation Basics</h3>
                <div class="challenge-meta">
                  <span>Easy • 100 Points</span>
                  <span>15 mins</span>
                </div>
                <button class="btn btn-primary">Start Challenge</button>
              </div>
              <div class="mini-challenge">
                <h3>CSS Flexbox Layout</h3>
                <div class="challenge-meta">
                  <span>Medium • 150 Points</span>
                  <span>30 mins</span>
                </div>
                <button class="btn btn-primary">Start Challenge</button>
              </div>
              <div class="mini-challenge">
                <h3>Array Sorting Algorithms</h3>
                <div class="challenge-meta">
                  <span>Hard • 250 Points</span>
                  <span>45 mins</span>
                </div>
                <button class="btn btn-primary">Start Challenge</button>
              </div>
            </div>
          </div>
        </div>

        <div class="sidebar">
          <div class="skills-progress">
            <div class="section-title">
              <h2>Skills Progress</h2>
            </div>
            <div class="skill-list">
              <div class="skill-item">
                <div class="skill-info">
                  <div class="skill-name">Technical Skills</div>
                  <div class="skill-level">Intermediate</div>
                </div>
                <div class="progress-bar">
                  <div class="progress progress-technical" style="width: 65%"></div>
                </div>
              </div>
              <div class="skill-item">
                <div class="skill-info">
                  <div class="skill-name">Communication</div>
                  <div class="skill-level">Advanced Beginner</div>
                </div>
                <div class="progress-bar">
                  <div class="progress progress-communication" style="width: 45%"></div>
                </div>
              </div>
              <div class="skill-item">
                <div class="skill-info">
                  <div class="skill-name">Problem Solving</div>
                  <div class="skill-level">Proficient</div>
                </div>
                <div class="progress-bar">
                  <div class="progress progress-mindset" style="width: 78%"></div>
                </div>
              </div>
              <div class="skill-item">
                <div class="skill-info">
                  <div class="skill-name">JavaScript</div>
                  <div class="skill-level">Intermediate</div>
                </div>
                <div class="progress-bar">
                  <div class="progress progress-technical" style="width: 68%"></div>
                </div>
              </div>
              <div class="skill-item">
                <div class="skill-info">
                  <div class="skill-name">HTML/CSS</div>
                  <div class="skill-level">Advanced</div>
                </div>
                <div class="progress-bar">
                  <div class="progress progress-technical" style="width: 85%"></div>
                </div>
              </div>
            </div>
            <a href="learning.php" class="btn btn-outline" style="width: 100%; margin-top: 1rem;">View Learning Paths</a>
          </div>

          <div class="leaderboard-preview">
            <div class="section-title">
              <h2>Leaderboard</h2>
              <a href="leaderboard.php" class="btn btn-outline">View All</a>
            </div>
            <div class="leaderboard-list">
              <div class="leaderboard-item">
                <div class="leaderboard-rank">1</div>
                <div class="leaderboard-user">
                  <div class="user-avatar">
                    <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="User Avatar">
                  </div>
                  <div class="user-name">Sarah Johnson</div>
                </div>
                <div class="leaderboard-score">5,240</div>
              </div>
              <div class="leaderboard-item">
                <div class="leaderboard-rank">2</div>
                <div class="leaderboard-user">
                  <div class="user-avatar">
                    <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="User Avatar">
                  </div>
                  <div class="user-name">David Chen</div>
                </div>
                <div class="leaderboard-score">4,870</div>
              </div>
              <div class="leaderboard-item">
                <div class="leaderboard-rank">3</div>
                <div class="leaderboard-user">
                  <div class="user-avatar">
                    <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="User Avatar">
                  </div>
                  <div class="user-name">Maria Rodriguez</div>
                </div>
                <div class="leaderboard-score">4,620</div>
              </div>
              <div class="leaderboard-item">
                <div class="leaderboard-rank">4</div>
                <div class="leaderboard-user">
                  <div class="user-avatar">
                    <img src="https://randomuser.me/api/portraits/men/22.jpg" alt="User Avatar">
                  </div>
                  <div class="user-name">Michael Smith</div>
                </div>
                <div class="leaderboard-score">4,150</div>
              </div>
              <div class="leaderboard-item active-user">
                <div class="leaderboard-rank">8</div>
                <div class="leaderboard-user">
                  <div class="user-avatar">
                    <img src="https://randomuser.me/api/portraits/men/42.jpg" alt="Your Avatar">
                  </div>
                  <div class="user-name">You</div>
                </div>
                <div class="leaderboard-score">3,450</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php include 'footer.php'; ?>
  <script src="../script/script.js"></script>
<script src="../script/dashboard-script.js"></script>
</body>
</html>