<?php
session_start();
$conn = new mysqli("localhost", "root", "", "talent_vector");
if (!$conn) {
    die("Database Connection Failed: " . mysqli_connect_error());
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = strtolower(trim($_POST["email"])); 
    $newpassword = trim($_POST["newpassword"]);
    $confirmpassword = trim($_POST["confirmpassword"]);
    if ($newpassword !== $confirmpassword) {
        echo "Passwords do not match!";
        exit();
    }
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 0) {
        echo "Email not found!";
        exit();
    }
    $hashed_password = password_hash($newpassword, PASSWORD_DEFAULT);
    $update_stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
    $update_stmt->bind_param("ss", $hashed_password, $email);
    if ($update_stmt->execute()) {
        echo "Password successfully updated! ";
    } else {
        echo "Error updating password: " . $conn->error; 
    }
    $stmt->close();
    $update_stmt->close();
}
$conn->close();
?>

<!-- Html code -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="shortcut icon" href="pics/logotrans.png" type="image/x-icon">
</head>
<body>
<style>
    body {
      margin: 0;
      padding: 0;
      background: linear-gradient(to right, #f5e7f0, #e6e9f8);
      font-family: 'Segoe UI', sans-serif;
    }

    .auth-container {
      max-width: 400px;
      margin: 100px auto;
      padding: 2.5rem;
      background-color: #fff;
      border-radius: 18px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .auth-container h2 {
      text-align: center;
      margin-bottom: 1.6rem;
      font-size: 1.8rem;
      font-weight: bold;
      color: #2c2c2c;
    }

    .auth-container form {
      display: flex;
      flex-direction: column;
    }

    .auth-container label {
      margin-bottom: 0.3rem;
      font-weight: 500;
      color: #333;
    }

    .auth-container input[type="email"],
    .auth-container input[type="password"] {
      padding: 10px 14px;
      margin-bottom: 1rem;
      border: 1px solid #ccc;
      border-radius: 10px;
      font-size: 1rem;
    }

    .auth-container button {
      padding: 12px;
      border: none;
      background-color: #d49ed4;
      color: white;
      font-size: 1rem;
      font-weight: 600;
      border-radius: 10px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .auth-container button:hover {
      background-color: #c580c5;
    }

    .auth-container p {
      text-align: center;
      font-size: 0.95rem;
      margin-top: 1rem;
    }

    .auth-container a {
      color: #8a3d9e;
      text-decoration: none;
      font-weight: 500;
    }

    .auth-container a:hover {
      text-decoration: underline;
    }

    @media (max-width: 500px) {
      .auth-container {
        margin: 60px 20px;
        padding: 2rem 1.2rem;
      }
    }
  </style>
    <div class="auth-container">
        <h2>Forgot Password</h2>
        <form action="forgot_password.php" method="POST">
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" required>
          
          <label for="newpassword">New Password:</label>
          <input type="password" id="newpassword" name="newpassword" required>
 
          <label for="confirmpassword">Confirm Password:</label>
          <input type="password" id="confirmpassword" name="confirmpassword" required>

          <button type="submit">Reset Password</button>
          <p>Remembered your Password? <a href="login.php">Login</a></p>
        </form>
    </div>
</body>
</html>
