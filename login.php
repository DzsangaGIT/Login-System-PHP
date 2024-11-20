<?php
session_start();

$savedUsername = $_COOKIE['username'] ?? '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $remember = isset($_POST['remember']);

    if (strlen($username) < 5 || !ctype_alnum($username)) {
        $error = 'Legalább 5 alfanumerikus karaktert kell megadni a felhasználónévhez!';
    } elseif (strlen($password) < 8 || 
              !preg_match('/[A-Z]/', $password) || 
              !preg_match('/[a-z]/', $password) || 
              !preg_match('/\d/', $password)) {
        $error = 'A jelszó legalább 8 karakterből kell , hogy álljon, és tartalmaznia kell kis- és nagybetűt és legalább egy számot!';
    } else {
        $_SESSION['username'] = $username;
        if ($remember) setcookie('username', $username, time() + 7 * 24 * 60 * 60); // 7 nap
        header('Location: profile.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body, h1, p, label, input {
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

        .login-container {
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

        .login-container h1 {
            font-size: 2rem;
            color: #007bff;
            margin-bottom: 20px;
            animation: slideIn 0.5s ease-out forwards;
        }

        .login-container p {
            color: red;
            font-size: 0.9rem;
            margin: 10px 0;
        }

        label {
            display: block;
            text-align: left;
            margin-bottom: 8px;
            font-size: 1rem;
            font-weight: 500;
            animation: fadeIn 1s ease-out forwards;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        input[type="checkbox"] {
            margin-right: 8px;
        }

        .remember-label {
            font-size: 0.9rem;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        button:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }

        input:focus {
            border-color: #007bff;
            outline: none;
            transform: scale(1.05);
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

        sup {
            color: red;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Login</h1>
        <form method="post">
            <?php if ($error) : ?><p><?= htmlspecialchars($error)?></p><?php endif; ?>
            <label for="username">Felhasználónév <sup>*</sup></label>
            <input type="text" id="username" name="username" value="<?= htmlspecialchars($savedUsername) ?>" required>
            
            <label for="password">Jelszó</label>
            <input type="password" id="password" name="password" required>

            <label class="remember-label">
                <input type="checkbox" name="remember"> Emlékezz rám
            </label>

            <button type="submit">Bejelentkezés</button>
        </form>
    </div>
</body>
</html>
