
document.addEventListener('DOMContentLoaded', () => {
  let currentStep = 1;
  const totalSteps = 7;

  const userSelections = {
    source: '',
    interest: '',
    reason: '',
    experience: '',
    time: ''
  };


  initializeContent();
  

  showStep(currentStep);
  updateProgress();
  

  if (document.getElementById('totalSteps')) {
    document.getElementById('totalSteps').textContent = totalSteps;
  }
});


function initializeContent() {
  const stepsContainer = document.querySelector('.steps-container');
  if (!stepsContainer) return;
  

  stepsContainer.innerHTML = `
    <!-- Step 1: Welcome -->
    <div class="step" id="step1" data-step="1">
      <div class="step-content">
        <div class="bot-container">
          <div class="speech-bubble">
            <p>Hi there! I'm Your Assisstant👋</p>
          </div>
          <div class="bot-mascot">
            <img src="../image/robot.gif" alt="Coddy Bot" class="bot-img">
          </div>
        </div>
        <h1 class="step-title">Welcome to Bing Chilling</h1>
        <p class="step-description">
          I'll help you learn to code with interactive lessons and real-world projects. Let's get started with a few questions to customize your experience.
        </p>
      </div>
      <div class="step-actions">
        <button class="button-primary" onclick="nextStep()">Get Started</button>
      </div>
    </div>

    <!-- Step 2: How did you hear about us -->
    <div class="step" id="step2" data-step="2">
      <div class="step-content">
        <h1 class="step-title">How did you hear about us?</h1>
        <p class="step-description">We'd love to know how you found Bing Chilling</p>
        <div class="selection-grid">
          <div class="selection-card" onclick="selectOption('source', 'Social Media')">
            <div class="card-content">
              <div class="card-icon">📱</div>
              <div class="card-title">Social Media</div>
            </div>
          </div>
          <div class="selection-card" onclick="selectOption('source', 'Friend')">
            <div class="card-content">
              <div class="card-icon">👥</div>
              <div class="card-title">Friend</div>
            </div>
          </div>
          <div class="selection-card" onclick="selectOption('source', 'Search')">
            <div class="card-content">
              <div class="card-icon">🔍</div>
              <div class="card-title">Search Engine</div>
            </div>
          </div>
          <div class="selection-card" onclick="selectOption('source', 'Advertisement')">
            <div class="card-content">
              <div class="card-icon">📢</div>
              <div class="card-title">Advertisement</div>
            </div>
          </div>
          <div class="selection-card" onclick="selectOption('source', 'Other')">
            <div class="card-content">
              <div class="card-icon">✨</div>
              <div class="card-title">Other</div>
            </div>
          </div>
        </div>
      </div>
      <div class="step-actions">
        <button class="button-secondary" onclick="prevStep()">Back</button>
        <button class="button-primary" onclick="nextStep()">Continue</button>
      </div>
    </div>

    <!-- Step 3: What do you want to learn -->
    <div class="step" id="step3" data-step="3">
      <div class="step-content">
        <h1 class="step-title">What do you want to learn?</h1>
        <p class="step-description">Select the topics you're most interested in</p>
        <div class="selection-grid">
          <div class="selection-card" onclick="selectOption('interest', 'Web Development')">
            <div class="card-content">
              <div class="card-icon">🌐</div>
              <div class="card-title">Technical Skills</div>
            </div>
          </div>
          <div class="selection-card" onclick="selectOption('interest', 'Mobile Development')">
            <div class="card-content">
              <div class="card-icon">📱</div>
              <div class="card-title">Soft Skills</div>
            </div>
          </div>
          <div class="selection-card" onclick="selectOption('interest', 'Data Science')">
            <div class="card-content">
              <div class="card-icon">📊</div>
              <div class="card-title">Aptitude Skills</div>
            </div>
          </div>
        </div>
      </div>
      <div class="step-actions">
        <button class="button-secondary" onclick="prevStep()">Back</button>
        <button class="button-primary" onclick="nextStep()">Continue</button>
      </div>
    </div>

    <!-- Step 4: Why do you want to learn -->
    <div class="step" id="step4" data-step="4">
      <div class="step-content">
        <h1 class="step-title">Why do you want to learn to code?</h1>
        <p class="step-description">This helps us tailor your learning journey</p>
        <div class="selection-grid">
          <div class="selection-card" onclick="selectOption('reason', 'Career Change')">
            <div class="card-content">
              <div class="card-icon">💼</div>
              <div class="card-title">Boost My Career</div>
            </div>
          </div>
          <div class="selection-card" onclick="selectOption('reason', 'Skill Enhancement')">
            <div class="card-content">
              <div class="card-icon">📈</div>
              <div class="card-title">Skill Enhancement</div>
            </div>
          </div>
          <div class="selection-card" onclick="selectOption('reason', 'Personal Projects')">
            <div class="card-content">
              <div class="card-icon">🛠️</div>
              <div class="card-title">Personal Projects</div>
            </div>
          </div>
          <div class="selection-card" onclick="selectOption('reason', 'Curious')">
            <div class="card-content">
              <div class="card-icon">🧠</div>
              <div class="card-title">Just Curious</div>
            </div>
          </div>
        </div>
      </div>
      <div class="step-actions">
        <button class="button-secondary" onclick="prevStep()">Back</button>
        <button class="button-primary" onclick="nextStep()">Continue</button>
      </div>
    </div>

    <!-- Step 5: Experience Level -->
    <div class="step" id="step5" data-step="5">
      <div class="step-content">
        <h1 class="step-title">What's your coding experience?</h1>
        <p class="step-description">We'll adjust the difficulty based on your level</p>
        <div class="selection-grid">
          <div class="selection-card" onclick="selectOption('experience', 'Beginner')">
            <div class="card-content">
              <div class="card-icon">🌱</div>
              <div class="card-title">Complete Beginner</div>
              <div class="card-description">Never coded before</div>
            </div>
          </div>
          <div class="selection-card" onclick="selectOption('experience', 'Some Basics')">
            <div class="card-content">
              <div class="card-icon">🌿</div>
              <div class="card-title">Some Basics</div>
              <div class="card-description">Familiar with some concepts</div>
            </div>
          </div>
          <div class="selection-card" onclick="selectOption('experience', 'Intermediate')">
            <div class="card-content">
              <div class="card-icon">🌲</div>
              <div class="card-title">Intermediate</div>
              <div class="card-description">Built some projects before</div>
            </div>
          </div>
          <div class="selection-card" onclick="selectOption('experience', 'Advanced')">
            <div class="card-content">
              <div class="card-icon">🌳</div>
              <div class="card-title">Advanced</div>
              <div class="card-description">Professional experience</div>
            </div>
          </div>
        </div>
      </div>
      <div class="step-actions">
        <button class="button-secondary" onclick="prevStep()">Back</button>
        <button class="button-primary" onclick="nextStep()">Continue</button>
      </div>
    </div>

    <!-- Step 6: Time Commitment -->
    <div class="step" id="step6" data-step="6">
      <div class="step-content">
        <h1 class="step-title">How much time can you commit?</h1>
        <p class="step-description">We'll create a schedule that works for you</p>
        <div class="selection-grid">
          <div class="selection-card" onclick="selectOption('time', '1-2 hours')">
            <div class="card-content">
              <div class="card-icon">⏱️</div>
              <div class="card-title">1-2 hours/week</div>
              <div class="card-description">Just a little bit</div>
            </div>
          </div>
          <div class="selection-card" onclick="selectOption('time', '3-5 hours')">
            <div class="card-content">
              <div class="card-icon">⏲️</div>
              <div class="card-title">3-5 hours/week</div>
              <div class="card-description">A few evenings</div>
            </div>
          </div>
          <div class="selection-card" onclick="selectOption('time', '5-10 hours')">
            <div class="card-content">
              <div class="card-icon">🕰️</div>
              <div class="card-title">5-10 hours/week</div>
              <div class="card-description">Serious commitment</div>
            </div>
          </div>
          <div class="selection-card" onclick="selectOption('time', '10+ hours')">
            <div class="card-content">
              <div class="card-icon">⏰</div>
              <div class="card-title">10+ hours/week</div>
              <div class="card-description">Full immersion</div>
            </div>
          </div>
        </div>
      </div>
      <div class="step-actions">
        <button class="button-secondary" onclick="prevStep()">Back</button>
        <button class="button-primary" onclick="nextStep()">Continue</button>
      </div>
    </div>

    <!-- Step 7: Final Step -->
    <div class="step" id="step7" data-step="7">
      <div class="step-content">
        <div class="bot-container">
          <div class="speech-bubble">
            <p>You're all set! I can't wait to start this journey with you 🚀</p>
          </div>
          <div class="bot-mascot">
           <img src="../image/robot.gif" alt="Coddy Bot" class="bot-img">
          </div>
        </div>
        <h1 class="step-title">Your learning journey begins now!</h1>
        <p class="step-description">
          Based on your preferences, we've crafted a personalized learning path for you.
        </p>
        <div class="features-grid">
          <div class="feature-card">
            <div class="feature-icon">🎯</div>
            <div class="feature-title">Personalized Path</div>
            <div class="feature-description">Learn at your own pace with content matched to your level</div>
          </div>
          <div class="feature-card">
            <div class="feature-icon">🛠️</div>
            <div class="feature-title">Hands-on Projects</div>
            <div class="feature-description">Build real projects from day one</div>
          </div>
          <div class="feature-card">
            <div class="feature-icon">👥</div>
            <div class="feature-title">Community Support</div>
            <div class="feature-description">Join a community of fellow learners</div>
          </div>
        </div>
      </div>
      <div class="step-actions">
        <button class="button-secondary" onclick="prevStep()">Back</button>
        <button class="button-primary" onclick="completeSurvey()">Start Learning</button>
      </div>
    </div>
  `;

  window.nextStep = nextStep;
  window.prevStep = prevStep;
  window.selectOption = selectOption;
  window.completeSurvey = completeSurvey;
}


function showStep(stepNumber) {

  const allSteps = document.querySelectorAll('.step');
  allSteps.forEach(step => {
    step.classList.remove('active');
  });
  

  const currentStepElement = document.getElementById(`step${stepNumber}`);
  if (currentStepElement) {
    currentStepElement.classList.add('active');
  }
}


function updateProgress() {
  const progressFill = document.getElementById('progressFill');
  const currentStepElement = document.getElementById('currentStep');
  
  if (progressFill) {
    const progressPercentage = ((currentStep - 1) / (totalSteps - 1)) * 100;
    progressFill.style.width = `${progressPercentage}%`;
  }
  
  if (currentStepElement) {
    currentStepElement.textContent = currentStep;
  }
}


function nextStep() {
  if (currentStep < totalSteps) {
    currentStep++;
    showStep(currentStep);
    updateProgress();
  }
}


function prevStep() {
  if (currentStep > 1) {
    currentStep--;
    showStep(currentStep);
    updateProgress();
  }
}


function selectOption(category, value) {

  userSelections[category] = value;
  

  const cards = document.querySelectorAll(`#step${currentStep} .selection-card`);
  cards.forEach(card => {
    card.classList.remove('selected');
    
  
    const cardTitle = card.querySelector('.card-title');
    if (cardTitle && cardTitle.textContent === value) {
      card.classList.add('selected');
    }
  });
  

  setTimeout(() => {
    nextStep();
  }, 300);
}


function completeSurvey() {
  window.location.href = 'dashboard.php'; 
}

let currentStep = 1;
const totalSteps = 7;


const userSelections = {
  source: '',
  interest: '',
  reason: '',
  experience: '',
  time: ''
};

