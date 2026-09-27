<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['template'])) {
    $_SESSION['selected_template'] = $_POST['template'];
    header("Location: resume_selection.php"); // 
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume Templates</title>
    <link rel="shortcut icon" href="pics/logotrans.png" type="image/x-icon">
</head>
<body>

    <div class="container">
        <h1 style="text-align: center;">Choose Your Resume Template</h1>
        <div class="resume-section">

            <!-- Template 1 -->
            <form method="POST" class="resume-card">
                <img src="pics/16.png">
                <h3>Professional Resume</h3>
                <input type="hidden" name="template" value="template1">
                <button type="submit" class="download-btn">Edit</button>
                
            </form>

            <!-- Template 2 -->
            <form method="POST" class="resume-card">
                <img src="pics/17.png">
                <h3>Minimalist Resume</h3>
                <input type="hidden" name="template" value="template2">
                <button type="submit" class="download-btn">Edit</button>
            </form>

            <!-- Template 3 -->
            <form method="POST" class="resume-card">
                <img src="pics/12.png" alt="Modern Resume">
                <h3>Modern Resume</h3>
                <input type="hidden" name="template" value="template3">
                <button type="submit" class="download-btn">Edit</button>
            </form>

            <!-- Template 4 -->
            <form method="POST" class="resume-card">
                <img src="pics/13.png" alt="Simple Resume">
                <h3>Simple Resume</h3>
                <input type="hidden" name="template" value="template4">
                <button type="submit" class="download-btn">Edit</button>
            </form>

            <!-- Template 5 -->
            <form method="POST" class="resume-card">
                <img src="pics/11.png" alt="Creative Resume">
                <h3>Creative Resume</h3>
                <input type="hidden" name="template" value="template5">
                <button type="submit" class="download-btn">Edit</button>
            </form>

            <!-- Template 6 -->
            <form method="POST" class="resume-card">
                <img src="pics/4.jpeg" alt="Cute Resume">
                <h3>Cute Resume</h3>
                <input type="hidden" name="template" value="template6">
                <button type="submit" class="download-btn">Edit</button>
            </form>

            <!-- Template 7 -->
            <form method="POST" class="resume-card">
                <img src="pics/2.png" alt="College Resume">
                <h3>College Resume</h3>
                <input type="hidden" name="template" value="template7">
                <button type="submit" class="download-btn">Edit</button>
            </form>

            <!-- Template 8 -->
            <form method="POST" class="resume-card">
                <img src="pics/15.png" alt="Teacher Resume">
                <h3>Teacher Resume</h3>
                <input type="hidden" name="template" value="template8">
                <button type="submit" class="download-btn">Edit</button>
            </form>

            <!-- Template 9 -->
            <form method="POST" class="resume-card">
                <img src="pics/8.png" alt="Nurse Resume">
                <h3>Nurse Resume</h3>
                <input type="hidden" name="template" value="template9">
                <button type="submit" class="download-btn">Edit</button>
            </form>

            <form method="POST" class="resume-card">
                <img src="pics/1.jpeg" alt="Elegant Resume">
                <h3>Elegant Resume</h3>
                <input type="hidden" name="template" value="template10">
                <button type="submit" class="download-btn">Edit</button>
            </form>
        </div>
    </div>
<style>
body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    background-color: #fff;
}

.container {
    max-width: 1200px;
    margin: auto;
    padding: 20px;
}

h1 {
    text-align: center;
    color: #333;
}

.resume-section {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
    margin-top: 40px;
}

.resume-card {
    width: 300px;
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    text-align: center;
    transition: transform 0.3s ease;
}

.resume-card:hover {
    transform: scale(1.05);
}

.resume-card img {
    width: 100%;
    border-radius: 5px;
}

.resume-card h3 {
    margin-top: 15px;
    font-size: 20px;
    color: #333;
}

.download-btn {
    display: inline-block;
    margin-top: 10px;
    padding: 10px 15px;
    background-color: #e6c6ee;
    color: black;
    text-decoration: none;
    border-radius: 5px;
    transition: background 0.3s ease;
    border: none;
    cursor: pointer;
}

.download-btn:hover {
    color: plum;
}

/* Responsive Design */
@media (max-width: 768px) {
    .resume-section {
        flex-direction: column;
        align-items: center;
    }
}
</style>

</body>
</html>
