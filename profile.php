<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <style>

        body, h1, a {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f4f7fc;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }

        .profile-container {
            background: #fff;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
            opacity: 0;
            animation: fadeIn 1s ease-out forwards;
        }

        .profile-container h1 {
            font-size: 2rem;
            color: #007bff;
            margin-bottom: 20px;
            animation: slideIn 0.5s ease-out forwards;
        }

        .profile-container a {
            display: inline-block;
            padding: 12px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 1rem;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .profile-container a:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }

        @keyframes slideIn {
            0% {
                transform: translateY(-20px);
                opacity: 0;
            }
            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <h1>Üdv, <?= htmlspecialchars($_SESSION['username']) ?>!</h1>
        <a href="logout.php">Kijelentkezés</a>
    </div>
</body>
</html>
