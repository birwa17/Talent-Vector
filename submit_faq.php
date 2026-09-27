<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "talent_vector"; 

$conn = new mysqli($host, $user, $password, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$question = trim($_POST['question']);

if (!empty($question)) {
    $stmt = $conn->prepare("INSERT INTO faq_questions (question) VALUES (?)");
    $stmt->bind_param("s", $question);
    $stmt->execute();
    $stmt->close();
}

$conn->close();
header("Location: faq.php");
exit();
?>
