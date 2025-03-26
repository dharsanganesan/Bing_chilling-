
document.addEventListener('DOMContentLoaded', function() {
  // Set current year in footer
  document.getElementById('current-year').textContent = new Date().getFullYear();
  
  // Mobile menu toggle
  const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
  const navLinks = document.querySelector('.nav-links');
  const authButtons = document.querySelector('.auth-buttons');
  
  if (mobileMenuBtn) {
    mobileMenuBtn.addEventListener('click', function() {
      navLinks.style.display = navLinks.style.display === 'flex' ? 'none' : 'flex';
      authButtons.style.display = authButtons.style.display === 'flex' ? 'none' : 'flex';
      
      if (navLinks.style.display === 'flex') {
        navLinks.style.flexDirection = 'column';
        navLinks.style.position = 'absolute';
        navLinks.style.top = '100%';
        navLinks.style.left = '0';
        navLinks.style.width = '100%';
        navLinks.style.backgroundColor = 'var(--bg-color)';
        navLinks.style.padding = '1rem';
        navLinks.style.boxShadow = 'var(--shadow-md)';
        
        authButtons.style.flexDirection = 'column';
        authButtons.style.position = 'absolute';
        authButtons.style.top = `${navLinks.offsetHeight + navLinks.offsetTop}px`;
        authButtons.style.left = '0';
        authButtons.style.width = '100%';
        authButtons.style.backgroundColor = 'var(--bg-color)';
        authButtons.style.padding = '1rem';
        authButtons.style.boxShadow = 'var(--shadow-md)';
      }
    });
  }
  
  // Learning path tabs
  const tabBtns = document.querySelectorAll('.tab-btn');
  const tabContents = document.querySelectorAll('.tab-content');
  
  if (tabBtns.length > 0) {
    tabBtns.forEach(btn => {
      btn.addEventListener('click', () => {
        // Remove active class from all buttons and content
        tabBtns.forEach(b => b.classList.remove('active'));
        tabContents.forEach(c => c.classList.remove('active'));
        
        // Add active class to clicked button and corresponding content
        btn.classList.add('active');
        const target = btn.getAttribute('data-target');
        document.getElementById(target).classList.add('active');
      });
    });
  }
  
  // Challenge filtering
  const categoryFilter = document.getElementById('category-filter');
  const difficultyFilter = document.getElementById('difficulty-filter');
  const searchChallenges = document.getElementById('search-challenges');
  const challengeCards = document.querySelectorAll('.challenge-card');
  
  if (categoryFilter && difficultyFilter && searchChallenges) {
    function filterChallenges() {
      const categoryValue = categoryFilter.value;
      const difficultyValue = difficultyFilter.value;
      const searchValue = searchChallenges.value.toLowerCase();
      
      challengeCards.forEach(card => {
        const category = card.getAttribute('data-category');
        const difficulty = card.getAttribute('data-difficulty');
        const title = card.querySelector('h3').textContent.toLowerCase();
        const description = card.querySelector('.challenge-body p').textContent.toLowerCase();
        
        const matchesCategory = categoryValue === 'all' || category === categoryValue;
        const matchesDifficulty = difficultyValue === 'all' || difficulty === difficultyValue;
        const matchesSearch = title.includes(searchValue) || description.includes(searchValue);
        
        if (matchesCategory && matchesDifficulty && matchesSearch) {
          card.style.display = 'block';
        } else {
          card.style.display = 'none';
        }
      });
    }
    
    categoryFilter.addEventListener('change', filterChallenges);
    difficultyFilter.addEventListener('change', filterChallenges);
    searchChallenges.addEventListener('input', filterChallenges);
  }
  
  // Open challenge modal
  const openChallengeButtons = document.querySelectorAll('.open-challenge');
  const compilerModal = document.getElementById('compiler-modal');
  const closeModal = document.querySelector('.close-modal');
  
  if (openChallengeButtons.length > 0 && compilerModal && closeModal) {
    openChallengeButtons.forEach(button => {
      button.addEventListener('click', function() {
        const challengeId = this.getAttribute('data-id');
        const challengeCard = this.closest('.challenge-card');
        const title = challengeCard.querySelector('h3').textContent;
        const description = challengeCard.querySelector('.challenge-body p').textContent;
        
        // Set challenge details in modal
        document.getElementById('challenge-title').textContent = title;
        document.getElementById('challenge-description').textContent = description;
        
        // Show examples based on challenge ID
        let exampleText = '';
        switch (challengeId) {
          case '1':
            exampleText = 'Input: nums = [2, 7, 11, 15], target = 9\nOutput: [0, 1]\nExplanation: Because nums[0] + nums[1] == 9, we return [0, 1].';
            break;
          case '2':
            exampleText = 'Input: root = [1, 2, 3, 4, 5, 6, 7]\nOutput (Pre-order): [1, 2, 4, 5, 3, 6, 7]\nOutput (In-order): [4, 2, 5, 1, 6, 3, 7]\nOutput (Post-order): [4, 5, 2, 6, 7, 3, 1]';
            break;
          case '3':
            exampleText = 'Create a responsive grid layout with:\n- 3 columns on desktop\n- 2 columns on tablet\n- 1 column on mobile\nInclude responsive spacing and proper alignment.';
            break;
          case '4':
            exampleText = 'Input: weights = [10, 20, 30], values = [60, 100, 120], capacity = 50\nOutput: 220\nExplanation: We take the 2nd and 3rd items with weights 20 and 30, and values 100 and 120.';
            break;
          default:
            exampleText = 'No examples available for this challenge.';
        }
        document.getElementById('challenge-examples').textContent = exampleText;
        
        // Show modal
        compilerModal.style.display = 'block';
        
        // Initialize the editor with starter code based on challenge
        initializeEditor(challengeId);
      });
    });
    
    // Close modal when clicking the X
    closeModal.addEventListener('click', function() {
      compilerModal.style.display = 'none';
    });
    
    // Close modal when clicking outside the modal content
    window.addEventListener('click', function(event) {
      if (event.target === compilerModal) {
        compilerModal.style.display = 'none';
      }
    });
  }
});

// Starter code templates for different challenges
function getStarterCode(challengeId, language) {
  const templates = {
    javascript: {
      '1': `// Array Sum Finder
// Find two numbers in 'nums' that add up to 'target'
// Return their indices

function twoSum(nums, target) {
  // Your code here
  
  return [];
}

// Test case
console.log(twoSum([2, 7, 11, 15], 9)); // Should return [0, 1]`,
      
      '2': `// Binary Tree Traversal
// Implement pre-order, in-order, and post-order traversal

class TreeNode {
  constructor(val) {
    this.val = val;
    this.left = null;
    this.right = null;
  }
}

function preOrderTraversal(root) {
  // Your code here
  return [];
}

function inOrderTraversal(root) {
  // Your code here
  return [];
}

function postOrderTraversal(root) {
  // Your code here
  return [];
}

// Create a sample tree
const root = new TreeNode(1);
root.left = new TreeNode(2);
root.right = new TreeNode(3);
root.left.left = new TreeNode(4);
root.left.right = new TreeNode(5);
root.right.left = new TreeNode(6);
root.right.right = new TreeNode(7);

console.log("Pre-order:", preOrderTraversal(root));
console.log("In-order:", inOrderTraversal(root));
console.log("Post-order:", postOrderTraversal(root));`,
      
      '3': `// HTML/CSS starter for Responsive Grid Layout
// You can write HTML and CSS here, and the output will show the rendered result

const html = \`
<style>
  /* Your CSS here */
  .grid-container {
    /* Add your grid styles */
  }
  
  .grid-item {
    background-color: #ddd;
    padding: 20px;
    text-align: center;
    border-radius: 5px;
  }
  
  /* Add media queries for responsiveness */
  @media (max-width: 768px) {
    /* Tablet styles */
  }
  
  @media (max-width: 480px) {
    /* Mobile styles */
  }
</style>

<div class="grid-container">
  <div class="grid-item">Item 1</div>
  <div class="grid-item">Item 2</div>
  <div class="grid-item">Item 3</div>
  <div class="grid-item">Item 4</div>
  <div class="grid-item">Item 5</div>
  <div class="grid-item">Item 6</div>
</div>
\`;

// This will render the HTML in the output
document.write(html);`,
      
      '4': `// Knapsack Problem using Dynamic Programming
// Find the maximum value that can be put in a knapsack of capacity W

function knapsack(weights, values, capacity) {
  // Your code here
  
  return 0;
}

// Test case
const weights = [10, 20, 30];
const values = [60, 100, 120];
const capacity = 50;

console.log(knapsack(weights, values, capacity)); // Should return 220`
    },
    
    python: {
      '1': `# Array Sum Finder
# Find two numbers in 'nums' that add up to 'target'
# Return their indices

def two_sum(nums, target):
    # Your code here
    
    return []

# Test case
print(two_sum([2, 7, 11, 15], 9))  # Should return [0, 1]`,
      
      '2': `# Binary Tree Traversal
# Implement pre-order, in-order, and post-order traversal

class TreeNode:
    def __init__(self, val=0, left=None, right=None):
        self.val = val
        self.left = left
        self.right = right

def pre_order_traversal(root):
    # Your code here
    return []

def in_order_traversal(root):
    # Your code here
    return []

def post_order_traversal(root):
    # Your code here
    return []

# Create a sample tree
root = TreeNode(1)
root.left = TreeNode(2)
root.right = TreeNode(3)
root.left.left = TreeNode(4)
root.left.right = TreeNode(5)
root.right.left = TreeNode(6)
root.right.right = TreeNode(7)

print("Pre-order:", pre_order_traversal(root))
print("In-order:", in_order_traversal(root))
print("Post-order:", post_order_traversal(root))`,
      
      '3': `# HTML/CSS in Python environment for Responsive Grid Layout
# This is just a placeholder - in a real environment, you'd use a proper HTML/CSS editor

html_code = """
<style>
  /* Your CSS here */
  .grid-container {
    /* Add your grid styles */
  }
  
  .grid-item {
    background-color: #ddd;
    padding: 20px;
    text-align: center;
    border-radius: 5px;
  }
  
  /* Add media queries for responsiveness */
  @media (max-width: 768px) {
    /* Tablet styles */
  }
  
  @media (max-width: 480px) {
    /* Mobile styles */
  }
</style>

<div class="grid-container">
  <div class="grid-item">Item 1</div>
  <div class="grid-item">Item 2</div>
  <div class="grid-item">Item 3</div>
  <div class="grid-item">Item 4</div>
  <div class="grid-item">Item 5</div>
  <div class="grid-item">Item 6</div>
</div>
"""

print("In a real environment, this HTML/CSS would be rendered in a browser.")
print("For this challenge, submit your code as a CodePen or similar.")`,
      
      '4': `# Knapsack Problem using Dynamic Programming
# Find the maximum value that can be put in a knapsack of capacity W

def knapsack(weights, values, capacity):
    # Your code here
    
    return 0

# Test case
weights = [10, 20, 30]
values = [60, 100, 120]
capacity = 50

print(knapsack(weights, values, capacity))  # Should return 220`
    },
    
    java: {
      '1': `// Array Sum Finder
// Find two numbers in 'nums' that add up to 'target'
// Return their indices

import java.util.*;

public class Main {
    public static int[] twoSum(int[] nums, int target) {
        // Your code here
        
        return new int[]{0, 0};
    }
    
    public static void main(String[] args) {
        int[] nums = {2, 7, 11, 15};
        int target = 9;
        int[] result = twoSum(nums, target);
        System.out.println(Arrays.toString(result));  // Should print [0, 1]
    }
}`,
      
      '2': `// Binary Tree Traversal
// Implement pre-order, in-order, and post-order traversal

import java.util.*;

class TreeNode {
    int val;
    TreeNode left;
    TreeNode right;
    
    TreeNode(int val) {
        this.val = val;
    }
}

public class Main {
    public static List<Integer> preOrderTraversal(TreeNode root) {
        // Your code here
        return new ArrayList<>();
    }
    
    public static List<Integer> inOrderTraversal(TreeNode root) {
        // Your code here
        return new ArrayList<>();
    }
    
    public static List<Integer> postOrderTraversal(TreeNode root) {
        // Your code here
        return new ArrayList<>();
    }
    
    public static void main(String[] args) {
        // Create a sample tree
        TreeNode root = new TreeNode(1);
        root.left = new TreeNode(2);
        root.right = new TreeNode(3);
        root.left.left = new TreeNode(4);
        root.left.right = new TreeNode(5);
        root.right.left = new TreeNode(6);
        root.right.right = new TreeNode(7);
        
        System.out.println("Pre-order: " + preOrderTraversal(root));
        System.out.println("In-order: " + inOrderTraversal(root));
        System.out.println("Post-order: " + postOrderTraversal(root));
    }
}`,
      
      '3': `// HTML/CSS in Java environment for Responsive Grid Layout
// This is just a placeholder - in a real environment, you'd use a proper HTML/CSS editor

public class Main {
    public static void main(String[] args) {
        String html = """
            <style>
              /* Your CSS here */
              .grid-container {
                /* Add your grid styles */
              }
              
              .grid-item {
                background-color: #ddd;
                padding: 20px;
                text-align: center;
                border-radius: 5px;
              }
              
              /* Add media queries for responsiveness */
              @media (max-width: 768px) {
                /* Tablet styles */
              }
              
              @media (max-width: 480px) {
                /* Mobile styles */
              }
            </style>
            
            <div class="grid-container">
              <div class="grid-item">Item 1</div>
              <div class="grid-item">Item 2</div>
              <div class="grid-item">Item 3</div>
              <div class="grid-item">Item 4</div>
              <div class="grid-item">Item 5</div>
              <div class="grid-item">Item 6</div>
            </div>
        """;
        
        System.out.println("In a real environment, this HTML/CSS would be rendered in a browser.");
        System.out.println("For this challenge, submit your code as a CodePen or similar.");
    }
}`,
      
      '4': `// Knapsack Problem using Dynamic Programming
// Find the maximum value that can be put in a knapsack of capacity W

public class Main {
    public static int knapsack(int[] weights, int[] values, int capacity) {
        // Your code here
        
        return 0;
    }
    
    public static void main(String[] args) {
        int[] weights = {10, 20, 30};
        int[] values = {60, 100, 120};
        int capacity = 50;
        
        System.out.println(knapsack(weights, values, capacity));  // Should return 220
    }
}`
    }
  };
  
  return templates[language][challengeId] || `// No starter code available for this challenge.`;
}
const grid = document.getElementById("activity-grid");
        const tooltip = document.getElementById("tooltip");
        const totalWeeks = 52;
        const daysPerWeek = 7;
        
        function getColorClass(value) {
            if (value === 0) return "bg-gray";
            if (value === 1) return "bg-light-blue";
            if (value === 2) return "bg-green";
            return "bg-dark-purple";
        }

        for (let i = 0; i < totalWeeks * daysPerWeek; i++) {
            let randomValue = Math.random() > 0.7 ? Math.floor(Math.random() * 4) : 0;
            let cell = document.createElement("div");
            cell.classList.add("activity-cell", getColorClass(randomValue));
            cell.dataset.submissions = randomValue;
            
            cell.addEventListener("mouseenter", function (e) {
                tooltip.innerHTML = `${this.dataset.submissions} submissions`;
                tooltip.style.left = e.pageX + "px";
                tooltip.style.top = (e.pageY - 30) + "px";
                tooltip.style.display = "block";
            });
            
            cell.addEventListener("mouseleave", function () {
                tooltip.style.display = "none";
            });

            grid.appendChild(cell);
        }