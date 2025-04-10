<?php include 'header.php'; ?>
<?php $username = $_SESSION['username'] ?? 'Student'; ?>
<?php
// Sample data - replace with your actual submission data
$submissions = [
    '2023-04-05' => 8,
    '2023-05-10' => 8,
    '2023-06-15' => 7,
    '2023-07-20' => 9,
    '2023-08-25' => 8,
    '2023-09-30' => 8,
    '2023-12-15' => 8,
    '2024-01-10' => 7,
    '2024-02-15' => 9,
    '2024-03-20' => 8,
    '2025-04-05' => 7,
    '2024-05-10' => 8,
    '2025-06-15' => 6,
    '2024-07-20' => 7,
    '2024-08-25' => 8,
    '2025-09-30' => 8,
    '2025-12-15' => 7,
    '2025-01-10' => 6,
    '2025-02-15' => 8,
    '2025-03-20' => 6,
];

// Get current month and year or use defaults
$currentMonth = isset($_GET['month']) ? (int)$_GET['month'] : date('n');
$currentYear = isset($_GET['year']) ? (int)$_GET['year'] : date('Y');

// Calculate stats for the selected month
function calculateMonthStats($month, $year, $submissions) {
    $activeDays = 0;
    $monthStart = new DateTime("$year-$month-01");
    $monthEnd = clone $monthStart;
    $monthEnd->modify('last day of this month');
    
    foreach ($submissions as $date => $count) {
        $subDate = new DateTime($date);
        if ($subDate >= $monthStart && $subDate <= $monthEnd) {
            $activeDays++;
        }
    }
    
    return [
        'activeDays' => $activeDays,
        'totalContributions' => array_sum($submissions)
    ];
}

$monthStats = calculateMonthStats($currentMonth, $currentYear, $submissions);

function generateCalendar($month, $year, $submissions) {
    $firstDay = new DateTime("$year-$month-01");
    $daysInMonth = $firstDay->format('t');
    $startingDay = $firstDay->format('w'); // 0 (Sunday) through 6 (Saturday)
    $monthName = $firstDay->format('F');
    
    $calendar = '<div class="calendar-grid">';
    
    // Day names header
    $dayNames = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
    foreach ($dayNames as $day) {
        $calendar .= '<div class="day-header">' . $day . '</div>';
    }
    
    // Empty cells for days before the 1st
    for ($i = 0; $i < $startingDay; $i++) {
        $calendar .= '<div class="day-empty"></div>';
    }
    
    // Days of the month
    for ($day = 1; $day <= $daysInMonth; $day++) {
        $date = sprintf('%04d-%02d-%02d', $year, $month, $day);
        $dateKey = date('Y-m-d', strtotime($date));
        $hasSubmission = isset($submissions[$dateKey]);
        
        $intensity = $hasSubmission ? min(9, $submissions[$dateKey]) : 0;
        
        if ($hasSubmission) {
            $formattedDate = date('M j, Y', strtotime($date));
            $contributionText = $submissions[$dateKey] == 1 ? '1 contribution' : $submissions[$dateKey] . ' contributions';
            $tooltip = '<div class="tooltip-date">' . $formattedDate . '</div><div class="tooltip-contrib">' . $contributionText . '</div>';
            $calendar .= '<div class="day intensity-' . $intensity . '" data-tooltip="' . htmlspecialchars($tooltip) . '">' . $day . '</div>';
        } else {
            $calendar .= '<div class="day">' . $day . '</div>';
        }
    }
    
    // Empty cells after last day to complete the grid
    $remainingCells = (7 - (($daysInMonth + $startingDay) % 7)) % 7;
    for ($i = 0; $i < $remainingCells; $i++) {
        $calendar .= '<div class="day-empty"></div>';
    }
    
    $calendar .= '</div>'; // Close calendar-grid
    
    return [
        'calendar' => $calendar,
        'monthName' => $monthName,
        'year' => $year
    ];
}

$calendarData = generateCalendar($currentMonth, $currentYear, $submissions);
?>

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
        <div class="header"><?php echo count($submissions); ?> submissions in the past year</div>
        
        <div class="controls">
            <select id="month-select">
                <?php
                $months = [
                    1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April',
                    5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August',
                    9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
                ];
                
                foreach ($months as $num => $name) {
                    $selected = $num == $currentMonth ? 'selected' : '';
                    echo "<option value='$num' $selected>$name</option>";
                }
                ?>
            </select>
            
            <select id="year-select">
                <?php
                $currentYear = date('Y');
                for ($year = $currentYear - 2; $year <= $currentYear + 2; $year++) {
                    $selected = $year == $currentYear ? 'selected' : '';
                    echo "<option value='$year' $selected>$year</option>";
                }
                ?>
            </select>
        </div>
        
        <div class="calendar-container">
            <div class="calendar-title"><?php echo $calendarData['monthName'] . ' ' . $calendarData['year']; ?></div>
            <?php echo $calendarData['calendar']; ?>
        </div>
        
        <div class="stats">
            Active days in <?php echo $calendarData['monthName']; ?>: <?php echo $monthStats['activeDays']; ?> • 
            Total contributions: <?php echo $monthStats['totalContributions']; ?>
        </div>
        </div>
        <div class="control_left">
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
              <a href="challenges.html" class="btn btn-outline">View All</a>
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
            <a href="learning.html" class="btn btn-outline" style="width: 100%; margin-top: 1rem;">View Learning Paths</a>
          </div>

          <div class="leaderboard-preview">
            <div class="section-title">
              <h2>Leaderboard</h2>
              <a href="leaderboard.html" class="btn btn-outline">View All</a>
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
<style>
  .dashboard-grid {
      display: grid;
      grid-template-columns: 3fr 1fr;
      gap: 2rem;
    }

    .stats-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 1.5rem;
      margin-bottom: 2rem;
    }
    
    .stat-card {
      background-color: var(--bg-color);
      border-radius: var(--radius-lg);
      padding: 1.5rem;
      box-shadow: var(--shadow-md);
      display: flex;
      flex-direction: column;
    }
    
    .stat-card h3 {
      font-size: 1rem;
      color: var(--text-muted);
      margin-bottom: 0.5rem;
    }
    
    .stat-value {
      font-size: 2rem;
      font-weight: 700;
      margin-bottom: 0.5rem;
    }
    
    .stat-trend {
      display: flex;
      align-items: center;
      font-size: 0.875rem;
    }
    
    .trend-up {
      color: var(--success-color);
    }
    
    .trend-down {
      color: var(--error-color);
    }
    
    .recent-activity, .recommended-challenges, .leaderboard-preview, .skills-progress {
      background-color: var(--bg-color);
      border-radius: var(--radius-lg);
      padding: 1.5rem;
      box-shadow: var(--shadow-md);
      margin-bottom: 2rem;
    }
    
    .section-title {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 1.5rem;
    }
    
    .section-title h2 {
      font-size: 1.25rem;
      margin: 0;
    }
    
    .activity-item {
      padding: 1rem 0;
      border-bottom: 1px solid var(--border-color);
      display: flex;
      align-items: center;
    }
    
    .activity-item:last-child {
      border-bottom: none;
    }
    
    .activity-icon {
      width: 2.5rem;
      height: 2.5rem;
      border-radius: 50%;
      background-color: rgba(139, 92, 246, 0.1);
      display: flex;
      align-items: center;
      justify-content: center;
      margin-right: 1rem;
      color: var(--primary-color);
    }
    
    .activity-content {
      flex: 1;
    }
    
    .activity-time {
      font-size: 0.75rem;
      color: var(--text-muted);
    }
    
    .skill-item {
      margin-bottom: 1.5rem;
    }
    
    .skill-info {
      display: flex;
      justify-content: space-between;
      margin-bottom: 0.5rem;
    }
    
    .skill-name {
      font-weight: 500;
    }
    
    .skill-level {
      color: var(--text-muted);
      font-size: 0.875rem;
    }
    
    .progress-bar {
      height: 0.5rem;
      background-color: var(--bg-accent);
      border-radius: var(--radius-sm);
      overflow: hidden;
    }
    
    .progress {
      height: 100%;
      border-radius: var(--radius-sm);
    }
    
    .progress-technical {
      background-color: var(--primary-color);
    }
    
    .progress-communication {
      background-color: var(--secondary-color);
    }
    
    .progress-mindset {
      background-color: var(--accent-color);
    }
    
    .mini-challenge {
      background-color: var(--bg-secondary);
      border-radius: var(--radius-md);
      padding: 1rem;
      margin-bottom: 1rem;
      transition: transform 0.3s, box-shadow 0.3s;
    }
    
    .mini-challenge:hover {
      transform: translateY(-3px);
      box-shadow: var(--shadow-md);
    }
    
    .mini-challenge h3 {
      font-size: 1rem;
      margin-bottom: 0.5rem;
    }
    
    .challenge-meta {
      display: flex;
      justify-content: space-between;
      font-size: 0.75rem;
      color: var(--text-muted);
      margin-bottom: 1rem;
    }
    
    .leaderboard-item {
      display: flex;
      align-items: center;
      padding: 0.75rem 0;
      border-bottom: 1px solid var(--border-color);
    }
    
    .leaderboard-item:last-child {
      border-bottom: none;
    }
    
    .leaderboard-rank {
      width: 2rem;
      font-weight: 700;
      text-align: center;
    }
    
    .leaderboard-user {
      flex: 1;
      display: flex;
      align-items: center;
    }
    
    .user-avatar {
      width: 2rem;
      height: 2rem;
      border-radius: 50%;
      background-color: var(--bg-accent);
      margin-right: 0.75rem;
      overflow: hidden;
    }
    
    .user-avatar img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    
    .leaderboard-score {
      font-weight: 600;
      color: var(--primary-color);
    }
    
    .body-grid {
            max-width: 800px;
            margin: 0 auto;
        }
        .header {
            font-size: 16px;
            margin-bottom: 15px;
        }
        .controls {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
            align-items: center;
        }
        select {
            padding: 8px 12px;
            border-radius: 6px;
            border: 1px solid #ddd;
            font-size: 14px;
        }
        .calendar-container {
            margin-top: 20px;
        }
        .calendar-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
            text-align: center;
        }
        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 5px;
        }
        .day-header {
            text-align: center;
            font-weight: bold;
            font-size: 12px;
            color: #586069;
            padding: 5px;
        }
        .day {
            text-align: center;
            padding: 8px;
            border-radius: 3px;
            background-color: #ebedf0;
            position: relative;
        }
        .day-empty {
            visibility: hidden;
        }
        /* Intensity levels - light to dark gradient */
        .intensity-1 { background-color: #f0fff4; }
        .intensity-2 { background-color: #dcffe4; }
        .intensity-3 { background-color: #bef5cb; }
        .intensity-4 { background-color: #85e89d; }
        .intensity-5 { background-color: #34d058; }
        .intensity-6 { background-color: #28a745; }
        .intensity-7 { background-color: #22863a; }
        .intensity-8 { background-color: #176f2c; }
        .intensity-9 { background-color: #165c26; }
        
        .tooltip {
            position: absolute;
            z-index: 100;
            padding: 8px 12px;
            background: #24292e;
            color: white;
            border-radius: 6px;
            font-size: 12px;
            pointer-events: none;
            white-space: nowrap;
            transform: translate(-50%, -120%);
            opacity: 0;
            transition: opacity 0.2s;
        }
        .tooltip-date {
            font-weight: bold;
            margin-bottom: 4px;
        }
        .tooltip-contrib {
            color: #dbedff;
        }
        .day:hover .tooltip {
            opacity: 1;
        }
        .stats {
            margin-top: 20px;
            font-size: 14px;
            color: #586069;
            text-align: center;
        }
        .control_left{
          margin-left: 45px;
          margin-right: 45px;
        }
    @media (max-width: 1024px) {
      .stats-grid {
        grid-template-columns: repeat(2, 1fr);
      }
    }
    
    @media (max-width: 768px) {
      .dashboard-grid {
        grid-template-columns: 1fr;
      }
    }
    
    @media (max-width: 640px) {
      .stats-grid {
        grid-template-columns: 1fr;
      }
    }
</style>
<script>
            // Add tooltips to the DOM
            document.querySelectorAll('.day[data-tooltip]').forEach(day => {
                const tooltipContent = day.getAttribute('data-tooltip');
                const tooltip = document.createElement('div');
                tooltip.className = 'tooltip';
                tooltip.innerHTML = tooltipContent;
                day.appendChild(tooltip);
            });
            
            // Handle dropdown changes
            document.getElementById('month-select').addEventListener('change', updateCalendar);
            document.getElementById('year-select').addEventListener('change', updateCalendar);
            
            function updateCalendar() {
                const month = document.getElementById('month-select').value;
                const year = document.getElementById('year-select').value;
                
                // Update URL without reloading (for demo purposes)
                const queryString = `?month=${month}&year=${year}`;
                window.history.pushState(null, '', queryString);
                
                // In a real application, you would fetch new data here
                // For this demo, we'll just reload with the new parameters
                window.location.search = queryString;
            }
        </script>
</html>