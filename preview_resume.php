<?php
session_start();
$_SESSION['resume'] = $_POST;
if ($_FILES['profilePic']['error'] === 0) {
    $uploadDir = "uploads/";
    $fileName = time() . "_" . basename($_FILES['profilePic']['name']);
    $targetFile = $uploadDir . $fileName;
    move_uploaded_file($_FILES['profilePic']['tmp_name'], $targetFile);
    $_SESSION['resume']['profilePic'] = $targetFile;
}
header("Location: final_resume.php");
exit;
?>