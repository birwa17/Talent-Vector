<?php
session_start();
$conn = new mysqli("localhost", "root", "", "talent_vector");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $sql = "SELECT id, email, password FROM users WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user["password"])) {
            $_SESSION["user"] = $user["email"];
            header("Location: index.html");
            exit();
        } else {
            echo "Invalid credentials!";
        }
    } else {
        echo "User not found!";
    }
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
    <title>Login</title>
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
      max-width: 420px;
      margin: 100px auto;
      padding: 2.5rem;
      background-color: #ffffff;
      border-radius: 16px;
      box-shadow: 0 4px 25px rgba(0, 0, 0, 0.1);
    }

    .auth-container h2 {
      text-align: center;
      margin-bottom: 1.8rem;
      font-size: 1.9rem;
      color: #2f2f2f;
    }

    .auth-container form {
      display: flex;
      flex-direction: column;
    }

    .auth-container label {
      margin-bottom: 0.4rem;
      font-weight: 500;
      color: #444;
    }

    .auth-container input[type="email"],
    .auth-container input[type="password"] {
      padding: 10px 14px;
      margin-bottom: 1.1rem;
      border: 1px solid #ccc;
      border-radius: 10px;
      font-size: 1rem;
    }

    .checkbox {
      display: flex;
      align-items: center;
      margin-bottom: 1rem;
    }

    .checkbox input[type="checkbox"] {
      margin-right: 8px;
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
      transition: background 0.3s ease;
    }

    .auth-container button:hover {
      background-color: #c37ec3;
    }

    .auth-container a {
      display: block;
      text-align: center;
      margin-top: 0.9rem;
      font-size: 0.95rem;
      color: #8a3d9e;
      text-decoration: none;
    }

    .auth-container a:hover {
      text-decoration: underline;
    }

    .auth-container p {
      text-align: center;
      font-size: 0.95rem;
      margin-top: 0.5rem;
    }

    @media (max-width: 500px) {
      .auth-container {
        margin: 80px 20px;
        padding: 2rem 1.5rem;
      }
    }
  </style>
    <div class="auth-container">
        <h2>Login</h2>
        <form method="POST" action="login.php">
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" required>
          <label for="password">Password:</label>
          <input type="password" id="password" name="password" required>
          <div class="checkbox">
            <input type="checkbox" id="rememberMe">
            <label for="rememberMe">Remember Me</label> 
          </div>
          <button type="submit">Login</button>
          <a href= "forgot_password.php">Forgot Password?</a>
          <p>Don't have an account? <a href="signup.php">Signup</a></p>
        </form>
      </div>
</body>
</html>