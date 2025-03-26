<?php include 'header.php'; ?>
<section class="page-header">
    <div class="container">
      <h1>Challenges</h1>
      <p>Test your skills with our curated challenges and coding problems</p>
    </div>
  </section>

  <section class="challenges-section">
    <div class="container">
      <div class="challenge-filters">
        <div class="filter-group">
          <label for="category-filter">Category:</label>
          <select id="category-filter">
            <option value="all">All Categories</option>
            <option value="algorithms">Algorithms</option>
            <option value="data-structures">Data Structures</option>
            <option value="web-dev">Web Development</option>
            <option value="databases">Databases</option>
            <option value="system-design">System Design</option>
          </select>
        </div>
        <div class="filter-group">
          <label for="difficulty-filter">Difficulty:</label>
          <select id="difficulty-filter">
            <option value="all">All Levels</option>
            <option value="easy">Easy</option>
            <option value="medium">Medium</option>
            <option value="hard">Hard</option>
          </select>
        </div>
        <div class="filter-group search">
          <input type="text" id="search-challenges" placeholder="Search challenges...">
          <button><i class="fas fa-search"></i></button>
        </div>
      </div>

      <div class="challenges-list">
        <div class="challenge-card" data-category="algorithms" data-difficulty="easy">
          <div class="challenge-header">
            <div class="challenge-badges">
              <span class="badge badge-difficulty badge-easy">Easy</span>
              <span class="badge badge-points">100 Points</span>
            </div>
            <h3>Array Sum Finder</h3>
            <p class="challenge-category">Algorithms</p>
          </div>
          <div class="challenge-body">
            <p>Find two numbers in an array that add up to a target sum.</p>
            <div class="challenge-meta">
              <span><i class="fas fa-clock"></i> 30 mins</span>
              <span><i class="fas fa-code"></i> JavaScript, Python</span>
            </div>
          </div>
          <div class="challenge-footer">
            <button class="btn btn-primary open-challenge" data-id="1">Start Challenge</button>
          </div>
        </div>

        <div class="challenge-card" data-category="data-structures" data-difficulty="medium">
          <div class="challenge-header">
            <div class="challenge-badges">
              <span class="badge badge-difficulty badge-medium">Medium</span>
              <span class="badge badge-points">200 Points</span>
            </div>
            <h3>Binary Tree Traversal</h3>
            <p class="challenge-category">Data Structures</p>
          </div>
          <div class="challenge-body">
            <p>Implement pre-order, in-order, and post-order traversal for a binary tree.</p>
            <div class="challenge-meta">
              <span><i class="fas fa-clock"></i> 45 mins</span>
              <span><i class="fas fa-code"></i> Java, Python</span>
            </div>
          </div>
          <div class="challenge-footer">
            <button class="btn btn-primary open-challenge" data-id="2">Start Challenge</button>
          </div>
        </div>

        <div class="challenge-card" data-category="web-dev" data-difficulty="medium">
          <div class="challenge-header">
            <div class="challenge-badges">
              <span class="badge badge-difficulty badge-medium">Medium</span>
              <span class="badge badge-points">150 Points</span>
            </div>
            <h3>Responsive Grid Layout</h3>
            <p class="challenge-category">Web Development</p>
          </div>
          <div class="challenge-body">
            <p>Create a responsive grid layout that adapts to different screen sizes using CSS Grid.</p>
            <div class="challenge-meta">
              <span><i class="fas fa-clock"></i> 40 mins</span>
              <span><i class="fas fa-code"></i> HTML, CSS</span>
            </div>
          </div>
          <div class="challenge-footer">
            <button class="btn btn-primary open-challenge" data-id="3">Start Challenge</button>
          </div>
        </div>

        <div class="challenge-card" data-category="algorithms" data-difficulty="hard">
          <div class="challenge-header">
            <div class="challenge-badges">
              <span class="badge badge-difficulty badge-hard">Hard</span>
              <span class="badge badge-points">300 Points</span>
            </div>
            <h3>Dynamic Programming Challenge</h3>
            <p class="challenge-category">Algorithms</p>
          </div>
          <div class="challenge-body">
            <p>Solve the knapsack problem using dynamic programming approach.</p>
            <div class="challenge-meta">
              <span><i class="fas fa-clock"></i> 60 mins</span>
              <span><i class="fas fa-code"></i> JavaScript, Python, Java</span>
            </div>
          </div>
          <div class="challenge-footer">
            <button class="btn btn-primary open-challenge" data-id="4">Start Challenge</button>
          </div>
        </div>
      </div>

      <div class="todays-challenges"style="margin-bottom:45px;">
        <div class="logo">
          <span>Today's Challenge</span>
        </div>
        <div class="challenges-list">
          <div class="challenge-card" data-category="algorithms" data-difficulty="easy">
            <div class="challenge-header">
              <div class="challenge-badges">
                <span class="badge badge-difficulty badge-easy">Easy</span>
                <span class="badge badge-points">100 Points</span>
              </div>
              <h3>Palindrome Checker</h3>
              <p class="challenge-category">Algorithms</p>
            </div>
            <div class="challenge-body">
              <p>Check if a given string is a palindrome.</p>
              <div class="challenge-meta">
                <span><i class="fas fa-clock"></i> 20 mins</span>
                <span><i class="fas fa-code"></i> JavaScript, Python</span>
              </div>
            </div>
            <div class="challenge-footer">
              <button class="btn btn-primary open-challenge" data-id="5">Start Challenge</button>
            </div>
          </div>

          <div class="challenge-card" data-category="web-dev" data-difficulty="medium">
            <div class="challenge-header">
              <div class="challenge-badges">
                <span class="badge badge-difficulty badge-medium">Medium</span>
                <span class="badge badge-points">150 Points</span>
              </div>
              <h3>API Integration</h3>
              <p class="challenge-category">Web Development</p>
            </div>
            <div class="challenge-body">
              <p>Integrate a public API and display data on a webpage.</p>
              <div class="challenge-meta">
                <span><i class="fas fa-clock"></i> 45 mins</span>
                <span><i class="fas fa-code"></i> JavaScript, HTML</span>
              </div>
            </div>
            <div class="challenge-footer">
              <button class="btn btn-primary open-challenge" data-id="6">Start Challenge</button>
            </div>
          </div>

          <div class="challenge-card" data-category="data-structures" data-difficulty="hard">
            <div class="challenge-header">
              <div class="challenge-badges">
                <span class="badge badge-difficulty badge-hard">Hard</span>
                <span class="badge badge-points">250 Points</span>
              </div>
              <h3>Graph Traversal</h3>
              <p class="challenge-category">Data Structures</p>
            </div>
            <div class="challenge-body">
              <p>Implement BFS and DFS for a given graph.</p>
              <div class="challenge-meta">
                <span><i class="fas fa-clock"></i> 50 mins</span>
                <span><i class="fas fa-code"></i> Python, Java</span>
              </div>
            </div>
            <div class="challenge-footer">
              <button class="btn btn-primary open-challenge" data-id="7">Start Challenge</button>
            </div>
          </div>

          <div class="challenge-card streak-challenge" data-category="streak" data-difficulty="medium">
            <div class="challenge-header">
              <div class="challenge-badges">
                <span class="badge badge-difficulty badge-medium">Medium</span>
                <span class="badge badge-points">+50 Bonus Points</span>
              </div>
              <h3>Streak Challenge</h3>
              <p class="challenge-category">Special</p>
            </div>
            <div class="challenge-body">
              <p>Complete 3 challenges in a row to earn bonus points!</p>
              <div class="challenge-meta">
                <span><i class="fas fa-clock"></i> Ongoing</span>
                <span><i class="fas fa-code"></i> Any Language</span>
              </div>
            </div>
            <div class="challenge-footer">
              <button class="btn btn-primary open-challenge" data-id="8">Start Streak</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <div id="compiler-modal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <h2 id="challenge-title">Challenge Title</h2>
        <span class="close-modal">&times;</span>
      </div>
      <div class="modal-body">
        <div class="challenge-description">
          <h3>Description</h3>
          <p id="challenge-description">Challenge description goes here...</p>
          <div class="challenge-examples">
            <h4>Examples</h4>
            <pre id="challenge-examples">Input: [...]\nOutput: [...]</pre>
          </div>
        </div>
        <div class="compiler-container">
          <div class="compiler-header">
            <div class="language-selector">
              <label for="language-select">Language:</label>
              <select id="language-select">
                <option value="javascript">JavaScript</option>
                <option value="python">Python</option>
                <option value="java">Java</option>
              </select>
            </div>
            <div class="theme-selector">
              <label for="theme-select">Theme:</label>
              <select id="theme-select">
                <option value="monokai">Monokai</option>
                <option value="github">GitHub</option>
                <option value="tomorrow">Tomorrow</option>
                <option value="kuroir">Kuroir</option>
              </select>
            </div>
          </div>
          <div id="editor">// Write your code here...</div>
          <div class="compiler-controls">
            <button id="run-code" class="btn btn-primary"><i class="fas fa-play"></i> Run Code</button>
            <button id="submit-code" class="btn btn-success"><i class="fas fa-check"></i> Submit</button>
            <button id="reset-code" class="btn btn-outline"><i class="fas fa-redo"></i> Reset</button>
          </div>
          <div class="output-container">
            <h4>Output</h4>
            <pre id="output-area">// Code output will appear here...</pre>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include 'footer.php'; ?>
  <script src="../script/script.js"></script>
  <script src="../script/compiler.js"></script>
</body>
</html>