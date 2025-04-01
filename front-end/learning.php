<?php include 'header.php'; ?>
<style>
    /* Main Container Styles */
    .learning-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        color: #333;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    /* Header Styles */
    .page-header {
        background: linear-gradient(135deg, #6e8efb, #a777e3);
        color: white;
        padding: 60px 20px;
        text-align: center;
        margin-bottom: 40px;
        border-radius: 0 0 10px 10px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    
    .page-header h1 {
        font-size: 2.5rem;
        margin-bottom: 15px;
        font-weight: 700;
    }
    
    .page-header p {
        font-size: 1.1rem;
        opacity: 0.9;
        max-width: 700px;
        margin: 0 auto;
    }
    
    /* Tabs Navigation */
    .learning-tabs {
        display: flex;
        gap: 10px;
        margin-bottom: 30px;
        border-bottom: 1px solid #e0e0e0;
        padding-bottom: 15px;
    }
    
    .tab-btn {
        padding: 12px 24px;
        background: transparent;
        border: none;
        border-radius: 30px;
        cursor: pointer;
        font-weight: 600;
        color: #666;
        transition: all 0.3s ease;
        position: relative;
    }
    
    .tab-btn:hover {
        color: #7C3AED;
        background: #f3f0ff;
    }
    
    .tab-btn.active {
        color: #7C3AED;
        background: #f3f0ff;
    }
    
    .tab-btn.active:after {
        content: '';
        position: absolute;
        bottom: -16px;
        left: 50%;
        transform: translateX(-50%);
        width: 80%;
        height: 3px;
        background: #7C3AED;
        border-radius: 3px;
    }
    
    /* Path Card Styles */
    .path-card {
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
      padding: 0;
      margin-bottom: 20px;
      display: flex;
      overflow: hidden;
    }

    
    .path-image {
        height: 180px;
        overflow: hidden;
    }
    
    .path-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .path-card:hover .path-image img {
        transform: scale(1.05);
    }
    
    .path-content {
        padding: 20px;
    }
    
    .path-content h3 {
        margin: 0 0 15px 0;
        color: #333;
        font-size: 1.4rem;
        font-weight: 700;
    }
    
    .path-meta {
        display: flex;
        gap: 15px;
        margin: 15px 0;
        color: #666;
        font-size: 0.9rem;
    }
    
    .path-meta span {
        display: flex;
        align-items: center;
        gap: 5px;
    }
    
    .path-meta i {
        color: #7C3AED;
    }
    
    .path-content p {
        color: #666;
        line-height: 1.6;
        margin-bottom: 20px;
    }
    
    .path-progress {
        margin: 20px 0;
    }
    
    .progress-bar {
        height: 8px;
        background: #f0f0f0;
        border-radius: 4px;
        margin-bottom: 8px;
        overflow: hidden;
    }
    
    .progress {
        height: 100%;
        border-radius: 4px;
        background: linear-gradient(90deg, #7C3AED, #a777e3);
        width: 0%;
        transition: width 0.5s ease;
    }
    
    .btn-primary {
        background: linear-gradient(90deg, #7C3AED, #a777e3);
        color: white;
        border: none;
        padding: 12px 25px;
        border-radius: 30px;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        text-align: center;
        font-weight: 600;
        transition: all 0.3s ease;
        width: 30%;
        box-shadow: 0 4px 6px rgba(124, 58, 237, 0.1);
    }
    
    .btn-primary:hover {
        background: linear-gradient(90deg, #6b21a8, #7C3AED);
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(124, 58, 237, 0.15);
    }
    
    /* Topic Page Styles */
    .topic-header {
        margin-bottom: 30px;
        text-align: center;
    }
    
    .topic-header h3 {
        font-size: 2rem;
        color: #333;
        margin-bottom: 15px;
        font-weight: 700;
    }
    
    .topic-content {
        background: #fff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        margin-bottom: 30px;
        border-left: 4px solid #7C3AED;
    }
    
    .topic-content h4 {
        color: #7C3AED;
        font-size: 1.5rem;
        margin-bottom: 20px;
        font-weight: 600;
    }
    
    .topic-content p {
        color: #555;
        line-height: 1.8;
        font-size: 1.1rem;
    }
    
    .section-title {
        font-size: 1.5rem;
        color: #333;
        margin: 30px 0 20px 0;
        font-weight: 600;
        position: relative;
        padding-bottom: 10px;
    }
    
    .section-title:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 3px;
        background: #7C3AED;
        border-radius: 3px;
    }
    
    .video-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 25px;
        margin-bottom: 40px;
    }
    
    .video-item {
        background: #fff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        transition: transform 0.3s ease;
        cursor: pointer;
    }
    
    .video-item:hover {
        transform: translateY(-5px);
    }
    
    .video-item img {
        width: 100%;
        height: 180px;
        object-fit: cover;
    }
    
    .video-item p {
        padding: 15px;
        margin: 0;
        font-weight: 600;
        color: #333;
    }
    
    /* Channel Cards - Professional Design */
    .channel-list {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 25px;
        margin-bottom: 40px;
    }
    
    .channel-card {
        background: #fff;
        padding: 0;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
        overflow: hidden;
        border: 1px solid #eee;
    }
    
    .channel-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }
    
    .channel-header {
        background: linear-gradient(135deg, #7C3AED, #a777e3);
        padding: 20px;
        color: white;
        text-align: center;
    }
    
    .channel-header h3 {
        margin: 0;
        font-size: 1.3rem;
        font-weight: 600;
    }
    
    .channel-body {
        padding: 20px;
    }
    
    .channel-body p {
        color: #666;
        margin-bottom: 20px;
        line-height: 1.6;
    }
    
    .channel-footer {
        padding: 15px 20px;
        background: #f9f9f9;
        border-top: 1px solid #eee;
        text-align: center;
    }
    
    .channel-link {
        color: #7C3AED;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: all 0.3s ease;
    }
    
    .channel-link:hover {
        color: #5e2ca5;
        text-decoration: underline;
    }
    
    .channel-link i {
        font-size: 0.9rem;
    }
    
    /* Content Box Design */
    .content-box {
        background: #fff;
        border-radius: 10px;
        padding: 25px;
        margin-bottom: 30px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        border-top: 3px solid #7C3AED;
    }
    
    .content-box h4 {
        color: #7C3AED;
        margin-top: 0;
        margin-bottom: 15px;
        font-size: 1.3rem;
    }
    
    .content-box p {
        color: #555;
        line-height: 1.8;
    }
    
    .content-box ul {
        padding-left: 20px;
        color: #555;
    }
    
    .content-box li {
        margin-bottom: 8px;
        line-height: 1.6;
    }
    
    /* Game Card Styles */
    .game-card {
        background: #fff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        text-align: center;
        margin-top: 40px;
        border: 2px dashed #7C3AED;
        background-image: radial-gradient(circle at 10% 20%, rgba(124, 58, 237, 0.05) 0%, rgba(124, 58, 237, 0.05) 90%);
    }
    
    .game-card h3 {
        color: #7C3AED;
        margin-top: 0;
        font-size: 1.5rem;
    }
    
    .game-card p {
        color: #666;
        margin-bottom: 25px;
        font-size: 1.1rem;
        line-height: 1.7;
    }
    
    .btn-game {
        background: linear-gradient(90deg, #7C3AED, #a777e3);
        color: white;
        border: none;
        padding: 15px 30px;
        border-radius: 30px;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        text-align: center;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(124, 58, 237, 0.1);
    }
    
    .btn-game:hover {
        background: linear-gradient(90deg, #6b21a8, #7C3AED);
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(124, 58, 237, 0.15);
    }
    
    /* Video Popup Styles */
    .video-popup {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.9);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1000;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
    }
    
    .video-popup.active {
        opacity: 1;
        visibility: visible;
    }
    
    .video-popup-content {
        width: 90%;
        max-width: 1000px;
        position: relative;
    }
    
    .video-popup-close {
        position: absolute;
        top: -50px;
        right: 0;
        color: white;
        font-size: 30px;
        cursor: pointer;
        background: none;
        border: none;
        transition: transform 0.3s ease;
    }
    
    .video-popup-close:hover {
        transform: rotate(90deg);
    }
    
    .video-popup-frame {
        width: 100%;
        height: 80vh;
        border: none;
        border-radius: 8px;
    }
    .tab-content {
      display: none;
    }

    .tab-content.active {
      display: block;
    }
    
    /* Video Thumbnail Styles */
    .video-thumbnail {
        position: relative;
        cursor: pointer;
    }
    
    .video-thumbnail img {
        width: 100%;
        height: auto;
        display: block;
    }
    
    .play-button {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 80px;
        height: 80px;
        background: rgba(255,255,255,0.2);
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        transition: all 0.3s ease;
    }
    
    .play-button:before {
        content: '';
        display: block;
        width: 0;
        height: 0;
        border-top: 15px solid transparent;
        border-bottom: 15px solid transparent;
        border-left: 25px solid white;
        margin-left: 5px;
    }
    
    .video-thumbnail:hover .play-button {
        background: rgba(124, 58, 237, 0.8);
        transform: translate(-50%, -50%) scale(1.1);
    }
    
    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .path-cards {
            grid-template-columns: 1fr;
        }
        
        .learning-tabs {
            flex-wrap: wrap;
        }
        
        .tab-btn {
            padding: 10px 15px;
            font-size: 0.9rem;
        }
        
        .video-container, .channel-list {
            grid-template-columns: 1fr;
        }
        
        .page-header {
            padding: 40px 20px;
        }
        
        .page-header h1 {
            font-size: 2rem;
        }
        
        .video-popup-frame {
            height: 50vh;
        }
        
        .play-button {
            width: 60px;
            height: 60px;
        }
    }
</style>

<!-- Video Popup -->
<div class="video-popup" id="videoPopup">
    <div class="video-popup-content">
        <button class="video-popup-close" id="closePopup">&times;</button>
        <iframe class="video-popup-frame" id="popupVideoFrame" allowfullscreen></iframe>
    </div>
</div>


    <?php
    if (isset($_GET['topic'])) {
        $topic = $_GET['topic'];
        
        $topics = [
            'verbal' => [
                'title' => 'Verbal / Non-Verbal Communication',
                'content' => '
                    <div class="content-box">
                        <h4>Mastering Communication Skills</h4>
                        <p>Effective communication is the cornerstone of professional success. This path will help you develop both verbal and non-verbal communication skills to excel in any situation.</p>
                        <ul>
                            <li>Understand the difference between verbal and non-verbal communication</li>
                            <li>Learn to read body language and facial expressions</li>
                            <li>Improve your tone and vocal variety</li>
                            <li>Develop active listening skills</li>
                            <li>Adapt your communication style to different audiences</li>
                        </ul>
                    </div>
                ',
                'videos' => [
                    ['id' => 'u_0lySVFOrY', 'title' => 'Verbal vs Non-Verbal Communication', 'thumbnail' => 'https://img.youtube.com/vi/u_0lySVFOrY/maxresdefault.jpg'],
                    ['id' => 'poJgO0FseRw', 'title' => 'Improving Your Non-Verbal Skills', 'thumbnail' => 'https://img.youtube.com/vi/poJgO0FseRw/maxresdefault.jpg'],
                    ['id' => '2eZ8TU5-Vjk', 'title' => 'The Power of Tone in Communication', 'thumbnail' => 'https://img.youtube.com/vi/2eZ8TU5-Vjk/maxresdefault.jpg']
                ],
                'channels' => [
                    [
                        'name' => 'Communication Coach', 
                        'desc' => 'Expert tips on all aspects of professional and personal communication. Learn techniques to improve your speaking, listening, and presentation skills.',
                        'link' => 'https://youtube.com/communicationcoach'
                    ],
                    [
                        'name' => 'Body Language University', 
                        'desc' => 'Master the art of non-verbal communication with practical exercises and real-world examples.',
                        'link' => 'https://youtube.com/bodylanguageuni'
                    ],
                    [
                        'name' => 'Verbal Excellence', 
                        'desc' => 'Improve your speaking skills, vocabulary, and articulation for professional settings.',
                        'link' => 'https://youtube.com/verbalexcellence'
                    ]
                ],
                'game' => [
                    'title' => 'Communication Challenge',
                    'description' => 'Test your ability to identify effective communication techniques in different scenarios with our interactive game.',
                    'page' => 'games/communication-game.php'
                ]
            ],
            'body-language' => [
                'title' => 'Body Language and Eye Contact',
                'content' => '
                    <div class="content-box">
                        <h4>The Power of Non-Verbal Communication</h4>
                        <p>Body language accounts for over 50% of all communication. This path will help you understand and utilize non-verbal signals to enhance your professional presence.</p>
                        <ul>
                            <li>Interpret common body language signals</li>
                            <li>Use eye contact effectively in different cultures</li>
                            <li>Project confidence through posture and gestures</li>
                            <li>Recognize when someone is uncomfortable or deceptive</li>
                            <li>Align your verbal and non-verbal messages</li>
                        </ul>
                    </div>
                ',
                'videos' => [
                    ['id' => 'Kzp6j8Tu8oY', 'title' => 'The Power of Body Language', 'thumbnail' => 'https://img.youtube.com/vi/ergJz5LUAGg/maxresdefault.jpg'],
                    ['id' => 'ZKZES2V7FwU', 'title' => 'Eye Contact Techniques', 'thumbnail' => 'https://img.youtube.com/vi/8OGDhlUvSK4/maxresdefault.jpg'],
                    ['id' => 'cFLjudWTuGQ', 'title' => 'Body Language for Confidence', 'thumbnail' => 'https://img.youtube.com/vi/cFLjudWTuGQ/maxresdefault.jpg']
                ],
                'channels' => [
                    [
                        'name' => 'Body Language Expert', 
                        'desc' => 'Decoding body language signals in business and social contexts with scientific research.',
                        'link' => 'https://youtube.com/bodylanguageexpert'
                    ],
                    [
                        'name' => 'Social Skills Lab', 
                        'desc' => 'Practical exercises to improve your interpersonal communication and non-verbal skills.',
                        'link' => 'https://youtube.com/socialskillslab'
                    ],
                    [
                        'name' => 'Confidence Coach', 
                        'desc' => 'Build confidence through body language mastery and presence training.',
                        'link' => 'https://youtube.com/confidencecoach'
                    ]
                ],
                'game' => [
                    'title' => 'Body Language Quiz',
                    'description' => 'Test your knowledge of body language signals and what they mean in different contexts.',
                    'page' => 'games/body-language-game.php'
                ]
            ],
            'formal-informal' => [
                'title' => 'Formal And Informal Communication',
                'content' => '
                    <div class="content-box">
                        <h4>Adapting Your Communication Style</h4>
                        <p>Knowing when to use formal or informal communication is crucial for professional success. This path will help you navigate different communication contexts with ease.</p>
                        <ul>
                            <li>Understand the differences between formal and informal communication</li>
                            <li>Learn business communication etiquette</li>
                            <li>Adapt your writing style for different audiences</li>
                            <li>Navigate professional networking situations</li>
                            <li>Transition between formal and informal contexts</li>
                        </ul>
                    </div>
                ',
                'videos' => [
                    ['id' => 'ABC123XYZ', 'title' => 'Formal vs Informal Communication', 'thumbnail' => 'https://img.youtube.com/vi/u_0lySVFOrY/maxresdefault.jpg'],
                    ['id' => 'DEF456UVW', 'title' => 'Business Communication Etiquette', 'thumbnail' => 'https://img.youtube.com/vi/poJgO0FseRw/maxresdefault.jpg'],
                    ['id' => 'GHI789RST', 'title' => 'Adapting Your Communication Style', 'thumbnail' => 'https://img.youtube.com/vi/2eZ8TU5-Vjk/maxresdefault.jpg']
                ],
                'channels' => [
                    [
                        'name' => 'Professional Communication', 
                        'desc' => 'Master business writing, emails, and professional speaking skills.',
                        'link' => 'https://youtube.com/professionalcomm'
                    ],
                    [
                        'name' => 'Business Etiquette', 
                        'desc' => 'Learn workplace communication norms and professional protocols.',
                        'link' => 'https://youtube.com/businessetiquette'
                    ],
                    [
                        'name' => 'Language Matters', 
                        'desc' => 'Adapt your communication style for different situations and audiences.',
                        'link' => 'https://youtube.com/languagematters'
                    ]
                ],
                'game' => [
                    'title' => 'Formal or Informal Challenge',
                    'description' => 'Test your ability to identify when to use formal vs informal communication in different scenarios.',
                    'page' => 'games/formal-informal-game.php'
                ]
            ],
            'mock-interview' => [
                'title' => 'Practicing Mock Interview',
                'content' => '
                    <div class="content-box">
                        <h4>Ace Your Next Interview</h4>
                        <p>Interview skills can be learned and perfected. This path provides comprehensive training to help you excel in any interview situation.</p>
                        <ul>
                            <li>Prepare answers to common interview questions</li>
                            <li>Develop your personal success stories</li>
                            <li>Master behavioral interview techniques</li>
                            <li>Handle stress and difficult questions</li>
                            <li>Follow up effectively after interviews</li>
                        </ul>
                    </div>
                ',
                'videos' => [
                    ['id' => 'JKL012MNO', 'title' => 'Common Interview Questions', 'thumbnail' => 'https://img.youtube.com/vi/u_0lySVFOrY/maxresdefault.jpg'],
                    ['id' => 'PQR345STU', 'title' => 'Behavioral Interview Techniques', 'thumbnail' => 'https://img.youtube.com/vi/poJgO0FseRw/maxresdefault.jpg'],
                    ['id' => 'VWX678YZA', 'title' => 'Interview Body Language', 'thumbnail' => 'https://img.youtube.com/vi/2eZ8TU5-Vjk/maxresdefault.jpg']
                ],
                'channels' => [
                    [
                        'name' => 'Career Coach', 
                        'desc' => 'Interview preparation tips and strategies from industry professionals.',
                        'link' => 'https://youtube.com/careercoach'
                    ],
                    [
                        'name' => 'HR Insider', 
                        'desc' => 'Learn what recruiters really look for during interviews.',
                        'link' => 'https://youtube.com/hrinsider'
                    ],
                    [
                        'name' => 'Interview Pro', 
                        'desc' => 'Master interview skills with practice questions and feedback.',
                        'link' => 'https://youtube.com/interviewpro'
                    ]
                ],
                'game' => [
                    'title' => 'Interview Simulator',
                    'description' => 'Practice answering common interview questions with our AI-powered simulator that provides real-time feedback.',
                    'page' => 'games/mock-interview-game.php'
                ]
            ]
        ];
        
        if (isset($topics[$topic])) {
            $currentTopic = $topics[$topic];
            ?>
            <div class="learning-container">
            <div class="topic-header">
                <h3><?php echo $currentTopic['title']; ?></h3>
            </div>
            
            <?php echo $currentTopic['content']; ?>
            
            <h4 class="section-title">Recommended Videos</h4>
            <div class="video-container">
                <?php foreach ($currentTopic['videos'] as $video): ?>
                <div class="video-item" data-video-id="<?php echo $video['id']; ?>">
                    <div class="video-thumbnail">
                        <img src="<?php echo $video['thumbnail']; ?>" alt="<?php echo $video['title']; ?>">
                        <div class="play-button"></div>
                    </div>
                    <p><?php echo $video['title']; ?></p>
                </div>
                <?php endforeach; ?>
            </div>
            
            <h4 class="section-title">Recommended Channels</h4>
            <div class="channel-list">
                <?php foreach ($currentTopic['channels'] as $channel): ?>
                <div class="channel-card">
                    <div class="channel-header">
                        <h3><?php echo $channel['name']; ?></h3>
                    </div>
                    <div class="channel-body">
                        <p><?php echo $channel['desc']; ?></p>
                    </div>
                    <div class="channel-footer">
                        <a href="<?php echo $channel['link']; ?>" class="channel-link" target="_blank">
                            <i class="fas fa-external-link-alt"></i> Visit Channel
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            
            <?php if (isset($currentTopic['game'])): ?>
            <div class="game-card">
                <h3><?php echo $currentTopic['game']['title']; ?></h3>
                <p><?php echo $currentTopic['game']['description']; ?></p>
                <a href="<?php echo $currentTopic['game']['page']; ?>" class="btn-game"><i class="fa fa-gamepad" aria-hidden="true" style="padding-right:15px;"></i>Start the Game</a>
            </div>
            <?php endif; ?>
            <?php
        } else {
            echo '<div class="topic-content"><p>Topic not found.</p></div>';
        }
    } else {
        ?>
        </div>
        <section class="page-header">
            <h1>Learning Paths</h1>
            <p>Personalized learning experiences designed for your professional growth and skill development</p>
        </section>
        <div class="learning-container">
        <section class="learning-paths">
            <div class="learning-tabs">
                <button class="tab-btn active" data-target="communication">Communication</button>
                <button class="tab-btn" data-target="mindset">Mindset & Attitude</button>
                <button class="tab-btn" data-target="technical">Technical Skills</button>
            </div>
            
            <div class="tab-content active" id="communication">
                <div class="path-cards">
                    <div class="path-card">
                        <div class="path-image">
                            <img src="../image/verbal-1.jpeg" alt="Communication Skills">
                        </div>
                        <div class="path-content">
                            <h3>Verbal / Non-Verbal</h3>
                            <div class="path-meta">
                                <span><i class="fas fa-clock"></i> 6 weeks</span>
                                <span><i class="fas fa-signal"></i> Beginner</span>
                                <span><i class="fas fa-certificate"></i> Certificate</span>
                            </div>
                            <p>Improve verbal and written communication skills to enhance professional and personal interactions.</p>
                            <div class="path-progress">
                                <div class="progress-bar">
                                    <div class="progress" style="width: 0%"></div>
                                </div>
                                <span>Not started</span>
                            </div>
                            <a href="?topic=verbal" class="btn-primary">Start Learning</a>
                        </div>
                    </div>
                    
                    <div class="path-card">
                        <div class="path-image">
                            <img src="../image/body_1.jpeg" alt="Body Language">
                        </div>
                        <div class="path-content">
                            <h3>Body Language and Eye Contact</h3>
                            <div class="path-meta">
                                <span><i class="fas fa-clock"></i> 4 weeks</span>
                                <span><i class="fas fa-signal"></i> Beginner</span>
                                <span><i class="fas fa-certificate"></i> Certificate</span>
                            </div>
                            <p>Master the art of body language and eye contact to improve your interpersonal communication.</p>
                            <div class="path-progress">
                                <div class="progress-bar">
                                    <div class="progress" style="width: 0%"></div>
                                </div>
                                <span>Not started</span>
                            </div>
                            <a href="?topic=body-language" class="btn-primary">Start Learning</a>
                        </div>
                    </div>
                    
                    <div class="path-card">
                        <div class="path-image">
                            <img src="../image/Informal-Communication.png" alt="Formal Communication">
                        </div>
                        <div class="path-content">
                            <h3>Formal/Informal Communication</h3>
                            <div class="path-meta">
                                <span><i class="fas fa-clock"></i> 5 weeks</span>
                                <span><i class="fas fa-signal"></i> Beginner</span>
                                <span><i class="fas fa-certificate"></i> Certificate</span>
                            </div>
                            <p>Learn when to use formal vs informal communication in professional and social contexts.</p>
                            <div class="path-progress">
                                <div class="progress-bar">
                                    <div class="progress" style="width: 0%"></div>
                                </div>
                                <span>Not started</span>
                            </div>
                            <a href="?topic=formal-informal" class="btn-primary">Start Learning</a>
                        </div>
                    </div>
                    
                    <div class="path-card">
                        <div class="path-image">
                            <img src="../image/mock_interview.jpg" alt="Mock Interview">
                        </div>
                        <div class="path-content">
                            <h3>Practicing Mock Interview</h3>
                            <div class="path-meta">
                                <span><i class="fas fa-clock"></i> 6 weeks</span>
                                <span><i class="fas fa-signal"></i> Intermediate</span>
                                <span><i class="fas fa-certificate"></i> Certificate</span>
                            </div>
                            <p>Prepare for job interviews with realistic practice scenarios and expert feedback.</p>
                            <div class="path-progress">
                                <div class="progress-bar">
                                    <div class="progress" style="width: 0%"></div>
                                </div>
                                <span>Not started</span>
                            </div>
                            <a href="?topic=mock-interview" class="btn-primary">Start Learning</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-content" id="mindset">
                <div class="path-cards">
                    <div class="path-card">
                        <div class="path-image">
                            <img src="https://images.unsplash.com/photo-1557426272-fc759fdf7a8d" alt="Aptitude Skills">
                        </div>
                        <div class="path-content">
                            <h3>Aptitude Mastery</h3>
                            <div class="path-meta">
                                <span><i class="fas fa-clock"></i> 8 weeks</span>
                                <span><i class="fas fa-signal"></i> Intermediate</span>
                                <span><i class="fas fa-certificate"></i> Certificate</span>
                            </div>
                            <p>Enhance problem-solving and logical reasoning skills to excel in competitive exams and job assessments.</p>
                            <div class="path-progress">
                                <div class="progress-bar">
                                    <div class="progress" style="width: 0%"></div>
                                </div>
                                <span>Not started</span>
                            </div>
                            <a href="#" class="btn-primary">Start Learning</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-content" id="technical">
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
                            <a href="#" class="btn-primary">Start Learning</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        </div>
        <?php
    }
    ?>

<script>
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
            
            btn.classList.add('active');
            
            const target = btn.getAttribute('data-target');
            document.getElementById(target).classList.add('active');
        });
    });

    const videoPopup = document.getElementById('videoPopup');
    const popupVideoFrame = document.getElementById('popupVideoFrame');
    const closePopup = document.getElementById('closePopup');
    let videoCompleted = false;
    let videoDuration = 0;
    let currentVideoId = '';
    let progressInterval;

    document.querySelectorAll('.video-item').forEach(item => {
        item.addEventListener('click', function() {
            const videoId = this.getAttribute('data-video-id');
            currentVideoId = videoId;
            videoCompleted = false;
            
            popupVideoFrame.src = `https://www.youtube.com/embed/${videoId}?autoplay=1&enablejsapi=1`;
            videoPopup.classList.add('active');
            
            startProgressTracking();
        });
    });

    closePopup.addEventListener('click', function(e) {
        e.preventDefault();
        
        if (!videoCompleted) {
            if (confirm('You need to complete the video before closing. Are you sure you want to exit?')) {
                closeVideoPopup();
            }
        } else {
            closeVideoPopup();
        }
    });

    videoPopup.addEventListener('click', function(e) {
        if (e.target === videoPopup) {
            if (!videoCompleted) {
                if (confirm('You need to complete the video before closing. Are you sure you want to exit?')) {
                    closeVideoPopup();
                }
            } else {
                closeVideoPopup();
            }
        }
    });

    function closeVideoPopup() {
        videoPopup.classList.remove('active');
        popupVideoFrame.src = '';
        clearInterval(progressInterval);
    }

    function startProgressTracking() {
        videoCompleted = false;
        let progress = 0;
        const checkDuration = 1000;
        
        videoDuration = 180;
        
        progressInterval = setInterval(() => {
            progress += 1;
            
            if (progress >= videoDuration) {
                videoCompleted = true;
                clearInterval(progressInterval);
            }
        }, checkDuration);
    }
</script>

<?php include 'footer.php'; ?>