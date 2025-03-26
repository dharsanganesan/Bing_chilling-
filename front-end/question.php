<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Coddy - Learn to Code</title>
    <meta name="description" content="Interactive learning platform for coding" />
    <meta name="author" content="Coddy" />
    <link rel="stylesheet" href="../style/question.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  </head>

  <body>
    <div id="app" class="app-container">
      <header class="header">
        <div class="logo">
          <img src="../image/home-log.png" alt="Skill-path" class="logo-img">
        </div>
      </header>
      <main class="main-content">
        <div class="progress-container">
          <div class="progress-bar">
            <div class="progress-fill" id="progressFill"></div>
          </div>
          <div class="step-indicator">
            <span id="currentStep">1</span>/<span id="totalSteps">7</span>
          </div>
        </div>
        <div class="steps-container">
        </div>
      </main>
    </div>

    <script src="../script/home-script.js"></script>
  </body>
</html>

