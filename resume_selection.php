<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume Selection</title>
    <link rel="shortcut icon" href="pics/logotrans.png" type="image/x-icon">
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #f9f9f9;
        }
        .container {
            display: flex;
            gap: 20px;
        }
        .card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 300px;
        }
        .button {
            padding: 10px 20px;
            border: none;
            background-color: #e6c6ee;
            color: black;
            border-radius: 20px;
            font-size: 16px;
            cursor: pointer;
            display: block;
            margin: 15px auto;
        }
        .navigation {
            display: flex;
            justify-content: space-around;
            
            width: 90%;
            margin-top: 20px;
        }
        .round-btn {
        background-color: #e6c6ee;
        color: black;
            border: none;
            border-radius: 50px;
            padding: 15px 30px;
            font-size: 16px;
            cursor: pointer;
        }
        .round-btn:hover {
            color: plum;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <h2>Start with a <strong>new</strong> resume</h2>
            <img src="pics/createnew.png">
            <p>Get step-by-step support with expert content suggestions at your fingertips!</p>
            <a href="resume_form.php" class="round-btn">Create new</a> 
        </div>
    </div>
    <div class="navigation">
        <button class="round-btn">Back</button>
    </div>
</body>
</html>
