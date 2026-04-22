<?php
session_start();

// If already logged in, skip login page
if (isset($_SESSION['logged_in'])) {
    header("Location: home.php");
    exit();
}

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = trim($_POST['name']);
    $password = trim($_POST['password']);

    // Check if account exists and password is correct
    if (isset($_SESSION['accounts'][$name]) &&
        $_SESSION['accounts'][$name]['password'] === $password) {

        // Store logged in user info in session
        $_SESSION['logged_in'] = $_SESSION['accounts'][$name];
        header("Location: home.php");
        exit();

    } else {
        $message = "Wrong username or password. Try again!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: Arial, sans-serif;
            background: #e8f0fe;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .box {
            background: white;
            padding: 35px 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.12);
            width: 340px;
        }
        h2 { text-align: center; color: #333; margin-bottom: 20px; }
        label { font-size: 13px; color: #555; display: block; margin-top: 12px; margin-bottom: 4px; }
        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }
        button {
            width: 100%;
            padding: 11px;
            background: #1a73e8;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 15px;
            margin-top: 18px;
        }
        button:hover { background: #1558b0; }
        .msg { text-align: center; color: red; margin-top: 12px; font-size: 13px; }
        .link { text-align: center; margin-top: 15px; font-size: 13px; }
        .link a { color: #1a73e8; text-decoration: none; }
    </style>
</head>
<body>
<div class="box">
    <h2>🔐 Login</h2>
    <form method="POST">
        <label>Username</label>
        <input type="text" name="name" placeholder="Enter username" required />

        <label>Password</label>
        <input type="password" name="password" placeholder="Enter password" required />

        <button type="submit">Login</button>
    </form>

    <?php if ($message !== ""): ?>
        <p class="msg"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <p class="link">No account yet? <a href="signup.php">Sign Up</a></p>
</div>
</body>
</html>