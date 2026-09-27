<?php
// Show all errors (important for debugging!)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$host = "localhost";
$user = "root";
$password = "";
$db = "talent_vector";

$conn = new mysqli($host, $user, $password, $db);
$extra_questions = [];

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    $query = "SELECT question FROM faq_questions ORDER BY id DESC"; // changed from created_at to id
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $extra_questions[] = $row['question'];
        }
    } else {
        echo "<p style='color:red;text-align:center;'>No user questions found.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>FAQ</title>
  <link rel="shortcut icon" href="pics/logotrans.png" type="image/x-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      padding: 0;
      background: linear-gradient(to right, #f5e7f0, #e6e9f8);
    }
    .faq-section {
      padding: 60px 20px;
      max-width: 1000px;
      margin: 0 auto;
      background-color: #ffffff;
      border-radius: 30px;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    }
    .faq-header h1 {
      color: #000000;
      font-size: 36px;
      text-align: center;
      margin-bottom: 40px;
    }
    .faq-content {
      display: flex;
      flex-direction: column;
      gap: 20px;
    }
    .faq-item {
      background: linear-gradient(135deg, #fce3ff, #f8f0ff);
      padding: 20px 25px;
      border-radius: 15px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .faq-item:hover {
      transform: translateY(-3px);
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.08);
    }
    .faq-item h3 {
      font-size: 20px;
      color: #4a045e;
      margin-bottom: 10px;
    }
    .faq-item p {
      font-size: 16px;
      color: #444;
      line-height: 1.6;
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

    @media (max-width: 600px) {
      .faq-header h1 {
        font-size: 28px;
      }
      .faq-item h3 {
        font-size: 18px;
      }
      .faq-item p {
        font-size: 15px;
      }
    }
  </style>
</head>
<body>
<button onclick="scrollToTop()" id="goTopBtn" title="Go to Top">
        <i class="fas fa-rocket"></i>
      </button>

  <section class="faq-section">
    <div class="faq-header">
      <h1>Talent Vector FAQ:</h1>
    </div>
    <div class="faq-content">
      <!-- Static Questions -->
      <div class="faq-item"><h3>What is Talent Vector?</h3><p>Talent Vector is a platform to create, edit, and optimize resumes...</p></div>
      <div class="faq-item"><h3>How does it work?</h3><p>You can upload your resume or create a new one using our templates. The AI optimizes it for ATS systems.</p></div>
            <div class="faq-item"><h3>Is it free to use?</h3><p>Yes, creating and downloading resumes is free. Premium features are also available.</p></div>
            <div class="faq-item"><h3>How can I contact support?</h3><p>You can reach out to our support team via email or phone for assistance.</p></div>
            <div class="faq-item"><h3>What are the benefits of using Talent Vector?</h3><p>Our platform offers professional designs, step-by-step support, and unlimited resumes for job seekers.</p></div>
            <div class="faq-item"><h3>Can I find inspiration in real-world examples?</h3><p>Yes, you can browse popular resume examples covering various jobs, industries, and experience levels.</p></div>
            <div class="faq-item"><h3>How can I get started?</h3><p>Simply click on the "Create my Resume" button to begin creating your resume with Talent Vector.</p></div>
            <div class="faq-item"><h3>How does the resume screening system work?</h3><p>Our AI-powered ATS analyzes your resume, extracts key details, and matches it against job-specific skills.</p></div>
            <div class="faq-item"><h3>What is the AI-driven quiz and question generation feature?</h3><p>We generate interview questions and skill-based quizzes to help job seekers prepare effectively.</p></div>
            <div class="faq-item"><h3>How does the resume score work?</h3><p>Talent Vector assigns a score based on how well your resume aligns with job requirements and ATS best practices.</p></div>
            <div class="faq-item"><h3>Can I edit my resume after uploading?</h3><p>Yes, you can modify and optimize your resume before downloading or applying for jobs.</p></div>
            <div class="faq-item"><h3>Does Talent Vector offer resume templates?</h3><p>Yes! We provide professional resume templates to suit various industries and job levels.</p></div>
            <div class="faq-item"><h3>Can I track my job applications?</h3><p>We are working on an application tracking system to help you manage your job search effectively.</p></div>
            <div class="faq-item"><h3>How does Talent Vector ensure resume compatibility with Resume Screening System?</h3><p>Our AI optimizes formatting, keywords, and structure to make sure your resume passes Resume Screening System filters.</p></div>
            <div class="faq-item"><h3>How secure is my resume and personal data?</h3><p>We follow strict security protocols to keep your information safe and do not share your data without permission.</p></div>
            <div class="faq-item"><h3>What file formats are supported for uploading resumes?</h3><p>You can upload resumes in PDF and DOCX formats for analysis and optimization.</p></div>
            <div class="faq-item"><h3>Can I find inspiration in real-world resume examples?</h3><p>Yes, we offer examples of successful resumes for various jobs and experience levels.</p></div>
            <div class="faq-item"><h3>How can I contact support?</h3><p>You can reach out to our support team via email or phone for any assistance.</p></div>

      <!-- User-submitted questions -->
      <?php foreach ($extra_questions as $q): ?>
        <div class="faq-item">
          <h3>User Question:</h3>
          <p><?= htmlspecialchars($q) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </section>
  
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
