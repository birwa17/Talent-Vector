<?php
session_start();
require_once 'pdf2text.php';

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    unset($_SESSION["quiz_questions"]);
    unset($_SESSION["summary"]);
}

$conn = new mysqli("localhost", "root", "", "talent_vector");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["resume"])) {
    $file_name = $_FILES["resume"]["name"];
    $file_tmp = $_FILES["resume"]["tmp_name"];
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    if ($file_ext !== "pdf") {
        echo "<p class='error-message'>Only PDF files are allowed!</p>";
        exit();
    }

    $resume_content = pdf2text($file_tmp);

    $skills = extractSkills($resume_content);
    $questions_with_answers = generateQuestions($skills);
    $summary = generateSummary($resume_content, $skills);

    shuffle($questions_with_answers);
    $questions_with_answers = array_slice($questions_with_answers, 0, 10);

    $_SESSION["summary"] = $summary;
    $_SESSION["quiz_questions"] = $questions_with_answers;

    // Save to database (resume_file table)
    $stmt = $conn->prepare("INSERT INTO resume_file (file_name, summary) VALUES (?, ?)");
    $stmt->bind_param("ss", $file_name, $summary);
    $stmt->execute();
    $resume_id = $stmt->insert_id;
    $stmt->close();
    
}

function extractSkills($text) {
    $common_skills = ["Java", "Python", "SQL", "JavaScript", "C++", "HTML", "CSS", "React", "PHP", "Machine Learning", "Node.js", "Docker", "AWS", "Kubernetes", "Django", "Flask", "Laravel"];
    $found_skills = [];
    foreach ($common_skills as $skill) {
        if (stripos($text, $skill) !== false) {
            $found_skills[] = $skill;
        }
    }
    return $found_skills;
}

function generateQuestions($skills) {
    $qa = [];
    foreach ($skills as $skill) {
        $qa[] = ["question" => "What are the key principles of $skill?", "answer" => "Key principles of $skill include writing clean, modular code, understanding core concepts, and following best practices like SOLID principles or OOP (depending on the skill)."];
        $qa[] = ["question" => "How do you debug issues in $skill?", "answer" => "Debugging in $skill involves checking logs, using print statements or debuggers, reviewing code step-by-step, and identifying common error patterns."];
        $qa[] = ["question" => "Explain a real-world project where you used $skill.", "answer" => "I used $skill in a project where I built a scalable application. I handled tasks like API integration, backend logic, and deployment using modern tools."];
        $qa[] = ["question" => "What are common mistakes to avoid in $skill?", "answer" => "Common mistakes include poor error handling, ignoring edge cases, not optimizing performance, and failing to write clean, maintainable code."];
        $qa[] = ["question" => "What libraries or frameworks complement $skill?", "answer" => "$skill is often used with frameworks or libraries like Laravel for PHP, NumPy for Python, or React for JavaScript, depending on the language."];
        $qa[] = ["question" => "How would you optimize code written using $skill?", "answer" => "Optimizing $skill code involves reducing time/space complexity, using efficient data structures, and following DRY/KISS principles."];
    }
    return $qa;
}

function generateSummary($text, $skills) {
    if (empty($skills)) {
        return "No major technical skills were detected in the uploaded resume.";
    }

    $summary = "This resume highlights skills in " . implode(", ", $skills) . ". ";
    $summary .= "The candidate demonstrates experience in modern technologies and programming languages. ";
    $summary .= "Based on the resume content, interview questions were generated for a personalized evaluation.";
    return $summary;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Resume Quiz</title>
    <link rel="shortcut icon" href="pics/logotrans.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
        padding: 0;
        background: linear-gradient(to right, #f7e8ff, #e1f0ff);
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .container {
        width: 100%;
        max-width: 420px;
        background: #fff;
        padding: 40px 30px;
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    h2 {
        margin-bottom: 20px;
        color: #222;
    }

    input[type="file"] {
        display: block;
        margin: 0 auto 8px auto;
    }

    p {
        font-size: 14px;
        color: #666;
        margin-bottom: 20px;
    }

    .upload-btn {
        background-color: #d7a7e3;
        padding: 10px 20px;
        border-radius: 8px;
        border: none;
        color: #fff;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s ease;
        width: 100%;
    }

    .upload-btn:hover {
        background-color: #b073c2;
    }

    .summary, ul {
        text-align: left;
        margin-top: 25px;
    }

    .summary {
        background: #f3e5f5;
        padding: 15px;
        border-left: 5px solid #ba68c8;
        border-radius: 8px;
        font-size: 14px;
    }

    ul {
        list-style: none;
        padding: 0;
    }

    li {
        background: #f9f4fc;
        border-left: 4px solid #d1b3e0;
        padding: 10px 12px;
        margin-bottom: 10px;
        border-radius: 6px;
        font-size: 14px;
    }

    strong {
        color: #444;
    }

    .error-message {
        color: red;
        font-weight: bold;
        margin-top: 10px;
    }
    #goTopBtn {
    position: fixed;
    bottom: 30px;
    right: 30px;
    z-index: 999;
    width: 60px;
    height: 60px;
    background-color: #d1b3e0;
    color: white;
    border: none;
    border-radius: 50%;
    font-size: 22px;
    cursor: pointer;
    display: none;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
    transition: all 0.3s ease-in-out;
    padding: 0;
}

#goTopBtn:hover {
    transform: translateY(-4px) scale(1.05);
    background-color: #b889cc;
}

#goTopBtn i {
    font-size: 24px;
    animation: floatRocket 2s infinite ease-in-out;
    line-height: 60px;
}

@keyframes floatRocket {
    0%, 100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-3px);
    }
}

</style>
</head>
<body>
<button onclick="scrollToTop()" id="goTopBtn" title="Go to Top">
    <i class="fas fa-rocket"></i>
  </button>
    <div class="container">
        <h2>Upload Resume</h2>
        <form action="quiz_question.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="resume" accept=".pdf" required>
            <p style="font-size: 14px; color: gray; margin-top: 5px;">Only PDF files are allowed</p>
            <button type="submit" class="upload-btn">Generate Quiz</button>
        </form>

        <?php if (!empty($_SESSION["summary"])): ?>
            <h3>Resume Summary</h3>
            <div class="summary"><?php echo htmlspecialchars($_SESSION["summary"]); ?></div>
        <?php endif; ?>

        <?php if (!empty($_SESSION["quiz_questions"])): ?>
            <h3>Interview Questions with Answers</h3>
            <ul>
                <?php foreach ($_SESSION["quiz_questions"] as $qa): ?>
                    <li>
                        <strong>Q:</strong> <?php echo htmlspecialchars($qa["question"]); ?><br>
                        <strong>A:</strong> <?php echo htmlspecialchars($qa["answer"]); ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
    <script>
    window.onscroll = function () {
      const btn = document.getElementById("goTopBtn");
      if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
        btn.style.display = "block";
      } else {
        btn.style.display = "none";
      }
    };
  
    function scrollToTop() {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    }
</script>
</body>
</html>