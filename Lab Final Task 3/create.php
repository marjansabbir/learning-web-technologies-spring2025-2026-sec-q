<?php
session_start();

if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit();
}

// Block users — admin only
if ($_SESSION['logged_in']['role'] !== 'admin') {
    echo "<p style='text-align:center; color:red; margin-top:50px; font-size:18px;'>❌ Access Denied! Admins only.</p>";
    echo "<p style='text-align:center;'><a href='home.php'>Go Back</a></p>";
    exit();
}

// Initialize records if not set
if (!isset($_SESSION['records'])) {
    $_SESSION['records'] = [];
}

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name   = trim($_POST['name']);
    $course = trim($_POST['course']);
    $grade  = trim($_POST['grade']);

    if ($name === "" || $course === "" || $grade === "") {
        $message = "error:Please fill in all fields.";
    } else {
        // Add new record as associative array into session
        $_SESSION['records'][] = [
            'name'   => $name,
            'course' => $course,
            'grade'  => $grade
        ];
        $message = "success:Record added successfully!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Create Record</title>
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
            width: 360px;
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
            background: #43a047;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 15px;
            margin-top: 18px;
        }
        button:hover { background: #2e7d32; }
        .msg-success { text-align: center; color: green; margin-top: 12px; font-size: 13px; }
        .msg-error   { text-align: center; color: red;   margin-top: 12px; font-size: 13px; }
        .link { text-align: center; margin-top: 15px; font-size: 13px; }
        .link a { color: #1a73e8; text-decoration: none; }
    </style>
</head>
<body>
<div class="box">
    <h2>➕ Add New Record</h2>
    <form method="POST">
        <label>Student Name</label>
        <input type="text" name="name" placeholder="e.g. Alice" required />

        <label>Course</label>
        <input type="text" name="course" placeholder="e.g. CSE" required />

        <label>Grade</label>
        <input type="text" name="grade" placeholder="e.g. A+" required />

        <button type="submit">Add Record</button>
    </form>

    <?php if ($message !== ""): ?>
        <?php
            list($type, $text) = explode(":", $message, 2);
            $css = ($type === "success") ? "msg-success" : "msg-error";
        ?>
        <p class="<?= $css ?>"><?= htmlspecialchars($text) ?>
            <?php if ($type === "success"): ?>
                — <a href="records.php">View Records</a>
            <?php endif; ?>
        </p>
    <?php endif; ?>

    <p class="link"><a href="home.php">← Back to Home</a></p>
</div>
</body>
</html>