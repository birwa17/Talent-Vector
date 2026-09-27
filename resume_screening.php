<?php
include("config.php");

// Function to extract text from PDF/DOCX files
function extract_text_from_resume($filePath, $fileType) {
    if ($fileType === "pdf") {
        $pdfToTextPath = "C:\\xampp\\htdocs\\talentvector\\pdftotext.exe";
        if (!file_exists($pdfToTextPath)) {
            die("Error: pdftotext.exe not found!");
        }
        return shell_exec("$pdfToTextPath " . escapeshellarg($filePath) . " -");
    } elseif ($fileType === "docx") {
        require 'vendor/autoload.php';
        $phpWord = \PhpOffice\PhpWord\IOFactory::load($filePath);
        $text = "";
        foreach ($phpWord->getSections() as $section) {
            foreach ($section->getElements() as $element) {
                if ($element instanceof \PhpOffice\PhpWord\Element\Text) {
                    $text .= $element->getText() . " ";
                } elseif ($element instanceof \PhpOffice\PhpWord\Element\TextRun) {
                    foreach ($element->getElements() as $textElement) {
                        if ($textElement instanceof \PhpOffice\PhpWord\Element\Text) {
                            $text .= $textElement->getText() . " ";
                        }
                    }
                }    
            }
        }
        return $text;
    }
    return "";
}

// Handle resume upload
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $phone = trim($_POST["phone"]);
    $skills = trim($_POST["skills"]);

    $targetDir = "uploads/";
    $fileName = basename($_FILES["resume"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    // Validate file type
    if (in_array(strtolower($fileType), ["pdf", "docx"])) {
        if (move_uploaded_file($_FILES["resume"]["tmp_name"], $targetFilePath)) {
            // Save to database
            $sql = "INSERT INTO resumes (name, email, phone, skills, filename) 
                    VALUES ('$name', '$email', '$phone', '$skills', '$fileName')";
            if ($conn->query($sql) !== TRUE) {
                die("Database Error: " . $conn->error);
            }
        } else {
            die("Error: File upload failed.");
        }
    } else {
        die("Error: Only PDF or DOCX files are allowed.");
    }
}

// Fetch the latest uploaded resume
$sql = "SELECT * FROM resumes ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);
$resume = $result->fetch_assoc();

if (!$resume) {
    die("Error: No resume found!");
}

$filePath = "uploads/" . $resume['filename'];
$fileType = pathinfo($filePath, PATHINFO_EXTENSION);
$resumeText = extract_text_from_resume($filePath, $fileType);

// Convert job skills to lowercase and remove spaces
$jobSkills = array_map(fn($skill) => trim(strtolower($skill)), explode(",", $resume['skills']));

// Clean and split resume text into words
$resumeWords = array_map('strtolower', explode(" ", preg_replace('/[^a-zA-Z0-9\s]/', '', $resumeText)));

$matchedSkills = [];
foreach ($jobSkills as $skill) {
    $skillParts = explode(" ", $skill); // Break skills into words
    foreach ($skillParts as $part) {
        if (in_array($part, $resumeWords)) {
            $matchedSkills[] = $part;
        }
    }
}
$matchedSkills = array_unique($matchedSkills); // Remove duplicates

// Calculate Matching Percentage
$matchPercentage = (!empty($jobSkills)) ? round((count($matchedSkills) / count($jobSkills)) * 100, 2) : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume Screening</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="shortcut icon" href="pics/logotrans.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
</head>
<body>
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
        padding: 0;
        background: linear-gradient(to right, #f7e8ff, #e1f0ff);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    .container {
        width: 100%;
        max-width: 500px;
        background: #fff;
        padding: 40px 30px;
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        margin: 20px;
        text-align: center;
    }

    h2, h3, h4 {
        color: #333;
        margin-bottom: 15px;
    }

    label {
        display: block;
        font-weight: 600;
        margin: 12px 0 5px;
        color: #444;
        text-align: left;
    }

    input, textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 12px;
        border-radius: 8px;
        border: 1px solid #ccc;
        font-size: 15px;
        box-sizing: border-box;
    }

    button {
        width: 100%;
        background-color: #e6c6ee;
        color: black;
        font-weight: bold;
        padding: 12px;
        border-radius: 10px;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s ease;
        font-size: 16px;
    }

    button:hover {
        color: plum;
    }

    canvas {
        margin-top: 20px;
    }

    p {
        color: #555;
        font-size: 14px;
    }

    .matched-skills {
        background: #f3e5f5;
        padding: 12px;
        border-left: 5px solid #ba68c8;
        border-radius: 8px;
        font-size: 14px;
        margin-top: 15px;
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

<body>
<button onclick="scrollToTop()" id="goTopBtn" title="Go to Top">
    <i class="fas fa-rocket"></i>
  </button>
    <div class="container">
        <h2>Upload Your Resume</h2>
        <form action="resume_screening.php" method="POST" enctype="multipart/form-data">
            <label for="name">Full Name:</label>
            <input type="text" name="name" required>

            <label for="email">Email:</label>
            <input type="email" name="email" required>

            <label for="phone">Phone Number:</label>
            <input type="text" name="phone" required>

            <label for="skills">Skills (comma-separated):</label>
            <input type="text" name="skills" required>

            <label for="resume">Upload Resume (PDF or DOCX):</label>
            <input type="file" name="resume" accept=".pdf,.docx" required>

            <button type="submit">Upload & Check ATS Score</button>
        </form>
    </div>

    <div class="container">
        <h2>ATS Resume Screening</h2>
        <p><strong>Candidate:</strong> <?php echo htmlspecialchars($resume['name']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($resume['email']); ?></p>
        <p><strong>Phone:</strong> <?php echo htmlspecialchars($resume['phone']); ?></p>

        <h3>Matching Score: <?php echo $matchPercentage; ?>%</h3>
        <canvas id="matchChart" width="200" height="200"></canvas>

        <h4>Matched Skills:</h4>
        <div class="matched-skills">
            <?php echo (!empty($matchedSkills)) ? implode(", ", $matchedSkills) : "No skills matched"; ?>
        </div>
    </div>

    <script>
        let matchScore = <?php echo $matchPercentage; ?>;
        let remainingScore = 100 - matchScore;

        const ctx = document.getElementById("matchChart").getContext("2d");
        new Chart(ctx, {
            type: "pie",
            data: {
                labels: ["Matched Skills", "Unmatched Skills"],
                datasets: [{
                    data: [matchScore, remainingScore],
                    backgroundColor: ["#36A2EB", "#FF6384"]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    </script>
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