<?php
session_start();
require_once '../backend/connection.php';

// Initialize games array with proper redirect paths
$games = [
    'binary_challenge' => [
        'name' => 'Binary Challenge',
        'description' => 'Convert decimal numbers to binary as fast as you can!',
        'icon' => 'icon_bin.gif',
        'redirect' => 'games/binary_challenge.php',
        'category' => 'Math'
    ],
    'logic_gates' => [
        'name' => 'Logic Gates',
        'description' => 'Solve puzzles using AND, OR, NOT, and XOR gates',
        'icon' => 'logic-gates-icon.png',
        'category' => 'Logic'
    ],
    'sequence_master' => [
        'name' => 'Sequence Master',
        'description' => 'Identify and complete the logical sequences',
        'icon' => 'mind_game_1.gif',
        'category' => 'Patterns'
    ],
    'code_breaker' => [
        'name' => 'Code Breaker',
        'description' => 'Decrypt the secret messages using logical patterns',
        'icon' => 'code_breaker.gif',
        'category' => 'Puzzles'
    ],
    'memory_matrix' => [
        'name' => 'Memory Matrix',
        'description' => 'Test your memory with this challenging pattern recall game',
        'icon' => 'memory_matrix.gif',
        'category' => 'Memory'
    ],
    'quick_calc' => [
        'name' => 'Quick Calculate',
        'description' => 'Solve math problems against the clock',
        'icon' => 'quick_calc.gif',
        'category' => 'Math'
    ],
    'word_chain' => [
        'name' => 'Word Chain',
        'description' => 'Create the longest word chain possible',
        'icon' => 'word_chain.gif',
        'category' => 'Language'
    ],
    'chess_puzzles' => [
        'name' => 'Chess Puzzles',
        'description' => 'Solve tactical chess problems',
        'icon' => 'chess_puzzles.gif',
        'category' => 'Strategy'
    ]
];


$error = '';
$success = '';
$currentGame = isset($_GET['game']) ? htmlspecialchars($_GET['game']) : '';

if (isset($_POST['submit_score']) && isset($_SESSION['user_id'])) {
    $score = filter_input(INPUT_POST, 'score', FILTER_VALIDATE_INT);
    $game = filter_input(INPUT_POST, 'game', FILTER_SANITIZE_STRING);
    $level = isset($_POST['level']) ? filter_input(INPUT_POST, 'level', FILTER_VALIDATE_INT) : 1;
    
    if ($score !== false && $game) {
        try {
            $stmt = $pdo->prepare("INSERT INTO scores (user_id, game, score, level, played_at) VALUES (?, ?, ?, ?, NOW())");
            $stmt->execute([$_SESSION['user_id'], $game, $score, $level]);
            $success = "Score submitted successfully!";
        } catch (PDOException $e) {
            $error = "Error submitting score: " . $e->getMessage();
        }
    } else {
        $error = "Invalid score data";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logic Legends - Challenge Your Mind</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>

        :root {
            --primary-color: #8B5CF6;
            --secondary-color: #0EA5E9;
            --primary: #6a11cb;
            --secondary: #2575fc;
            --dark: #1a1a2e;
            --light: #f8f9fa;
            --success: #28a745;
            --danger: #dc3545;
            --warning: #ffc107;
            --math: #4e54c8;
            --logic: #8f94fb;
            --patterns: #654ea3;
            --puzzles: #eaafc8;
            --memory: #00b09b;
            --language: #96c93d;
            --strategy: #f46b45;
            --text-shadow: 0 2px 4px rgba(0,0,0,0.3);
            --box-shadow: 0 10px 20px rgba(0,0,0,0.2);
            --transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            --card-bg: rgba(30, 30, 60, 0.7);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, var(--dark), #16213e);
            color: var(--light);
            min-height: 100vh;
            line-height: 1.6;
        }
        
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
        }
        
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            margin-bottom: 30px;
        }
        
        .logo {
            font-family: 'Orbitron', sans-serif;
            font-size: 2.5rem;
            background: linear-gradient(to right, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            text-shadow: var(--text-shadow);
            letter-spacing: 1px;
        }
        .logo_desgin{
            padding-left: 30px;
    margin-top: -30px;
        }
        /* Floating Back Button */
        .floating-back-btn {
            position: absolute;
            top: 20px;
            left: 20px;
            z-index: 100;
            display: flex;
            align-items: center;
            background: rgba(255,255,255,0.1);
            border-radius: 50px;
            overflow: hidden;
            width: 40px;
            height: 40px;
            transition: var(--transition);
            border: 2px solid transparent;
            box-shadow: var(--box-shadow);
        }
        
        .floating-back-btn::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 50px;
            padding: 2px;
            background: linear-gradient(45deg, var(--primary), var(--secondary));
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            pointer-events: none;
        }
        
        .floating-back-btn:hover {
            width: 120px;
            background: rgba(255,255,255,0.2);
        }
        
        .floating-back-btn i {
            min-width: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1.2rem;
            color: white;
        }
        
        .floating-back-btn span {
            white-space: nowrap;
            padding-right: 15px;
            font-weight: 500;
            opacity: 0;
            transition: opacity 0.3s ease 0.1s;
        }
        
        .floating-back-btn:hover span {
            opacity: 1;
        }
        
        /* Enhanced Hero Section */
        .hero-section {
            text-align: center;
            margin: 60px 0 40px;
            position: relative;
            padding: 40px 20px;
            background: rgba(255,255,255,0.03);
            border-radius: 20px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.1);
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
        }
        
        
        @keyframes colorShift {
            0% { background: linear-gradient(to right, #6a11cb, #2575fc); }
            25% { background: linear-gradient(to right, #00b09b, #96c93d); }
            50% { background: linear-gradient(to right, #f46b45, #eea849); }
            75% { background: linear-gradient(to right, #654ea3, #eaafc8); }
            100% { background: linear-gradient(to right, #4e54c8, #8f94fb); }
        }
        
        .hero-subtitle {
            font-size: 1.3rem;
            color: rgba(255,255,255,0.85);
            margin-bottom: 30px;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.8;
        }
        
        .scroll-down {
            margin-top: 40px;
            animation: bounce 2s infinite;
        }
        .button_a{
    text-decoration: none;
    font-weight: bold;
    color: white;
}
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-20px); }
            60% { transform: translateY(-10px); }
        }
        
        /* Game Categories */
        .game-categories {
            display: flex;
            gap: 15px;
            margin-bottom: 40px;
            flex-wrap: wrap;
            justify-content: center;
            padding: 20px;
            background: rgba(255,255,255,0.03);
            border-radius: 15px;
            border: 1px solid rgba(255,255,255,0.1);
        }
        
        .category-btn {
            padding: 12px 24px;
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            border: none;
            font-family: 'Orbitron', sans-serif;
            font-size: 2.5rem;
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            text-shadow: var(--text-shadow);
            letter-spacing: 1px;
            position: relative;
            overflow: hidden;
            z-index: 1;
            box-shadow: var(--box-shadow);
            font-size: 1rem;
        }
        
        .category-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, transparent 25%, rgba(255,255,255,0.1) 50%, transparent 75%);
            background-size: 400% 400%;
            z-index: -1;
            transition: var(--transition);
            opacity: 0;
        }
        
        .category-btn:hover::before {
            opacity: 1;
            animation: shine 3s infinite;
        }
        
        @keyframes shine {
            0% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        .category-btn.active {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.4);
        }
        
        /* Game Grid - Enhanced Design */
        .game-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 30px;
            margin: 40px 0;
        }
        
        .game-card {
            background: var(--card-bg);
            border-radius: 20px;
            overflow: hidden;
            transition: var(--transition);
            border: 1px solid rgba(255,255,255,0.1);
            position: relative;
            box-shadow: var(--box-shadow);
            display: flex;
            flex-direction: column;
            height: 100%;
        }
        
        .game-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(255,255,255,0.05) 0%, rgba(255,255,255,0) 100%);
            opacity: 0;
            transition: var(--transition);
            z-index: 1;
        }
        
        .game-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0,0,0,0.4);
            border-color: var(--secondary);
        }
        
        .game-card:hover::before {
            opacity: 1;
        }
        
        .game-image {
            width: 100%;
            height: 200px;
            overflow: hidden;
            position: relative;
        }
        
        .game-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }
        
        .game-card:hover img {
            transform: scale(1.1);
        }
        
        .game-info {
            padding: 25px;
            position: relative;
            z-index: 2;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        
        .game-info h3 {
            font-family: 'Orbitron', sans-serif;
            margin-bottom: 15px;
            color: white;
            font-size: 1.5rem;
            text-shadow: var(--text-shadow);
        }
        
        .game-info p {
            color: rgba(255,255,255,0.8);
            margin-bottom: 25px;
            font-size: 1rem;
            line-height: 1.7;
            flex-grow: 1;
        }
        
        .game-category {
            position: absolute;
            top: 15px;
            right: 15px;
            padding: 6px 18px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: bold;
            color: white;
            z-index: 3;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .game-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: auto;
        }
        
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
            border: none;
            cursor: pointer;
            z-index: 1;
            box-shadow: var(--box-shadow);
            gap: 8px;
        }
        
        .btn-primary {
            background: linear-gradient(45deg, var(--primary), var(--secondary));
            color: white;
        }
        
        .btn-primary::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, var(--secondary), var(--primary));
            opacity: 0;
            transition: var(--transition);
            z-index: -1;
        }
        
        .btn-primary:hover::after {
            opacity: 1;
        }
        
        .btn-primary:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 15px 30px rgba(0,0,0,0.3);
        }
        
        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 25px;
            background: rgba(255,255,255,0.1);
            color: white;
            border-radius: 50px;
            text-decoration: none;
            transition: var(--transition);
            margin: 20px 0;
            border: 1px solid rgba(255,255,255,0.2);
            backdrop-filter: blur(5px);
        }
        
        .btn-back:hover {
            background: rgba(255,255,255,0.2);
            transform: translateX(-5px);
        }
        
        .game-container {
            display: none;
            animation: fadeIn 0.5s ease-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        /* Responsive Design */
        @media (max-width: 1200px) {
            .game-grid {
                grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            }
        }
        
        @media (max-width: 768px) {
            .logo {
                font-size: 2rem;
            }
            
            .hero-subtitle {
                font-size: 1.1rem;
            }
            
            .game-grid {
                grid-template-columns: 1fr;
            }
            
            .category-btn {
                padding: 10px 18px;
                font-size: 0.9rem;
            }
            
            .floating-back-btn {
                top: 15px;
                left: 15px;
                width: 36px;
                height: 36px;
            }
            
            .floating-back-btn i {
                min-width: 36px;
                font-size: 1rem;
            }
            
            .floating-back-btn:hover {
                width: 100px;
            }
        }
        
        @media (max-width: 480px) {

            
            .hero-subtitle {
                font-size: 1rem;
            }
            
            .game-categories {
                gap: 10px;
                padding: 15px;
            }
            
            .category-btn {
                padding: 8px 15px;
                font-size: 0.8rem;
            }
        }
    </style>
</head>
<body>
    <!-- Floating Back Button -->
    <a href="logic_legends.php" class="floating-back-btn button_a">
        <i class="fas fa-arrow-left"></i>
        <span>Go Back</span>
    </a>

    <div class="container">
        <header>
            <div class="logo logo_desgin">Logic Legends</div>
            <div class="auth-section">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <div class="user-profile">
                        <img src="<?= htmlspecialchars($_SESSION['avatar']) ?>" alt="Avatar" class="avatar">
                        <span><?= htmlspecialchars($_SESSION['username']) ?></span>
                    </div>
                <?php endif; ?>
            </div>
        </header>

        <section class="hero-section">
            <h1 class="logo">Choose Your Challenge</h1>
            <p class="hero-subtitle">Explore our collection of brain-training games designed to sharpen your mind and boost your cognitive skills through fun and engaging challenges</p>
            <div class="scroll-down">
                <i class="fas fa-chevron-down fa-2x" style="color: var(--secondary);"></i>
            </div>
        </section>
        
        <div class="game-categories">
            <button class="category-btn math active" onclick="filterGames('all')">All Games</button>
            <button class="category-btn math" onclick="filterGames('math')">Math</button>
            <button class="category-btn logic" onclick="filterGames('logic')">Logic</button>
            <button class="category-btn patterns" onclick="filterGames('patterns')">Patterns</button>
            <button class="category-btn puzzles" onclick="filterGames('puzzles')">Puzzles</button>
            <button class="category-btn memory" onclick="filterGames('memory')">Memory</button>
            <button class="category-btn language" onclick="filterGames('language')">Language</button>
            <button class="category-btn strategy" onclick="filterGames('strategy')">Strategy</button>
        </div>

        <!-- Error/Success Messages -->
        <?php if ($error): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <?php if ($success): ?>
            <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>

        <div class="game-grid">
            <?php foreach ($games as $key => $game): ?>
                <div class="game-card" data-category="<?= strtolower(htmlspecialchars($game['category'])) ?>">
                    <span class="game-category <?= strtolower(htmlspecialchars($game['category'])) ?>">
                        <?= htmlspecialchars($game['category']) ?>
                    </span>
                    <div class="game-image">
                        <img src="../image/<?= htmlspecialchars($game['icon']) ?>" alt="<?= htmlspecialchars($game['name']) ?>">
                    </div>
                    <div class="game-info">
                        <h3><?= htmlspecialchars($game['name']) ?></h3>
                        <p><?= htmlspecialchars($game['description']) ?></p>
                        <div class="game-footer">
                            <a href="<?= isset($game['redirect']) ? htmlspecialchars($game['redirect']) : 'game.php?game=' . urlencode($key) ?>" 
                               class="btn btn-primary">
                                Play Now <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Game Page Template -->
    <div id="game-page" class="game-container">
        <a href="logic_legends.php" class="btn-back"><i class="fas fa-arrow-left"></i> Back to Games</a>
        <div id="game-content">
            <!-- Game content will be loaded here -->
        </div>
    </div>
    <script>
        function filterGames(category) {
            const gameCards = document.querySelectorAll('.game-card');
            const categoryBtns = document.querySelectorAll('.category-btn');
            
            // Update active button with animation
            categoryBtns.forEach(btn => {
                btn.classList.remove('active');
                if ((category === 'all' && btn.textContent === 'All Games') || 
                    btn.classList.contains(category)) {
                    btn.classList.add('active');
                    
                    // Add pulse animation
                    btn.style.animation = 'none';
                    void btn.offsetWidth; // Trigger reflow
                    btn.style.animation = 'pulse 0.5s';
                }
            });
            
            // Filter games with fade animation
            gameCards.forEach(card => {
                if (category === 'all' || card.dataset.category === category) {
                    card.style.display = 'block';
                    card.style.animation = 'fadeIn 0.5s';
                } else {
                    card.style.animation = 'fadeOut 0.3s';
                    setTimeout(() => {
                        card.style.display = 'none';
                    }, 300);
                }
            });
        }
        
        // For game page navigation (example)
        function loadGame(gameId) {
            document.querySelector('.game-grid').style.display = 'none';
            document.querySelector('.game-categories').style.display = 'none';
            document.querySelector('.hero-section').style.display = 'none';
            
            const gamePage = document.getElementById('game-page');
            gamePage.style.display = 'block';
            
            // In a real implementation, you would load the game content here
            document.getElementById('game-content').innerHTML = `
                <h2>${gameId.replace(/_/g, ' ')} Game</h2>
                <p>This is where the ${gameId.replace(/_/g, ' ')} game would be loaded.</p>
            `;
        }
        
        // Check if we're coming from a game page to scroll to games section
        window.addEventListener('load', function() {
            if(window.location.hash === '#games') {
                document.querySelector('.game-grid').scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    </script>
</body>
</html>