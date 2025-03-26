let editor;

function initializeEditor(challengeId) {
  // If editor already exists, destroy it
  if (editor) {
    editor.destroy();
    editor = null;
  }
  
  // Create new editor
  editor = ace.edit("editor");
  editor.setTheme("ace/theme/monokai");
  
  // Set language mode
  const languageSelect = document.getElementById('language-select');
  setEditorLanguage(languageSelect.value);
  
  // Set initial code
  editor.setValue(getStarterCode(challengeId, languageSelect.value));
  editor.clearSelection();
  
  // Language selector change event
  languageSelect.addEventListener('change', function() {
    const language = this.value;
    setEditorLanguage(language);
    editor.setValue(getStarterCode(challengeId, language));
    editor.clearSelection();
  });
  
  // Theme selector change event
  const themeSelect = document.getElementById('theme-select');
  themeSelect.addEventListener('change', function() {
    const theme = this.value;
    editor.setTheme(`ace/theme/${theme}`);
  });
  
  // Run code button
  const runCodeBtn = document.getElementById('run-code');
  runCodeBtn.addEventListener('click', function() {
    executeCode();
  });
  
  // Submit code button
  const submitCodeBtn = document.getElementById('submit-code');
  submitCodeBtn.addEventListener('click', function() {
    submitCode();
  });
  
  // Reset code button
  const resetCodeBtn = document.getElementById('reset-code');
  resetCodeBtn.addEventListener('click', function() {
    editor.setValue(getStarterCode(challengeId, languageSelect.value));
    editor.clearSelection();
    document.getElementById('output-area').textContent = '// Code output will appear here...';
  });
}

function setEditorLanguage(language) {
  switch (language) {
    case 'javascript':
      editor.session.setMode("ace/mode/javascript");
      break;
    case 'python':
      editor.session.setMode("ace/mode/python");
      break;
    case 'java':
      editor.session.setMode("ace/mode/java");
      break;
    default:
      editor.session.setMode("ace/mode/text");
  }
}

function executeCode() {
  const language = document.getElementById('language-select').value;
  const code = editor.getValue();
  const outputArea = document.getElementById('output-area');
  
  outputArea.textContent = '// Executing code...\n';
  
  // Make a POST request to the backend
  fetch('/compile', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({
      language: language,
      code: code,
      input: '' // You can add user input if needed
    })
  })
  .then(response => response.json())
  .then(data => {
    if (data.output) {
      outputArea.textContent = data.output;
    } else if (data.error) {
      outputArea.textContent = `Error: ${data.error}`;
    }
  })
  .catch(error => {
    outputArea.textContent = `API Error: ${error.message}`;
  });
}

function submitCode() {
  const language = document.getElementById('language-select').value;
  const code = editor.getValue();
  const outputArea = document.getElementById('output-area');
  
  outputArea.textContent = '// Submitting your solution...\n';
  
  // Simulate submission process
  setTimeout(() => {
    // Execute the code first
    executeCode();
    
    // Then add submission feedback after a delay
    setTimeout(() => {
      // Get current output
      const currentOutput = outputArea.textContent;
      
      // Add feedback (in a real app, this would come from the server)
      outputArea.textContent = currentOutput + '\n\n// Submission feedback:\n';
      outputArea.textContent += 'Your solution has been submitted successfully!\n';
      outputArea.textContent += 'Results: ✅ All test cases passed\n';
      outputArea.textContent += 'Score: 100/100\n';
      outputArea.textContent += 'Congratulations! You\'ve earned points for this challenge.';
      
      // Show a success message (in a real app)
      alert('Congratulations! You have successfully completed this challenge.');
    }, 1500);
  }, 1000);
}