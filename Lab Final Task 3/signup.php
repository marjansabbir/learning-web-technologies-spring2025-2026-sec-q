<?php
session_start();

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = trim($_POST['name']);
    $password = trim($_POST['password']);
    $role     = $_POST['role'];

    if ($name === "" || $password === "") {
        $message = "Please fill in all fields.";
    } elseif (isset($_SESSION['accounts'][$name])) {
        $message = "This username already exists! Try another.";
    } else {
        // Store account in session using associative array
        $_SESSION['accounts'][$name] = [
            'name'     => $name,
            'password' => $password,
            'role'     => $role
        ];
        $message = "success"; // used below to redirect
    }

    if ($message === "success") {
        header("Location: login.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
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
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        label {
            font-size: 13px;
            color: #555;
            display: block;
            margin-top: 12px;
            margin-bottom: 4px;
        }
        input, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }
        button {
            width: 100%;
            padding: 11px;
            background: #4CAF50;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 15px;
            margin-top: 18px;
        }
        button:hover { background: #388e3c; }
        .msg {
            text-align: center;
            color: red;
            margin-top: 12px;
            font-size: 13px;
        }
        .link {
            text-align: center;
            margin-top: 15px;
            font-size: 13px;
        }
        .link a { color: #1a73e8; text-decoration: none; }
    </style>
</head>
<body>
<div class="box">
    <h2>📝 Create Account</h2>
    <form method="POST">
        <label>Username</label>
        <input type="text" name="name" placeholder="Enter username" required />

        <label>Password</label>
        <input type="password" name="password" placeholder="Enter password" required />

        <label>Role</label>
        <select name="role">
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>

        <button type="submit">Sign Up</button>
    </form>

    <?php if ($message !== "" && $message !== "success"): ?>
        <p class="msg"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <p class="link">Already have an account? <a href="login.php">Login here</a></p>
</div>
</body>
</html>