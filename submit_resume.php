<?php
session_start();
$conn = new mysqli("localhost", "root", "", "talent_vector");
if ($conn->connect_error) die("DB Connection failed!");

$profilePicPath = '';
if ($_FILES['profilePic']['error'] === 0) {
  $uploadDir = "uploads/";
  if (!file_exists($uploadDir)) mkdir($uploadDir, 0777, true);
  $fileName = time() . "_" . basename($_FILES['profilePic']['name']);
  $targetFile = $uploadDir . $fileName;
  move_uploaded_file($_FILES['profilePic']['tmp_name'], $targetFile);
  $profilePicPath = $targetFile;
}

$stmt = $conn->prepare("INSERT INTO resume_data (profile_pic, name, surname, email, address, phone, city, pincode, country, state, summary, skills, job_title, employer, job_description, job_location, job_start_date, job_end_date, degree, school_name, school_location, education_level, edu_start_date, edu_end_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssssssssssssssssssss",
  $profilePicPath, $_POST['name'], $_POST['surname'], $_POST['email'], $_POST['address'], $_POST['phone'], $_POST['city'], $_POST['pincode'], $_POST['country'], $_POST['state'], $_POST['summary'], $_POST['skills'], $_POST['jobTitle'], $_POST['employer'], $_POST['jobDescription'], $_POST['jobLocation'], $_POST['jobStartDate'], $_POST['jobEndDate'], $_POST['degree'], $_POST['schoolName'], $_POST['schoolLocation'], $_POST['educationLevel'], $_POST['eduStartDate'], $_POST['eduEndDate']);
$stmt->execute();
$stmt->close();

$_SESSION['resume'] = $_POST;
$_SESSION['resume']['profilePic'] = $profilePicPath;

header("Location: final_resume.php");
exit;
?>