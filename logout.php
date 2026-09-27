<?php
session_start();
session_unset();
session_destroy();
header("Location: index.html");
exit();
?>

<!-- Html code -->
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <link rel="stylesheet" href="index.css">
    <link rel="shortcut icon" href="pics/logotrans.png" type="image/x-icon">
</head>
<body>
    <div class="auth-container">
        <h2>Logout</h2>
        <form action="logout.php" method="POST">
            <button type="submit">Logout</button>
        </form>
    </div>
</body>
</html>
