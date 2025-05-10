<?php
session_start();

// Speech samples for users to read
$speech_samples = [
    "The ability to communicate effectively is the most important skill in today's world. Whether you're presenting to an audience or speaking one-on-one, clarity and confidence make all the difference.",
    "Public speaking is not about perfection, it's about connection. The best speakers make their audience feel something, think something, or do something.",
    "In this digital age, your voice matters more than ever. The way you deliver your message can inspire action, build trust, and create lasting impressions.",
    "The human voice is the most powerful sound in the world. It's the only sound that can start a war or say 'I love you.' Use yours wisely and effectively.",
    "Great communicators don't just speak clearly, they listen actively. Communication is a two-way street that requires both transmission and reception."
];

// Feedback templates for different aspects
$feedback_templates = [
    'pacing' => [
        'too_fast' => "Your pacing was too fast (over 180 words per minute). Try slowing down by 20% to improve comprehension.",
        'too_slow' => "Your delivery was too slow (under 120 words per minute). Aim for a more natural conversational pace (140-160 wpm).",
        'good' => "Excellent pacing! You maintained an ideal speed of 140-160 words per minute.",
        'inconsistent' => "Your pacing varied significantly (from %d to %d wpm). Try to maintain a steady rhythm."
    ],
    'clarity' => [
        'excellent' => "Crystal clear articulation! 95% of your words were easily understood.",
        'good' => "Good clarity overall - 85% of words were clear, with just a few mumbled sections.",
        'needs_work' => "Some words were unclear (only %d%% clarity). Practice enunciating consonants more distinctly."
    ],
    'tone' => [
        'monotone' => "Your tone was somewhat monotone (only %d%% pitch variation). Try varying your pitch for emphasis.",
        'expressive' => "Great vocal variety! You used %d distinct pitch levels effectively.",
        'flat' => "Your tone lacked energy (only %d%% intensity variation). Try projecting more enthusiasm."
    ],
    'pitch' => [
        'high' => "Your average pitch was high (%dHz). Try speaking from your diaphragm for a fuller sound.",
        'low' => "Your average pitch was low (%dHz). Consider raising it slightly for better projection.",
        'varied' => "Excellent pitch variation! You ranged from %dHz to %dHz effectively."
    ],
    'pauses' => [
        'good' => "Effective use of %d pauses (averaging %.1f seconds each) for emphasis and comprehension.",
        'few' => "You only used %d pauses. Could benefit from %d more strategic pauses to let points sink in.",
        'many' => "Too many pauses (%d total) disrupted your flow. Work on smoother transitions between ideas."
    ]
];

// Get or set current sample
if (!isset($_SESSION['current_sample'])) {
    $_SESSION['current_sample'] = $speech_samples[array_rand($speech_samples)];
}

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['audio_data'])) {
        // In a real implementation, you would save the audio file here
        $audio_data = $_POST['audio_data'];
        $filename = 'recordings/recording_'.time().'.wav';
        file_put_contents($filename, base64_decode($audio_data));
        
        // Simulate analysis with realistic metrics
        $word_count = str_word_count($_SESSION['current_sample']);
        $sample_duration = rand(45, 75); // seconds
        $wpm = round(($word_count / $sample_duration) * 60);
        
        $analysis_results = [
            'pacing' => [
                'result' => $wpm > 180 ? 'too_fast' : ($wpm < 120 ? 'too_slow' : ($wpm > 170 || $wpm < 130 ? 'inconsistent' : 'good')),
                'wpm' => $wpm,
                'duration' => $sample_duration
            ],
            'clarity' => [
                'result' => ['excellent', 'good', 'needs_work'][rand(0, 2)],
                'score' => rand(70, 98)
            ],
            'tone' => [
                'result' => ['monotone', 'expressive', 'flat'][rand(0, 2)],
                'variation' => rand(20, 90),
                'levels' => rand(3, 8)
            ],
            'pitch' => [
                'result' => ['high', 'low', 'varied'][rand(0, 2)],
                'avg' => rand(80, 300),
                'min' => rand(75, 150),
                'max' => rand(200, 400)
            ],
            'pauses' => [
                'result' => ['good', 'few', 'many'][rand(0, 2)],
                'count' => rand(3, 15),
                'avg_duration' => round(rand(5, 25) / 10, 1)
            ],
            'recording' => $filename
        ];
        
        $_SESSION['analysis_results'] = $analysis_results;
        $_SESSION['attempts'] = ($_SESSION['attempts'] ?? 0) + 1;
        
        // Return JSON response for AJAX call
        header('Content-Type: application/json');
        echo json_encode(['status' => 'success', 'message' => 'Analysis complete']);
        exit;
    } elseif (isset($_POST['new_sample'])) {
        $_SESSION['current_sample'] = $speech_samples[array_rand($speech_samples)];
        unset($_SESSION['analysis_results']);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Speech Delivery Analysis</title>
    <style>
        :root {
            --primary: #3a86ff;
            --secondary: #8338ec;
            --accent: #ff006e;
            --light: #f8f9fa;
            --dark: #212529;
            --success: #06d6a0;
            --warning: #ffbe0b;
            --danger: #ef476f;
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
        
        h1 {
            color: var(--primary);
            text-align: center;
            margin-bottom: 1.5rem;
        }
        
        .speech-sample {
            background: #e9ecef;
            padding: 1.5rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            border-left: 5px solid var(--accent);
            font-size: 1.1rem;
            line-height: 1.6;
        }
        
        .recording-section {
            background: #e6f2ff;
            padding: 1.5rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            text-align: center;
        }
        
        .mic-icon {
            font-size: 3rem;
            color: var(--accent);
            margin-bottom: 1rem;
        }
        
        button {
            background: var(--primary);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            transition: all 0.3s;
            margin: 10px 5px;
        }
        
        button:hover {
            background: var(--secondary);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .analysis-results {
            margin-top: 2rem;
        }
        
        .metric {
            margin-bottom: 1rem;
            padding: 1rem;
            border-radius: 8px;
            background: #f8f9fa;
        }
        
        .metric-title {
            font-weight: bold;
            margin-bottom: 0.5rem;
            color: var(--primary);
        }
        
        .good { color: var(--success); }
        .fair { color: var(--warning); }
        .poor { color: var(--danger); }
        
        .progress-container {
            width: 100%;
            background-color: #e0e0e0;
            border-radius: 5px;
            margin: 10px 0;
        }
        
        .progress-bar {
            height: 10px;
            border-radius: 5px;
            background-color: var(--primary);
        }
        
        .attempt-counter {
            text-align: right;
            font-style: italic;
            color: #6c757d;
        }
        
        #recordButton {
            background: var(--accent);
        }
        
        #stopButton {
            background: var(--danger);
            display: none;
        }
        
        #audioVisualizer {
            width: 100%;
            height: 100px;
            background: #f0f0f0;
            margin: 15px 0;
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
        <h1>Speech Delivery Analysis</h1>
        
        <?php if (isset($_SESSION['attempts']) && $_SESSION['attempts'] > 0): ?>
            <div class="attempt-counter">Attempt #<?= $_SESSION['attempts'] ?></div>
        <?php endif; ?>
        
        <div class="speech-sample">
            <h3>Read this aloud:</h3>
            <p><?= htmlspecialchars($_SESSION['current_sample']) ?></p>
            <p><small>Word count: <?= str_word_count($_SESSION['current_sample']) ?> words</small></p>
        </div>
        
        <?php if (!isset($_SESSION['analysis_results'])): ?>
            <div class="recording-section">
                <div class="mic-icon">🎤</div>
                <p>Click the button below to record your speech.</p>
                <div id="audioVisualizer"></div>
                <button id="recordButton">Start Recording</button>
                <button id="stopButton" disabled>Stop Recording</button>
                <button id="analyzeButton" style="display:none;">Analyze Recording</button>
                <div id="statusMessage"></div>
                <audio id="audioPlayback" controls style="display:none; width:100%; margin-top:15px;"></audio>
            </div>
            
            <script>
                let mediaRecorder;
                let audioChunks = [];
                const recordButton = document.getElementById('recordButton');
                const stopButton = document.getElementById('stopButton');
                const analyzeButton = document.getElementById('analyzeButton');
                const audioPlayback = document.getElementById('audioPlayback');
                const statusMessage = document.getElementById('statusMessage');
                const visualizer = document.getElementById('audioVisualizer');
                let audioContext;
                let analyser;
                let dataArray;
                let animationId;
                
                // Set up audio visualization
                function setupVisualizer(stream) {
                    audioContext = new (window.AudioContext || window.webkitAudioContext)();
                    analyser = audioContext.createAnalyser();
                    const source = audioContext.createMediaStreamSource(stream);
                    source.connect(analyser);
                    analyser.fftSize = 256;
                    
                    const bufferLength = analyser.frequencyBinCount;
                    dataArray = new Uint8Array(bufferLength);
                    
                    function draw() {
                        animationId = requestAnimationFrame(draw);
                        analyser.getByteFrequencyData(dataArray);
                        
                        // Clear canvas
                        visualizer.innerHTML = '';
                        const canvas = document.createElement('canvas');
                        canvas.width = visualizer.offsetWidth;
                        canvas.height = visualizer.offsetHeight;
                        visualizer.appendChild(canvas);
                        const ctx = canvas.getContext('2d');
                        
                        // Draw waveform
                        ctx.fillStyle = 'rgb(200, 200, 200)';
                        ctx.fillRect(0, 0, canvas.width, canvas.height);
                        
                        const barWidth = (canvas.width / bufferLength) * 2.5;
                        let x = 0;
                        
                        for(let i = 0; i < bufferLength; i++) {
                            const barHeight = dataArray[i] / 2;
                            ctx.fillStyle = `rgb(58, 134, 255, ${barHeight/100})`;
                            ctx.fillRect(x, canvas.height - barHeight, barWidth, barHeight);
                            x += barWidth + 1;
                        }
                    }
                    
                    draw();
                }
                
                recordButton.addEventListener('click', async () => {
                    try {
                        const stream = await navigator.mediaDevices.getUserMedia({ audio: true });
                        mediaRecorder = new MediaRecorder(stream);
                        setupVisualizer(stream);
                        
                        mediaRecorder.ondataavailable = event => {
                            audioChunks.push(event.data);
                        };
                        
                        mediaRecorder.onstop = () => {
                            const audioBlob = new Blob(audioChunks, { type: 'audio/wav' });
                            const audioUrl = URL.createObjectURL(audioBlob);
                            audioPlayback.src = audioUrl;
                            audioPlayback.style.display = 'block';
                            analyzeButton.style.display = 'inline-block';
                            statusMessage.textContent = 'Recording complete. Click "Analyze Recording" to get feedback.';
                            
                            // Stop visualization
                            cancelAnimationFrame(animationId);
                            visualizer.innerHTML = '';
                        };
                        
                        mediaRecorder.start();
                        recordButton.style.display = 'none';
                        stopButton.style.display = 'inline-block';
                        statusMessage.textContent = 'Recording... Speak clearly into your microphone.';
                        statusMessage.style.color = 'var(--accent)';
                    } catch (err) {
                        console.error('Error:', err);
                        statusMessage.textContent = 'Error accessing microphone: ' + err.message;
                        statusMessage.style.color = 'var(--danger)';
                    }
                });
                
                stopButton.addEventListener('click', () => {
                    mediaRecorder.stop();
                    stopButton.style.display = 'none';
                    statusMessage.textContent = 'Processing your recording...';
                    
                    // Stop all tracks
                    mediaRecorder.stream.getTracks().forEach(track => track.stop());
                });
                
                analyzeButton.addEventListener('click', () => {
                    statusMessage.textContent = 'Analyzing your speech... This may take a moment.';
                    statusMessage.style.color = 'var(--primary)';
                    
                    // Convert audio to base64 for submission
                    const reader = new FileReader();
                    reader.onloadend = function() {
                        const base64data = reader.result.split(',')[1];
                        
                        // Submit to server for analysis
                        fetch(window.location.href, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: 'audio_data=' + encodeURIComponent(base64data)
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'success') {
                                // Reload to show results
                                window.location.reload();
                            } else {
                                statusMessage.textContent = 'Analysis failed. Please try again.';
                                statusMessage.style.color = 'var(--danger)';
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            statusMessage.textContent = 'Error during analysis. Please try again.';
                            statusMessage.style.color = 'var(--danger)';
                        });
                    };
                    
                    const audioBlob = new Blob(audioChunks, { type: 'audio/wav' });
                    reader.readAsDataURL(audioBlob);
                });
            </script>
        <?php else: ?>
            <div class="analysis-results">
                <h2>Your Analysis Results</h2>
                <p>You read: <em>"<?= htmlspecialchars(substr($_SESSION['current_sample'], 0, 50)) ?>..."</em></p>
                
                <?php 
                $metrics = ['pacing', 'clarity', 'tone', 'pitch', 'pauses'];
                foreach ($metrics as $metric) { 
                    $result = $_SESSION['analysis_results'][$metric]['result'];
                    $feedback = $feedback_templates[$metric][$result];
                    $data = $_SESSION['analysis_results'][$metric];
                    
                    // Format feedback with actual metrics
                    switch($metric) {
                        case 'pacing':
                            $feedback = sprintf($feedback, $data['wpm'], $data['duration']);
                            break;
                        case 'clarity':
                            $feedback = sprintf($feedback, $data['score']);
                            break;
                        case 'tone':
                            $feedback = sprintf($feedback, $data['variation'], $data['levels']);
                            break;
                        case 'pitch':
                            $feedback = sprintf($feedback, $data['avg'], $data['min'], $data['max']);
                            break;
                        case 'pauses':
                            $feedback = sprintf($feedback, $data['count'], $data['avg_duration'], round($data['count']*1.5));
                            break;
                    }
                    
                    $rating_class = 
                        strpos($feedback, 'Excellent') !== false || strpos($feedback, 'Great') !== false ? 'good' :
                        (strpos($feedback, 'needs work') !== false || strpos($feedback, 'lacked') !== false ? 'poor' : 'fair');
                ?>
                <div class="metric">
                    <div class="metric-title"><?= ucfirst($metric) ?>:</div>
                    <div class="<?= $rating_class ?>"><?= $feedback ?></div>
                    <div class="progress-container">
                        <div class="progress-bar" style="width: <?= 
                            $rating_class === 'good' ? '90%' : 
                            ($rating_class === 'fair' ? '60%' : '30%') 
                        ?>"></div>
                    </div>
                </div>
                <?php } ?>
                
                <div class="metric">
                    <div class="metric-title">Overall Score:</div>
                    <?php
                    // Calculate overall score
                    $score = 0;
                    foreach ($metrics as $metric) {
                        $result = $_SESSION['analysis_results'][$metric]['result'];
                        if (strpos($feedback_templates[$metric][$result], 'Excellent') !== false || 
                            strpos($feedback_templates[$metric][$result], 'Great') !== false) {
                            $score += 20;
                        } elseif (strpos($feedback_templates[$metric][$result], 'needs work') !== false || 
                                 strpos($feedback_templates[$metric][$result], 'lacked') !== false) {
                            $score += 5;
                        } else {
                            $score += 10;
                        }
                    }
                    ?>
                    <div class="<?= $score > 75 ? 'good' : ($score > 50 ? 'fair' : 'poor') ?>">
                        <?= $score ?> / 100 - 
                        <?= $score > 75 ? 'Excellent delivery!' : 
                           ($score > 50 ? 'Good effort, with room for improvement' : 'Needs significant improvement') ?>
                    </div>
                    <div class="progress-container">
                        <div class="progress-bar" style="width: <?= $score ?>%"></div>
                    </div>
                </div>
                
                <div class="metric">
                    <div class="metric-title">Your Recording:</div>
                    <audio controls src="<?= $_SESSION['analysis_results']['recording'] ?>" style="width:100%"></audio>
                </div>
                
                <form method="post" style="text-align: center; margin-top: 2rem;">
                    <button type="submit" name="new_sample">Try Another Sample</button>
                    <button type="button" onclick="window.location.reload()">Try Again</button>
                </form>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>