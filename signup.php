<?php
session_start();
$conn = new mysqli("localhost", "root", "", "talent_vector");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];
    if ($password !== $confirmpassword) {
        echo "Passwords do not match!";
        exit();
    }
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $email, $hashed_password);
    if ($stmt->execute()) {
        $_SESSION["user"] = $email;
        header("Location: index.html"); // Redirect to dashboard after signup
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
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
    <title>Sign Up</title>
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
      padding: 2rem 2.5rem;
      background-color: #fff;
      border-radius: 18px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .auth-container h2 {
      text-align: center;
      margin-bottom: 1.5rem;
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

    .auth-container input[type="text"],
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
      margin-top: 1.2rem;
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
        <h2>Signup</h2>
        <ul id="messages"></ul>

        <form method="POST" action="signup.php">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <label for="confirmpassword">Confirm Password:</label>
            <input type="password" id="confirmpassword" name="confirmpassword" required>
            <button type="submit">Signup</button>
            <p>Already have an account? <a href="login.php">Login</a></p>
        </form>
    </div>
</body>
</html>