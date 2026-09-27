<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Resume Form</title>
  <link rel="stylesheet" href="index.css" />
  <link rel="shortcut icon" href="pics/logotrans.png" type="image/x-icon">
  <style>
    body {
      margin: 0;
      padding: 0;
      background: linear-gradient(to bottom right, #f5e9f4, #e6e4fb);
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      transition: 0.5s;
    }

    .container {
      background: white;
      padding: 40px;
      border-radius: 20px;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 500px;
      transition: 0.5s;
    }

    h2 {
      text-align: center;
      color: #333;
      margin-bottom: 25px;
    }

    .form-group {
      margin-bottom: 18px;
      display: flex;
      flex-direction: column;
    }

    .form-group label {
      margin-bottom: 6px;
      font-weight: 500;
    }

    .form-group input,
    .form-group textarea {
      padding: 12px;
      border-radius: 10px;
      border: 1px solid #ccc;
      font-size: 16px;
      outline: none;
      transition: 0.3s;
    }

    .form-group input:focus,
    .form-group textarea:focus {
      border-color: #a065a3;
      background-color: #fef7fd;
    }

    button {
      width: 100%;
      padding: 12px;
      border: none;
      background: #c993d5;
      color: white;
      border-radius: 10px;
      font-size: 16px;
      font-weight: bold;
      cursor: pointer;
      transition: 0.3s ease;
      margin-top: 10px;
    }

    button:hover {
      background: #b374c2;
    }

    .form-step {
      display: none;
    }

    .form-step.active {
      display: block;
    }

    .buttons {
      display: flex;
      gap: 10px;
      flex-direction: column;
    }
  </style>
</head>
<body>

  <div class="container">
    <form id="resumeForm" action="submit_resume.php" method="POST" enctype="multipart/form-data">
      <div class="form-step active">
        <h2>Personal Info</h2>
        <div class="form-group"><input type="file" name="profilePic" required><label>Profile Picture</label></div>
        <div class="form-group"><input type="text" name="name" required><label>First Name</label></div>
        <div class="form-group"><input type="text" name="surname" required><label>Last Name</label></div>
        <div class="form-group"><input type="email" name="email" required><label>Email</label></div>
        <div class="form-group"><input type="text" name="address" required><label>Address</label></div>
        <div class="form-group"><input type="text" name="phone" required><label>Phone</label></div>
        <div class="form-group"><input type="text" name="city" required><label>City</label></div>
        <div class="form-group"><input type="text" name="pincode" required><label>Pincode</label></div>
        <div class="form-group"><input type="text" name="country" required><label>Country</label></div>
        <div class="form-group"><input type="text" name="state" required><label>State</label></div>
        <button type="button" class="next-btn">Next</button>
      </div>

      <div class="form-step">
        <h2>Summary & Skills</h2>
        <div class="form-group"><textarea name="summary"></textarea><label>Professional Summary</label></div>
        <div class="form-group"><textarea name="skills"></textarea><label>e.g. HTML, CSS, JS</label></div>
        <button type="button" class="prev-btn">Back</button>
        <button type="button" class="next-btn">Next</button>
      </div>

      <div class="form-step">
        <h2>Experience</h2>
        <div class="form-group"><input type="text" name="jobTitle"><label>Job Title</label></div>
        <div class="form-group"><input type="text" name="employer"><label>Employer</label></div>
        <div class="form-group"><textarea name="jobDescription"></textarea><label>Description</label></div>
        <div class="form-group"><input type="text" name="jobLocation"><label>Location</label></div>
        <div class="form-group"><input type="date" name="jobStartDate"><label>Start Date</label></div>
        <div class="form-group"><input type="date" name="jobEndDate"><label>End Date</label></div>
        <button type="button" class="prev-btn">Back</button>
        <button type="button" class="next-btn">Next</button>
      </div>

      <div class="form-step">
        <h2>Education</h2>
        <div class="form-group"><input type="text" name="degree"><label>Degree</label></div>
        <div class="form-group"><input type="text" name="schoolName"><label>School Name</label></div>
        <div class="form-group"><input type="text" name="schoolLocation"><label>Location</label></div>
        <div class="form-group"><input type="text" name="educationLevel"><label>Education Level</label></div>
        <div class="form-group"><input type="date" name="eduStartDate"><label>Start Date</label></div>
        <div class="form-group"><input type="date" name="eduEndDate"><label>End Date</label></div>
        <div class="buttons">
          <button type="button" class="prev-btn">Back</button>
          <button type="submit" id="submitBtn">Submit</button>
          <button type="button" onclick="document.getElementById('resumeForm').action='preview_resume.php'; document.getElementById('resumeForm').submit();">Preview Resume</button>
        </div>
      </div>
    </form>
  </div>

  <script>
    const steps = document.querySelectorAll('.form-step');
    let currentStep = 0;

    function showStep(index) {
      steps.forEach((step, i) => step.classList.toggle('active', i === index));
    }

    document.querySelectorAll('.next-btn').forEach(btn =>
      btn.addEventListener('click', () => {
        if (currentStep < steps.length - 1) currentStep++;
        showStep(currentStep);
      })
    );

    document.querySelectorAll('.prev-btn').forEach(btn =>
      btn.addEventListener('click', () => {
        if (currentStep > 0) currentStep--;
        showStep(currentStep);
      })
    );
  </script>
</body>
</html>
