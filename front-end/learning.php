<?php include 'header.php'; ?>
  <style>
    /* Side Slider Styles */
    .side-slider {
      position: fixed;
      top: 0;
      right: -400px; /* Initially hidden */
      width: 400px;
      height: 100%;
      background: #fff;
      box-shadow: -2px 0 5px rgba(0, 0, 0, 0.1);
      transition: right 0.3s ease;
      z-index: 1000;
    }

    .side-slider.open {
      right: 0; /* Show slider */
    }

    .slider-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px;
      background: #f8f9fa;
      border-bottom: 1px solid #ddd;
    }

    .close-slider {
      background: none;
      border: none;
      font-size: 24px;
      cursor: pointer;
    }

    .slider-content {
      padding: 20px;
    }

    .course-filter {
      margin-bottom: 20px;
    }

    .course-filter label {
      font-weight: bold;
      margin-right: 10px;
    }

    .course-filter select {
      padding: 5px;
      font-size: 16px;
    }

    .course-list {
      max-height: 80vh;
      overflow-y: auto;
    }

    .course-item {
      padding: 10px;
      border-bottom: 1px solid #ddd;
      cursor: pointer;
    }

    .course-item:hover {
      background: #f1f1f1;
    }

    .course-item h4 a {
      color: #007bff;
      text-decoration: none;
    }

    .course-item h4 a:hover {
      text-decoration: underline;
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
        <button class="tab-btn active" data-target="technical">Technical Skills</button>
        <button class="tab-btn" data-target="communication">Communication</button>
        <button class="tab-btn" data-target="mindset">Mindset & Attitude</button>
      </div>

      <div class="tab-content active" id="technical">
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
              <a href="#" class="btn btn-primary start-learning" data-topic="web-development">Start Learning</a>
            </div>
          </div>

          <div class="path-card">
            <div class="path-image">
              <img src="https://images.unsplash.com/photo-1518770660439-4636190af475" alt="Data Science">
            </div>
            <div class="path-content">
              <h3>Python for Data Science</h3>
              <div class="path-meta">
                <span><i class="fas fa-clock"></i> 10 weeks</span>
                <span><i class="fas fa-signal"></i> Intermediate</span>
                <span><i class="fas fa-certificate"></i> Certificate</span>
              </div>
              <p>Learn how to analyze data, create visualizations, and build machine learning models with Python.</p>
              <div class="path-progress">
                <div class="progress-bar">
                  <div class="progress" style="width: 0%"></div>
                </div>
                <span>Not started</span>
              </div>
              <a href="#" class="btn btn-primary start-learning" data-topic="python-data-science">Start Learning</a>
            </div>
          </div>

          <div class="path-card">
            <div class="path-image">
              <img src="https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d" alt="Mobile Development">
            </div>
            <div class="path-content">
              <h3>Mobile App Development</h3>
              <div class="path-meta">
                <span><i class="fas fa-clock"></i> 12 weeks</span>
                <span><i class="fas fa-signal"></i> Advanced</span>
                <span><i class="fas fa-certificate"></i> Certificate</span>
              </div>
              <p>Build cross-platform mobile applications using React Native for iOS and Android.</p>
              <div class="path-progress">
                <div class="progress-bar">
                  <div class="progress" style="width: 0%"></div>
                </div>
                <span>Not started</span>
              </div>
              <a href="#" class="btn btn-primary start-learning" data-topic="mobile-development">Start Learning</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Side Slider -->
  <div id="side-slider" class="side-slider">
    <div class="slider-header">
      <h3>Choose Your Course</h3>
      <button id="close-slider" class="close-slider">&times;</button>
    </div>
    <div class="slider-content">
      <div class="course-filter">
        <label for="course-type">Course Type:</label>
        <select id="course-type">
          <option value="free">Free Course</option>
          <option value="paid">Paid Course</option>
        </select>
      </div>
      <div class="course-list">
        <!-- Dynamic content will be loaded here -->
      </div>
    </div>
  </div>

  <?php include 'footer.php'; ?>

  <script>
    // Sample course data for each topic
    const courses = {
      "web-development": {
        free: [
          { title: "HTML Basics", description: "Learn the fundamentals of HTML.", link: "https://www.w3schools.com/html/" },
          { title: "CSS Styling", description: "Master CSS for styling web pages.", link: "https://www.w3schools.com/css/default.asp" },
        ],
        paid: [
          { title: "Advanced JavaScript", description: "Learn advanced JavaScript Backend concepts.", link: "https://www.geeksforgeeks.org/advanced-javascript-backend-basics/" },
          { title: "React for Beginners", description: "Build web apps with React.", link: "https://react.dev/learn/creating-a-react-app" },
        ],
      },
      "python-data-science": {
        free: [
          { title: "Python Basics", description: "Learn Python programming fundamentals.", link: "https://www.coursera.org/learn/python-programming-fundamentals" },
          { title: "Data Visualization", description: "Create visualizations with Matplotlib.", link: "https://www.datacamp.com/tutorial/matplotlib-tutorial-python" },
        ],
        paid: [
          { title: "Machine Learning", description: "Build ML models with Python.", link: "https://machinelearningmastery.com/machine-learning-in-python-step-by-step/" },
          { title: "Data Analysis", description: "Analyze data using Pandas.", link: "https://www.turing.com/kb/data-analysis-using-pandas" },
        ],
      },
      "mobile-development": {
        free: [
          { title: "React Native Basics", description: "Learn the basics of React Native.", link: "https://reactnative.dev/docs/getting-started" },
          { title: "UI Design", description: "Design mobile app interfaces.", link: "https://www.figma.com/resources/learn-design/" },
        ],
        paid: [
          { title: "Advanced React Native", description: "Build complex mobile apps.", link: "https://www.udemy.com/topic/react-native/" },
          { title: "State Management", description: "Learn Redux for state management.", link: "https://redux.js.org/" },
        ],
      },
    };

    // Open the side slider and load content based on the selected topic
    document.querySelectorAll(".start-learning").forEach((button) => {
      button.addEventListener("click", (event) => {
        const topic = event.target.getAttribute("data-topic"); // Get the topic from the button
        document.getElementById("side-slider").classList.add("open");
        updateCourseList(topic, "free"); // Default to free courses
      });
    });

    // Close the side slider
    document.getElementById("close-slider").addEventListener("click", () => {
      document.getElementById("side-slider").classList.remove("open");
    });

    // Update course list based on selected type
    document.getElementById("course-type").addEventListener("change", (event) => {
      const type = event.target.value;
      const topic = document.querySelector(".start-learning").getAttribute("data-topic"); // Get the current topic
      updateCourseList(topic, type);
    });

    // Function to update the course list dynamically
    function updateCourseList(topic, type) {
      const courseList = document.querySelector(".course-list");
      courseList.innerHTML = ""; // Clear existing content

      courses[topic][type].forEach((course) => {
        const courseItem = document.createElement("div");
        courseItem.className = "course-item";
        courseItem.innerHTML = `
          <h4><a href="${course.link}" target="_blank">${course.title}</a></h4>
          <p>${course.description}</p>
        `;
        courseList.appendChild(courseItem);
      });
    }
  </script>
</body>
</html>