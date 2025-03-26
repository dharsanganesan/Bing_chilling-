<?php include 'header.php'; ?>

  <section class="page-header">
    <div class="container">
      <h1>Leaderboard</h1>
      <p>See how you rank against other learners in the community</p>
    </div>
  </section>

  <section class="leaderboard-section">
    <div class="container">
      <div class="leaderboard-controls">
        <div class="leaderboard-tabs">
          <button class="tab-btn active" data-target="overall">Overall</button>
          <button class="tab-btn" data-target="technical">Technical</button>
          <button class="tab-btn" data-target="communication">Communication</button>
          <button class="tab-btn" data-target="mindset">Mindset</button>
        </div>
        <div class="leaderboard-period">
          <label for="period-select">Time Period:</label>
          <select id="period-select" class="period-select">
            <option value="all-time">All Time</option>
            <option value="monthly">This Month</option>
            <option value="weekly">This Week</option>
            <option value="daily">Today</option>
          </select>
        </div>
      </div>

      <div class="tab-content active" id="overall">
        <table class="leaderboard-table">
          <thead>
            <tr>
              <th style="width: 5%;">Rank</th>
              <th style="width: 30%;">Student</th>
              <th style="width: 15%;">Points</th>
              <th style="width: 15%;">Badges</th>
              <th style="width: 10%;">Challenges</th>
              <th class="progress-column">Skill Progress</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="rank rank-1">1</td>
              <td>
                <div class="user-profile">
                  <div class="avatar">
                    <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Avatar">
                  </div>
                  <div class="username">Sarah Johnson</div>
                </div>
              </td>
              <td class="score">5,240</td>
              <td>
                <div class="badges">
                  <i class="fas fa-medal badge-icon" title="Challenge Master"></i>
                  <i class="fas fa-crown badge-icon" title="Top Performer"></i>
                  <i class="fas fa-star badge-icon" title="Rising Star"></i>
                </div>
              </td>
              <td>87</td>
              <td class="progress-column">
                <div class="progress-row">
                  <div class="progress-label">Technical</div>
                  <div class="progress-bar">
                    <div class="progress progress-technical" style="width: 92%"></div>
                  </div>
                </div>
                <div class="progress-row">
                  <div class="progress-label">Communication</div>
                  <div class="progress-bar">
                    <div class="progress progress-communication" style="width: 85%"></div>
                  </div>
                </div>
                <div class="progress-row">
                  <div class="progress-label">Mindset</div>
                  <div class="progress-bar">
                    <div class="progress progress-mindset" style="width: 78%"></div>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td class="rank rank-2">2</td>
              <td>
                <div class="user-profile">
                  <div class="avatar">
                    <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="Avatar">
                  </div>
                  <div class="username">David Chen</div>
                </div>
              </td>
              <td class="score">4,870</td>
              <td>
                <div class="badges">
                  <i class="fas fa-medal badge-icon" title="Challenge Master"></i>
                  <i class="fas fa-award badge-icon" title="Problem Solver"></i>
                </div>
              </td>
              <td>76</td>
              <td class="progress-column">
                <div class="progress-row">
                  <div class="progress-label">Technical</div>
                  <div class="progress-bar">
                    <div class="progress progress-technical" style="width: 95%"></div>
                  </div>
                </div>
                <div class="progress-row">
                  <div class="progress-label">Communication</div>
                  <div class="progress-bar">
                    <div class="progress progress-communication" style="width: 70%"></div>
                  </div>
                </div>
                <div class="progress-row">
                  <div class="progress-label">Mindset</div>
                  <div class="progress-bar">
                    <div class="progress progress-mindset" style="width: 85%"></div>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td class="rank rank-3">3</td>
              <td>
                <div class="user-profile">
                  <div class="avatar">
                    <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Avatar">
                  </div>
                  <div class="username">Maria Rodriguez</div>
                </div>
              </td>
              <td class="score">4,620</td>
              <td>
                <div class="badges">
                  <i class="fas fa-award badge-icon" title="Problem Solver"></i>
                  <i class="fas fa-star badge-icon" title="Rising Star"></i>
                </div>
              </td>
              <td>72</td>
              <td class="progress-column">
                <div class="progress-row">
                  <div class="progress-label">Technical</div>
                  <div class="progress-bar">
                    <div class="progress progress-technical" style="width: 88%"></div>
                  </div>
                </div>
                <div class="progress-row">
                  <div class="progress-label">Communication</div>
                  <div class="progress-bar">
                    <div class="progress progress-communication" style="width: 92%"></div>
                  </div>
                </div>
                <div class="progress-row">
                  <div class="progress-label">Mindset</div>
                  <div class="progress-bar">
                    <div class="progress progress-mindset" style="width: 80%"></div>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td class="rank">4</td>
              <td>
                <div class="user-profile">
                  <div class="avatar">
                    <img src="https://randomuser.me/api/portraits/men/22.jpg" alt="Avatar">
                  </div>
                  <div class="username">Michael Smith</div>
                </div>
              </td>
              <td class="score">4,150</td>
              <td>
                <div class="badges">
                  <i class="fas fa-award badge-icon" title="Problem Solver"></i>
                </div>
              </td>
              <td>65</td>
              <td class="progress-column">
                <div class="progress-row">
                  <div class="progress-label">Technical</div>
                  <div class="progress-bar">
                    <div class="progress progress-technical" style="width: 82%"></div>
                  </div>
                </div>
                <div class="progress-row">
                  <div class="progress-label">Communication</div>
                  <div class="progress-bar">
                    <div class="progress progress-communication" style="width: 78%"></div>
                  </div>
                </div>
                <div class="progress-row">
                  <div class="progress-label">Mindset</div>
                  <div class="progress-bar">
                    <div class="progress progress-mindset" style="width: 85%"></div>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td class="rank">5</td>
              <td>
                <div class="user-profile">
                  <div class="avatar">
                    <img src="https://randomuser.me/api/portraits/women/23.jpg" alt="Avatar">
                  </div>
                  <div class="username">Jennifer Lee</div>
                </div>
              </td>
              <td class="score">3,980</td>
              <td>
                <div class="badges">
                  <i class="fas fa-star badge-icon" title="Rising Star"></i>
                </div>
              </td>
              <td>59</td>
              <td class="progress-column">
                <div class="progress-row">
                  <div class="progress-label">Technical</div>
                  <div class="progress-bar">
                    <div class="progress progress-technical" style="width: 75%"></div>
                  </div>
                </div>
                <div class="progress-row">
                  <div class="progress-label">Communication</div>
                  <div class="progress-bar">
                    <div class="progress progress-communication" style="width: 88%"></div>
                  </div>
                </div>
                <div class="progress-row">
                  <div class="progress-label">Mindset</div>
                  <div class="progress-bar">
                    <div class="progress progress-mindset" style="width: 90%"></div>
                  </div>
                </div>
              </td>
            </tr>
            <tr class="current-user-row">
              <td class="rank">8</td>
              <td>
                <div class="user-profile">
                  <div class="avatar">
                    <img src="https://randomuser.me/api/portraits/men/42.jpg" alt="Avatar">
                  </div>
                  <div class="username current-user">You</div>
                </div>
              </td>
              <td class="score">3,450</td>
              <td>
                <div class="badges">
                  <i class="fas fa-star badge-icon" title="Rising Star"></i>
                </div>
              </td>
              <td>42</td>
              <td class="progress-column">
                <div class="progress-row">
                  <div class="progress-label">Technical</div>
                  <div class="progress-bar">
                    <div class="progress progress-technical" style="width: 65%"></div>
                  </div>
                </div>
                <div class="progress-row">
                  <div class="progress-label">Communication</div>
                  <div class="progress-bar">
                    <div class="progress progress-communication" style="width: 45%"></div>
                  </div>
                </div>
                <div class="progress-row">
                  <div class="progress-label">Mindset</div>
                  <div class="progress-bar">
                    <div class="progress progress-mindset" style="width: 78%"></div>
                  </div>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="tab-content" id="technical">
        <table class="leaderboard-table">
          <thead>
            <tr>
              <th style="width: 5%;">Rank</th>
              <th style="width: 30%;">Student</th>
              <th style="width: 15%;">Points</th>
              <th style="width: 15%;">Badges</th>
              <th style="width: 10%;">Challenges</th>
              <th class="progress-column">Technical Skills</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="rank rank-1">1</td>
              <td>
                <div class="user-profile">
                  <div class="avatar">
                    <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="Avatar">
                  </div>
                  <div class="username">David Chen</div>
                </div>
              </td>
              <td class="score">2,850</td>
              <td>
                <div class="badges">
                  <i class="fas fa-medal badge-icon" title="Code Master"></i>
                  <i class="fas fa-laptop-code badge-icon" title="Tech Guru"></i>
                </div>
              </td>
              <td>45</td>
              <td class="progress-column">
                <div class="progress-row">
                  <div class="progress-label">JavaScript</div>
                  <div class="progress-bar">
                    <div class="progress progress-technical" style="width: 98%"></div>
                  </div>
                </div>
                <div class="progress-row">
                  <div class="progress-label">Python</div>
                  <div class="progress-bar">
                    <div class="progress progress-technical" style="width: 92%"></div>
                  </div>
                </div>
                <div class="progress-row">
                  <div class="progress-label">Web Dev</div>
                  <div class="progress-bar">
                    <div class="progress progress-technical" style="width: 95%"></div>
                  </div>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="tab-content" id="communication">
        <table class="leaderboard-table">
          <thead>
            <tr>
              <th style="width: 5%;">Rank</th>
              <th style="width: 30%;">Student</th>
              <th style="width: 15%;">Points</th>
              <th style="width: 15%;">Badges</th>
              <th style="width: 10%;">Challenges</th>
              <th class="progress-column">Communication Skills</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>

      <div class="tab-content" id="mindset">
        <table class="leaderboard-table">
          <thead>
            <tr>
              <th style="width: 5%;">Rank</th>
              <th style="width: 30%;">Student</th>
              <th style="width: 15%;">Points</th>
              <th style="width: 15%;">Badges</th>
              <th style="width: 10%;">Challenges</th>
              <th class="progress-column">Mindset & Attitude</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </section>
  <?php include 'footer.php'; ?>

  <script src="../script/script.js"></script>
  <script src="../script/dashboard-script.js"></script>
</body>
</html>