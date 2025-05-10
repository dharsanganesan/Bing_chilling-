<?php
// db.php - Database Connection
$host = 'localhost';
$db = 'aptitude_game';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!-- game.php - Main Aptitude Quiz Game -->
<?php
include '../backend/connection.php';

$qid = isset($_GET['qid']) ? (int)$_GET['qid'] : 1;
$result = $conn->query("SELECT * FROM questions WHERE id = $qid");
$question = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Aptitude Quiz Game</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background: #f2f2f2;
            font-family: 'Segoe UI', sans-serif;
        }
        .quiz-container {
            max-width: 600px;
            margin: 80px auto;
            background: #fff;
            padding: 40px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 10px;
        }
        .question {
            font-size: 1.2rem;
            margin-bottom: 20px;
        }
        .option {
            padding: 10px;
            background: #e9ecef;
            margin: 10px 0;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }
        .option:hover {
            background: #d4edda;
        }
        .submit-btn {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="quiz-container">
    <h2 class="text-center mb-4">Aptitude Quiz Game</h2>
    <div class="question">
        <?php echo $question['question']; ?>
    </div>
    <form method="post" action="answer.php">
        <input type="hidden" name="qid" value="<?php echo $qid; ?>">
        <?php for ($i = 1; $i <= 4; $i++) {
            echo "<div class='form-check option'>
                    <input class='form-check-input' type='radio' name='answer' value='".$i."' required>
                    <label class='form-check-label'>".$question['option'.$i]."</label>
                  </div>";
        } ?>
        <button type="submit" class="btn btn-success w-100 submit-btn">Submit Answer</button>
    </form>
</div>
</body>
</html>
<?php
include './backend/connection.php';
$qid = $_POST['qid'];
$selected = $_POST['answer'];
$result = $conn->query("SELECT * FROM questions WHERE id = $qid");
$question = $result->fetch_assoc();
$is_correct = ($selected == $question['correct']);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Answer Result</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background: #f2f2f2;
            font-family: 'Segoe UI', sans-serif;
        }
        .result-container {
            max-width: 600px;
            margin: 80px auto;
            background: #fff;
            padding: 40px;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
<div class="result-container">
    <?php if ($is_correct): ?>
        <h3 class="text-success">Correct Answer!</h3>
    <?php else: ?>
        <h3 class="text-danger">Wrong Answer!</h3>
        <p>Correct answer was: <strong><?php echo $question['option'.$question['correct']]; ?></strong></p>
    <?php endif; ?>
    <a href="game.php?qid=<?php echo $qid + 1; ?>" class="btn btn-primary mt-4">Next Question</a>
</div>
</body>
</html>
