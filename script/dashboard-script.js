document.addEventListener('DOMContentLoaded', function() {
     
        const togglePassword = document.querySelector('.toggle-password');
        const passwordInput = document.getElementById('password');
        
        togglePassword.addEventListener('click', function() {
          const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
          passwordInput.setAttribute('type', type);
          
  
          this.querySelector('i').classList.toggle('fa-eye');
          this.querySelector('i').classList.toggle('fa-eye-slash');
        });
        

        const loginForm = document.getElementById('login-form');
        loginForm.addEventListener('submit', function(e) {
          e.preventDefault();
          
          const email = document.getElementById('email').value;
          const password = document.getElementById('password').value;
          
        
          console.log('Logging in with:', { email, password });

          setTimeout(() => {
            alert('Login successful! Redirecting to dashboard...');
            window.location.href = 'dashboard.php';
          }, 1000);
        });
        
      
        const socialButtons = document.querySelectorAll('.social-btn');
        socialButtons.forEach(button => {
          button.addEventListener('click', function() {
            const provider = this.classList.contains('google-btn') ? 'Google' : 'Facebook';
            alert(`${provider} login is not implemented in this demo.`);
          });
        });
      });

      document.addEventListener('DOMContentLoaded', function() {

        const tabBtns = document.querySelectorAll('.leaderboard-tabs .tab-btn');
        const tabContents = document.querySelectorAll('.tab-content');
        
        tabBtns.forEach(btn => {
          btn.addEventListener('click', () => {
      
            tabBtns.forEach(b => b.classList.remove('active'));
   
            btn.classList.add('active');
            
       
            tabContents.forEach(content => content.classList.remove('active'));
   
            const target = btn.getAttribute('data-target');
            document.getElementById(target).classList.add('active');
          });
        });
        

        const periodSelect = document.getElementById('period-select');
        periodSelect.addEventListener('change', function() {

          console.log(`Filtering leaderboard for period: ${this.value}`);
          alert(`Leaderboard data updated for: ${this.options[this.selectedIndex].text}`);
        });
      });