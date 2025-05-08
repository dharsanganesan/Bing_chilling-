<?php
session_start();

$game_title = "Effective Communication Challenge";
$game_description = "Test your skills in effective communication with real-life scenarios. Choose the best response to each situation.";

$scenarios = [
    // Easy questions (1-5)
    [
        "scenario" => "Your colleague asks for help with their workload, but you are overwhelmed with your own tasks. How do you respond?",
        "choices" => [
            "I'll say 'No, I can't help you right now. I'm too busy!'",
            "I'll say 'Sure, I'll help you, even though I have a lot to do.'",
            "I'll say 'I can't help you right now, but maybe later. Let's discuss how we can manage this together.'"
        ],
        "correct_answer" => 3,
        "feedback" => "The third option shows you're setting boundaries while remaining collaborative.",
        "difficulty" => "easy"
    ],
    [
        "scenario" => "A friend is upset with you for canceling plans at the last minute. How do you handle the situation?",
        "choices" => [
            "I'll say 'It's not a big deal, deal with it.'",
            "I'll say 'Sorry, I should have planned better. I understand you're upset.'",
            "I'll say 'I didn't cancel for no reason, so I don't see why you're mad.'"
        ],
        "correct_answer" => 2,
        "feedback" => "The second option shows empathy and takes responsibility - key to maintaining relationships.",
        "difficulty" => "easy"
    ],
    [
        "scenario" => "You receive an email with unclear instructions from your manager. What do you do?",
        "choices" => [
            "Guess what they meant and proceed with your interpretation",
            "Ignore the email and wait for them to follow up",
            "Reply asking for clarification with specific questions"
        ],
        "correct_answer" => 3,
        "feedback" => "Asking for clarification prevents misunderstandings and shows initiative.",
        "difficulty" => "easy"
    ],
    [
        "scenario" => "A customer is complaining about a product issue. How do you respond?",
        "choices" => [
            "Tell them all products have issues and they should deal with it",
            "Listen actively, apologize, and offer a solution",
            "Transfer them to another department immediately"
        ],
        "correct_answer" => 2,
        "feedback" => "Active listening and problem-solving are key to customer service.",
        "difficulty" => "easy"
    ],
    [
        "scenario" => "You need to ask your boss for a day off. How do you approach this?",
        "choices" => [
            "Demand the day off because you deserve it",
            "Ask politely with advance notice and offer to prepare coverage",
            "Call in sick on the day you want off"
        ],
        "correct_answer" => 2,
        "feedback" => "Professional requests with solutions demonstrate responsibility.",
        "difficulty" => "easy"
    ],
    // Medium questions (6-10)
    [
        "scenario" => "Your boss asks you to take on an extra project, but you don't think it's realistic. How do you respond?",
        "choices" => [
            "I'll say 'I don't think I can do it, it's too much work!'",
            "I'll say 'Sure, I'll just figure it out somehow.'",
            "I'll say 'I think the project is too much for me right now. Could we prioritize or delegate some tasks?'"
        ],
        "correct_answer" => 3,
        "feedback" => "The third option demonstrates professional communication by proposing solutions.",
        "difficulty" => "medium"
    ],
    [
        "scenario" => "During a meeting, a coworker keeps interrupting you. What do you do?",
        "choices" => [
            "Interrupt them back louder to make your point",
            "Stay quiet and let them dominate the conversation",
            "Say 'I'd like to finish my thought, then I'm happy to hear your perspective'"
        ],
        "correct_answer" => 3,
        "feedback" => "Politely asserting your right to speak maintains professionalism.",
        "difficulty" => "medium"
    ],
    [
        "scenario" => "You disagree with your manager's approach to a project. How do you express this?",
        "choices" => [
            "Tell them their idea is wrong in front of the team",
            "Don't say anything and do it their way",
            "Request a private conversation and present alternative solutions"
        ],
        "correct_answer" => 3,
        "feedback" => "Offering alternatives privately shows initiative while respecting hierarchy.",
        "difficulty" => "medium"
    ],
    [
        "scenario" => "A team member isn't pulling their weight on a group project. How do you address this?",
        "choices" => [
            "Complain about them to other coworkers",
            "Do all their work for them without saying anything",
            "Have a direct but respectful conversation about expectations"
        ],
        "correct_answer" => 3,
        "feedback" => "Direct communication prevents resentment and clarifies expectations.",
        "difficulty" => "medium"
    ],
    [
        "scenario" => "You receive criticism about your work performance. How do you respond?",
        "choices" => [
            "Get defensive and explain why the critic is wrong",
            "Take it personally and feel bad about yourself",
            "Ask for specific examples and how you can improve"
        ],
        "correct_answer" => 3,
        "feedback" => "Viewing criticism as growth opportunities demonstrates professionalism.",
        "difficulty" => "medium"
    ],
    // Hard questions (11-15)
    [
        "scenario" => "You need to deliver bad news to your team about budget cuts. How do you approach this?",
        "choices" => [
            "Send an email with all the details late on Friday",
            "Call an urgent meeting, be transparent but empathetic",
            "Hide the information and hope no one notices"
        ],
        "correct_answer" => 2,
        "feedback" => "Transparent, face-to-face communication builds trust in difficult situations.",
        "difficulty" => "hard"
    ],
    [
        "scenario" => "Two team members are having a personal conflict that affects work. As their manager, how do you handle it?",
        "choices" => [
            "Ignore it and hope they work it out themselves",
            "Take sides based on who you like better",
            "Facilitate a mediation session to resolve the conflict"
        ],
        "correct_answer" => 3,
        "feedback" => "Mediation helps parties find mutually acceptable solutions.",
        "difficulty" => "hard"
    ],
    [
        "scenario" => "You discover a serious mistake made by your boss. How do you communicate this?",
        "choices" => [
            "Point it out publicly to make sure everyone knows",
            "Tell your boss privately and offer to help fix it",
            "Pretend you didn't notice to avoid embarrassment"
        ],
        "correct_answer" => 2,
        "feedback" => "Private communication preserves dignity while addressing the issue.",
        "difficulty" => "hard"
    ],
    [
        "scenario" => "A client is being verbally abusive during a meeting. How do you respond?",
        "choices" => [
            "Respond with equal aggression to show you won't be bullied",
            "End the meeting immediately and report the behavior",
            "Stay silent and tolerate the behavior to keep the client"
        ],
        "correct_answer" => 2,
        "feedback" => "Setting boundaries against abuse is essential while remaining professional.",
        "difficulty" => "hard"
    ],
    [
        "scenario" => "You need to fire an employee who is also a friend. How do you approach this?",
        "choices" => [
            "Have HR do it so you don't have to be involved",
            "Be direct but compassionate, explaining the reasons clearly",
            "Avoid the conversation and make their work conditions worse"
        ],
        "correct_answer" => 2,
        "feedback" => "Direct yet compassionate communication maintains dignity in difficult situations.",
        "difficulty" => "hard"
    ]
];

// Initialize game state
if (!isset($_SESSION['score'])) {
    $_SESSION['score'] = 0;
    $_SESSION['index'] = 0;
    $_SESSION['show_feedback'] = false;
    $_SESSION['answers'] = array();
}

$currentIndex = $_SESSION['index'];
$totalQuestions = count($scenarios);
$gameOver = ($currentIndex >= $totalQuestions);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['choice'])) {
        $userChoice = (int)$_POST['choice'];
        
        // Store user's answer
        $_SESSION['answers'][$currentIndex] = $userChoice;
        
        // Check if answer is correct
        if ($userChoice == $scenarios[$currentIndex]['correct_answer']) {
            $_SESSION['score']++;
            $_SESSION['last_answer_correct'] = true;
        } else {
            $_SESSION['last_answer_correct'] = false;
        }
        
        $_SESSION['show_feedback'] = true;
    } elseif (isset($_POST['next'])) {
        $_SESSION['index']++;
        $_SESSION['show_feedback'] = false;
        $currentIndex = $_SESSION['index'];
        $gameOver = ($currentIndex >= $totalQuestions);
    } elseif (isset($_POST['back'])) {
        if ($_SESSION['index'] > 0) {
            $_SESSION['index']--;
            $_SESSION['show_feedback'] = false;
            $currentIndex = $_SESSION['index'];
            
            // If going back to a previously answered question, adjust score if needed
            if (isset($_SESSION['answers'][$currentIndex])) {
                $previousAnswer = $_SESSION['answers'][$currentIndex];
                $wasCorrect = ($previousAnswer == $scenarios[$currentIndex]['correct_answer']);
                
                // If the current feedback state doesn't match the answer, adjust
                if (isset($_SESSION['last_answer_correct']) && 
                    $_SESSION['last_answer_correct'] != $wasCorrect) {
                    if ($wasCorrect) {
                        $_SESSION['score']++;
                    } else {
                        $_SESSION['score']--;
                    }
                }
                $_SESSION['last_answer_correct'] = $wasCorrect;
            }
        }
    } elseif (isset($_POST['restart'])) {
        session_destroy();
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $game_title; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        :root {
            --primary-color: #4a6fa5;
            --secondary-color: #166088;
            --accent-color: #4fc3f7;
            --correct-color: #4caf50;
            --wrong-color: #f44336;
            --text-color: #333;
            --light-bg: #f5f7fa;
            --easy-color: #4caf50;
            --medium-color: #ff9800;
            --hard-color: #f44336;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: var(--text-color);
            background-color: var(--light-bg);
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-image: url('https://i.gifer.com/7VE.gif');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-blend-mode: overlay;
            background-color: rgba(245, 247, 250, 0.9);
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            flex: 1;
            position: relative;
            z-index: 1;
        }
        
        header {
            background-color: var(--primary-color);
            color: white;
            padding: 20px 0;
            text-align: center;
            border-radius: 0 0 10px 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: relative;
        }
        
        h1 {
            margin: 0;
            font-size: 2.2em;
        }
        
        .game-description {
            font-style: italic;
            margin-top: 10px;
        }
        
        .game-card {
            background-color: white;
            border-radius: 8px;
            padding: 25px;
            margin: 20px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .game-card:hover {
            transform: translateY(-5px);
        }
        
        .difficulty-tag {
            position: absolute;
            top: 10px;
            right: 10px;
            padding: 10px 20px;
            border-radius: 12px;
            font-size: 0.8em;
            font-weight: bold;
            color: white;
        }
        
        .easy {
            background-color: var(--easy-color);
        }
        
        .medium {
            background-color: var(--medium-color);
        }
        
        .hard {
            background-color: var(--hard-color);
        }
        
        .scenario {
            font-size: 1.2em;
            margin-bottom: 20px;
            font-weight: 500;
        }
        
        .choices {
            margin: 20px 0;
        }
        
        .choice {
            margin: 10px 0;
            padding: 12px 15px;
            background-color: #f0f4f8;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }
        
        .choice:hover {
            background-color: #e1e8ed;
        }
        
        .choice input {
            margin-right: 10px;
        }
        
        .choice.selected {
            background-color: var(--accent-color);
            color: white;
        }
        
        button, input[type="submit"] {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            transition: all 0.3s;
        }
        
        button:hover, input[type="submit"]:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
        }
        
        .feedback {
            margin: 20px 0;
            padding: 15px;
            border-radius: 5px;
            display: none;
            animation: fadeIn 0.5s ease-out;
        }
        
        .correct {
            background-color: rgba(76, 175, 80, 0.2);
            border-left: 4px solid var(--correct-color);
            display: block;
        }
        
        .wrong {
            background-color: rgba(244, 67, 54, 0.2);
            border-left: 4px solid var(--wrong-color);
            display: block;
        }
        
        .progress-container {
            width: 100%;
            background-color: #e0e0e0;
            border-radius: 5px;
            margin: 20px 0;
            height: 10px;
            margin-top: 50px;
            position: relative;
        }
        
        .progress-bar {
            height: 100%;
            background: linear-gradient(90deg, var(--easy-color), var(--medium-color), var(--hard-color));
            border-radius: 5px;
            width: <?php echo $gameOver ? 100 : (($currentIndex / $totalQuestions) * 100); ?>%;
            transition: width 0.5s ease;
        }
        
        .score-display {
            text-align: center;
            font-size: 1.2em;
            margin: 20px 0;
            background-color: white;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .final-score {
            text-align: center;
            font-size: 1.5em;
            margin: 20px 0;
            color: var(--primary-color);
            animation: bounce 1s;
        }
        
        .action-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        
        .next-btn {
            background-color: var(--accent-color);
        }
        
        .restart-btn {
            background-color: #ff9800;
        }
        
        .back-btn {
            background-color: #9e9e9e;
            position: absolute;
            left: 20px;
            top: 20px;
        }
        
        .character {
            position: fixed;
            bottom: 20px;
            width: 150px;
            z-index: 0;
        }
        
        .character-left {
            left: 20px;
        }
        
        .character-right {
            right: 20px;
        }
        
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {transform: translateY(0);}
            40% {transform: translateY(-20px);}
            60% {transform: translateY(-10px);}
        }
        
        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }
            
            h1 {
                font-size: 1.8em;
            }
            
            .game-card {
                padding: 15px;
            }
            
            .character {
                width: 100px;
                bottom: 10px;
            }
            
            .character-left {
                left: 5px;
            }
            
            .character-right {
                right: 5px;
            }
            
            .back-btn {
                left: 10px;
                top: 10px;
                padding: 8px 12px;
                font-size: 0.8em;
            }
        }
    </style>
</head>
<body>

    <header>
        <div class="container">
            <?php if (!$gameOver && $currentIndex > 0 && !$_SESSION['show_feedback']): ?>
                <form method="POST" style="display: inline;">
                    <button type="submit" name="back" class="back-btn">← Back</button>
                </form>
            <?php endif; ?>
            <h1><?php echo $game_title; ?></h1>
            <p class="game-description"><?php echo $game_description; ?></p>
        </div>
    </header>
    
    <div class="container">
        <?php if (!$gameOver): ?>
            <div class="progress-container">
                <div class="progress-bar"></div>
            </div>
            
            <div class="score-display">
                Score: <?php echo $_SESSION['score']; ?> / <?php echo $totalQuestions; ?>
                <span class="difficulty-tag <?php echo $scenarios[$currentIndex]['difficulty']; ?>">
                    <?php echo ucfirst($scenarios[$currentIndex]['difficulty']); ?>
                </span>
            </div>
            
            <div class="game-card animate__animated animate__fadeIn">
                <div class="scenario">
                    <h2>Scenario <?php echo $currentIndex + 1; ?>:</h2>
                    <p><?php echo $scenarios[$currentIndex]['scenario']; ?></p>
                </div>
                
                <?php if ($_SESSION['show_feedback']): ?>
                    <div class="feedback <?php echo $_SESSION['last_answer_correct'] ? 'correct' : 'wrong'; ?>">
                        <?php if ($_SESSION['last_answer_correct']): ?>
                            <h3>✅ Correct!</h3>
                        <?php else: ?>
                            <h3>❌ Incorrect</h3>
                        <?php endif; ?>
                        <p><?php echo $scenarios[$currentIndex]['feedback']; ?></p>
                    </div>
                    
                    <form method="POST">
                        <input type="submit" name="next" value="Next Scenario →" class="next-btn">
                    </form>
                <?php else: ?>
                    <form method="POST" class="choices">
                        <?php foreach ($scenarios[$currentIndex]['choices'] as $index => $choice): ?>
                            <label class="choice <?php echo isset($_SESSION['answers'][$currentIndex]) && $_SESSION['answers'][$currentIndex] == $index + 1 ? 'selected' : ''; ?>">
                                <input type="radio" name="choice" value="<?php echo $index + 1; ?>" required 
                                    <?php echo isset($_SESSION['answers'][$currentIndex]) && $_SESSION['answers'][$currentIndex] == $index + 1 ? 'checked' : ''; ?>>
                                <?php echo $choice; ?>
                            </label>
                        <?php endforeach; ?>
                        <div class="action-buttons">
                            <input type="submit" value="Submit Answer" class="animate__animated animate__pulse animate__infinite">
                        </div>
                    </form>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <div class="game-card animate__animated animate__zoomIn">
                <h2>Game Complete!</h2>
                <div class="final-score">
                    Your final score: <?php echo $_SESSION['score']; ?> out of <?php echo $totalQuestions; ?>
                </div>
                
                <?php
                $percentage = ($_SESSION['score'] / $totalQuestions) * 100;
                if ($percentage >= 80) {
                    echo "<p class='animate__animated animate__tada'>🎉 Excellent! You're a communication pro!</p>";
                } elseif ($percentage >= 50) {
                    echo "<p class='animate__animated animate__bounceIn'>👍 Good job! You have solid communication skills.</p>";
                } else {
                    echo "<p class='animate__animated animate__shakeX'>💡 Keep practicing! Communication is a skill that improves with effort.</p>";
                }
                ?>
                
                <form method="POST">
                    <input type="submit" name="restart" value="Play Again" class="restart-btn animate__animated animate__pulse">
                </form>
            </div>
        <?php endif; ?>
    </div>
    
    <script>
        // Add interactive effects to choices
        document.addEventListener('DOMContentLoaded', function() {
            const choices = document.querySelectorAll('.choice');
            choices.forEach(choice => {
                choice.addEventListener('click', function() {
                    // Remove selected class from all choices
                    choices.forEach(c => c.classList.remove('selected'));
                    // Add selected class to clicked choice
                    this.classList.add('selected');
                    // Find the radio input and check it
                    const radio = this.querySelector('input[type="radio"]');
                    radio.checked = true;
                });
            });
            
            // Add floating animation to characters
            const characters = document.querySelectorAll('.character');
            characters.forEach((char, index) => {
                // Alternate floating direction
                if (index % 2 === 0) {
                    char.style.animation = 'float 3s ease-in-out infinite';
                } else {
                    char.style.animation = 'float 3s ease-in-out infinite 1.5s';
                }
            });
        });
    </script>
</body>
</html>