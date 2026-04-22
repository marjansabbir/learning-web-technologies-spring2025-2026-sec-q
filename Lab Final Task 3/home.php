<?php
session_start();

// Redirect to login if not logged in
if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['logged_in']; // get current user info
?>
<!DOCTYPE html>
<html>
<head>
    <title>Home - Dashboard</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: Arial, sans-serif; background: #f0f2f5; }
        .navbar {
            background: #2c2c2c;
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .navbar a {
            color: #ffcc00;
            text-decoration: none;
            font-size: 14px;
        }
        .badge {
            background: #ffcc00;
            color: #333;
            padding: 2px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            margin-left: 8px;
        }
        .content {
            max-width: 650px;
            margin: 60px auto;
            text-align: center;
        }
        .content h2 { color: #333; margin-bottom: 10px; }
        .content p { color: #666; margin-bottom: 30px; }
        .btn {
            display: inline-block;
            margin: 10px;
            padding: 16px 28px;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: bold;
        }
        .blue   { background: #1a73e8; }
        .blue:hover   { background: #1558b0; }
        .green  { background: #43a047; }
        .green:hover  { background: #2e7d32; }
        .orange { background: #fb8c00; }
        .orange:hover { background: #e65100; }
        .red    { background: #e53935; }
        .red:hover    { background: #b71c1c; }
    </style>
</head>
<body>

<div class="navbar">
    <span>
        👋 Welcome, <strong><?= htmlspecialchars($user['name']) ?></strong>
        <span class="badge"><?= strtoupper($user['role']) ?></span>
    </span>
    <a href="logout.php">🚪 Logout</a>
</div>

<div class="content">
    <h2>🏠 Dashboard</h2>
    <p>Choose an action below:</p>

    <!-- View Records — available to EVERYONE -->
    <a href="records.php" class="btn blue">📋 View Records</a>

    <?php if ($user['role'] === 'admin'): ?>
        <!-- Admin only buttons -->
        <a href="create.php" class="btn green">➕ Create Record</a>
        <a href="update.php" class="btn orange">✏️ Update Record</a>
        <a href="delete.php" class="btn red">🗑️ Delete Record</a>
    <?php else: ?>
        <!-- User can only edit their own profile -->
        <a href="update.php" class="btn orange">👤 Edit My Profile</a>
    <?php endif; ?>
</div>

</body>
</html>