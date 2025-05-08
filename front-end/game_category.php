<?php
session_start();
include('header.php');

// Define the cards data with redirect links
$cards = [
    [
        'title' => 'Logic Legends',
        'content' => 'Challenge your problem-solving skills with our logic puzzles and coding challenges.',
        'image' => '../image/logic_legends.gif',
        'color' => 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)',
        'redirect' => 'logic_legend.php?option=logic-legends'
    ],
    [
        'title' => 'Persuasion Play',
        'content' => 'Master the art of persuasion through interactive scenarios and role-playing.',
        'image' => '../image/Persuasion_play.gif',
        'color' => 'linear-gradient(135deg, #ff758c 0%, #ff7eb3 100%)',
        'redirect' => 'redirect.php?option=persuasion-play'
    ],
    [
        'title' => 'Debug Dungeon',
        'content' => 'Test your debugging skills in this coding adventure full of bugs to fix.',
        'image' => '../image/communication_1.gif',
        'color' => 'linear-gradient(135deg, #43e97b 0%, #38f9d7 100%)',
        'redirect' => 'redirect.php?option=debug-dungeon'
    ]
];

// Handle redirect if option parameter is present
if (isset($_GET['option'])) {
    $valid_options = [
        'logic-legends' => 'logic_legends.php',
        'persuasion-play' => 'persuasion_play.php',
        'debug-dungeon' => 'debug_dungeon.php'
    ];
    
    $option = strtolower($_GET['option']);
    
    if (array_key_exists($option, $valid_options)) {
        $_SESSION['last_gamification_visited'] = $cards[array_search($option, array_column($cards, 'title'))]['title'];
        header("Location: " . $valid_options[$option]);
        exit();
    } else {
        header("Location: gamification.php?error=invalid_option");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gamification Choice</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body, html {
            height: 100%;
            overflow-x: hidden;
            scroll-behavior: smooth;
        }
        
        .header {
            height: 100px!important;
        }

        .video-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }

        .video-background video {
            min-width: 100%;
            min-height: 100%;
            object-fit: cover;
            filter: brightness(0.6) contrast(1.1);
        }

        .video-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(0,0,0,0.3) 0%, rgba(0,0,0,0.1) 100%);
        }

        .container_12 {
            max-width: 1200px;
            margin: 0 auto;
            padding: 80px 20px;
        }

        .section-title {
            text-align: center;
            margin-bottom: 60px;
            color: white;
            text-shadow: 0 2px 10px rgba(0,0,0,0.3);
        }

        .section-title h1 {
            font-size: clamp(2rem, 5vw, 3rem);
            margin-bottom: 20px;
            font-weight: 700;
            animation: fadeInDown 1s both;
        }

        .section-title p {
            font-size: clamp(1rem, 2vw, 1.2rem);
            max-width: 700px;
            margin: 0 auto;
            animation: fadeIn 1s both 0.3s;
        }

        .cards-container {
            display: flex;
            flex-direction: column;
            gap: 60px;
        }

        .card {
            display: flex;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.25);
            transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            opacity: 0;
            transform: translateY(30px);
        }

        .card.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .card:hover {
            transform: translateY(-10px) !important;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.35);
        }

        .card-image {
            flex: 1;
            min-height: 300px;
            position: relative;
            overflow: hidden;
        }

        .card-image::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--card-color);
            opacity: 0.3;
            z-index: 1;
            transition: opacity 0.5s ease;
        }

        .card:hover .card-image::before {
            opacity: 0.1;
        }

        .card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 1s ease;
        }

        .card:hover .card-image img {
            transform: scale(1.05);
        }

        .card-content {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
        }

        .card-content h2 {
            font-size: clamp(1.5rem, 3vw, 2rem);
            margin-bottom: 20px;
            color: #333;
            position: relative;
            display: inline-block;
        }

        .card-content h2::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 50px;
            height: 4px;
            background: var(--card-color);
            border-radius: 2px;
            transition: width 0.5s ease;
        }

        .card:hover .card-content h2::after {
            width: 80px;
        }

        .card-content p {
            font-size: clamp(1rem, 1.5vw, 1.1rem);
            line-height: 1.8;
            color: #555;
            margin-bottom: 30px;
        }

        .card-content .btn {
            display: inline-block;
            padding: 12px 30px;
            background: var(--card-color);
            color: white;
            text-decoration: none;
            border-radius: 50px;
            align-self: flex-start;
            font-weight: 500;
            letter-spacing: 0.5px;
            position: relative;
            transition: all 0.4s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border: none;
            cursor: pointer;
        }

        .card-content .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: 0.5s;
        }

        .card-content .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        .card-content .btn:hover::before {
            left: 100%;
        }

        /* Zigzag layout */
        .card:nth-child(odd) {
            flex-direction: row;
        }

        .card:nth-child(even) {
            flex-direction: row-reverse;
        }

        /* Animation delays */
        .card:nth-child(1) {
            transition-delay: 0.2s;
        }
        .card:nth-child(2) {
            transition-delay: 0.4s;
        }
        .card:nth-child(3) {
            transition-delay: 0.6s;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .card {
                flex-direction: column !important;
            }
            
            .container_12 {
                padding: 40px 15px;
            }
            
            .card-content {
                padding: 25px;
            }
        }

        /* Error message styling */
        .error-message {
            color: #ff6b6b;
            text-align: center;
            margin: 20px 0;
            font-weight: 500;
            animation: shake 0.5s;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            20%, 60% { transform: translateX(-5px); }
            40%, 80% { transform: translateX(5px); }
        }
    </style>
</head>
<body>
    <div class="video-background">
        <video autoplay muted loop playsinline>
            <source src="../image/infint_cast.mp4" type="video/mp4">
            Your browser does not support HTML5 video.
        </video>
        <div class="video-overlay"></div>
    </div>

    <div class="container_12">
        <div class="section-title animate__animated animate__fadeIn">
            <h1>Gamification: Making Tasks Fun and Engaging</h1>
            <p>Gamification is a powerful way to keep people engaged by adding game-like features such as points, levels, and rewards to everyday tasks. It helps boost motivation and participation in areas like learning, work, and digital platforms by turning regular activities into fun and goal-focused experiences.</p>
        </div>

        <?php if (isset($_GET['error']) && $_GET['error'] === 'invalid_option'): ?>
            <div class="error-message animate__animated animate__shakeX">
                Please select a valid gamification option from the cards below.
            </div>
        <?php endif; ?>

        <div class="cards-container">
            <?php foreach ($cards as $index => $card): ?>
                <div class="card" style="--card-color: <?php echo $card['color']; ?>">
                    <div class="card-image">
                        <img src="<?php echo htmlspecialchars($card['image']); ?>" alt="<?php echo htmlspecialchars($card['title']); ?>">
                    </div>
                    <div class="card-content">
                        <h2><?php echo htmlspecialchars($card['title']); ?></h2>
                        <p><?php echo htmlspecialchars($card['content']); ?></p>
                        <a href="<?php echo $card['redirect']; ?>" class="btn">Explore Now</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script>
        // Scroll reveal animation
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.card');
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -100px 0px'
            });

            cards.forEach(card => {
                observer.observe(card);
            });

            // Video speed control on hover
            const video = document.querySelector('.video-background video');
            const cardsContainer = document.querySelector('.cards-container');
            
            if (video) {
                cardsContainer.addEventListener('mouseenter', () => {
                    video.playbackRate = 0.7;
                });
                
                cardsContainer.addEventListener('mouseleave', () => {
                    video.playbackRate = 1;
                });
            }
        });
    </script>
</body>
</html>
<?php include("footer.php"); ?>