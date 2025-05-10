<?php
session_start();

// Moved scenarios array into main file to fix include error
function getRandomScenario() {
    $scenarios = [
        "Convince your colleague to adopt a 4-day work week.",
        "Persuade your friend to quit social media for a month.",
        "Encourage your partner to start eating plant-based meals.",
        "Convince your roommate to split chores equally.",
        "Persuade your team to use open-source tools over paid ones."
    ];
    return $scenarios[array_rand($scenarios)];
}

$scenario = $_SESSION['scenario'] ?? getRandomScenario();
$persuasion = $_SESSION['persuasion'] ?? '';
$response = $_SESSION['response'] ?? '';
$result = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submitPersuasion'])) {
        $persuasion = trim($_POST['persuasion']);
        $_SESSION['scenario'] = $scenario;
        $_SESSION['persuasion'] = $persuasion;
    } elseif (isset($_POST['submitResponse'])) {
        $response = trim($_POST['response']);
        $_SESSION['response'] = $response;

        // Evaluation logic
        $positiveWords = ['agree', 'support', 'good idea', 'let us do it', 'sounds great', 'yes', 'okay'];
        $negativeWords = ['disagree', 'not interested', 'bad idea', 'prefer not', 'no way', 'no', 'never'];

        $positiveScore = 0;
        $negativeScore = 0;

        foreach ($positiveWords as $word) {
            if (stripos($response, $word) !== false) $positiveScore++;
        }

        foreach ($negativeWords as $word) {
            if (stripos($response, $word) !== false) $negativeScore++;
        }

        if ($positiveScore > $negativeScore) {
            $result = "Success! Your response supports the argument!";
        } elseif ($negativeScore > $positiveScore) {
            $result = "Challenge! Your response opposes the argument.";
        } else {
            $result = "Neutral response. Try being more persuasive!";
        }

        // Clear session for new round
        unset($_SESSION['scenario']);
        unset($_SESSION['persuasion']);
        unset($_SESSION['response']);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Persuade Me - Communication Game</title>
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --accent: #4895ef;
            --light: #f8f9fa;
            --dark: #212529;
            --success: #4cc9f0;
            --danger: #f72585;
        }
        
        * {
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            margin: 0;
            padding: 2rem;
            color: var(--dark);
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            position: relative;
        }
        
        .back-btn {
            position: absolute;
            top: 20px;
            left: 20px;
            background: var(--primary);
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            font-size: 14px;
        }
        
        .back-btn:hover {
            background: var(--secondary);
            transform: translateX(-3px);
        }
        
        h2 {
            color: var(--primary);
            text-align: center;
            margin-bottom: 2rem;
            border-bottom: 2px solid var(--accent);
            padding-bottom: 10px;
        }
        
        .scenario-box {
            background: #e9ecef;
            padding: 1.5rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            border-left: 5px solid var(--accent);
        }
        
        .argument-box {
            background: #e6f2ff;
            padding: 1.5rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            border-left: 5px solid var(--primary);
        }
        
        textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 8px;
            resize: vertical;
            min-height: 120px;
            font-size: 16px;
            transition: border 0.3s;
        }
        
        textarea:focus {
            border-color: var(--accent);
            outline: none;
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
        }
        
        button[type="submit"] {
            background: var(--primary);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            transition: all 0.3s;
            margin-top: 10px;
        }
        
        button[type="submit"]:hover {
            background: var(--secondary);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .result-box {
            padding: 1.5rem;
            border-radius: 10px;
            margin-top: 1.5rem;
            font-weight: bold;
            text-align: center;
        }
        
        .success {
            background-color: rgba(76, 201, 240, 0.2);
            color: #006d77;
            border-left: 5px solid var(--success);
        }
        
        .challenge {
            background-color: rgba(247, 37, 133, 0.1);
            color: #9d0208;
            border-left: 5px solid var(--danger);
        }
        
        .neutral {
            background-color: rgba(253, 224, 71, 0.2);
            color: #8a5a44;
            border-left: 5px solid #ffd166;
        }
        
        .play-again-btn {
            display: block;
            width: 100%;
            text-align: center;
            margin-top: 2rem;
        }
        
        @media (max-width: 600px) {
            .container {
                padding: 1.5rem;
            }
            
            body {
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="logic_leneged.php" class="back-btn">← Back</a>
        <h2>Persuade Me - Communication Game</h2>

        <?php if (!$persuasion): ?>
            <form method="post">
                <div class="scenario-box">
                    <p><strong>Scenario:</strong> <?= htmlspecialchars($scenario) ?></p>
                </div>
                <label><strong>Your Persuasive Argument:</strong></label><br>
                <textarea name="persuasion" placeholder="Write your convincing argument here..." required></textarea><br>
                <button type="submit" name="submitPersuasion">Submit Argument</button>
            </form>
        <?php elseif (!$response): ?>
            <div class="scenario-box">
                <p><strong>Scenario:</strong> <?= htmlspecialchars($scenario) ?></p>
            </div>
            <div class="argument-box">
                <h3>Argument:</h3>
                <p><?= htmlspecialchars($persuasion) ?></p>
            </div>
            <form method="post">
                <label><strong>Your Response:</strong></label><br>
                <textarea name="response" placeholder="How would you respond to this argument?" required></textarea><br>
                <button type="submit" name="submitResponse">Submit Response</button>
            </form>
        <?php else: ?>
            <div class="scenario-box">
                <p><strong>Scenario:</strong> <?= htmlspecialchars($scenario) ?></p>
            </div>
            <div class="argument-box">
                <h3>Argument:</h3>
                <p><?= htmlspecialchars($persuasion) ?></p>
            </div>
            <div class="argument-box">
                <h3>Response:</h3>
                <p><?= htmlspecialchars($response) ?></p>
            </div>
            <div class="result-box <?= 
                strpos($result, 'Success') !== false ? 'success' : 
                (strpos($result, 'Challenge') !== false ? 'challenge' : 'neutral') 
            ?>">
                <h3>Result:</h3>
                <p><?= $result ?></p>
            </div>
            <form method="post" class="play-again-btn">
                <button type="submit">Play Again</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>