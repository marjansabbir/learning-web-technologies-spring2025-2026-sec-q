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

if (!isset($_SESSION['records'])) {
    $_SESSION['records'] = [];
}

$message = "";

// If a delete request came in via URL
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    if (isset($_SESSION['records'][$id])) {
        // Remove the record and re-index the array
        array_splice($_SESSION['records'], $id, 1);
        $message = "success:Record deleted successfully!";
    } else {
        $message = "error:Record not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Delete Record</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: Arial, sans-serif; background: #f0f2f5; }
        .navbar {
            background: #2c2c2c; color: white;
            padding: 15px 30px; display: flex; justify-content: space-between;
        }
        .navbar a { color: #ffcc00; text-decoration: none; }
        .content { max-width: 650px; margin: 30px auto; padding: 0 15px; }
        h2 { color: #e53935; margin-bottom: 20px; }
        table {
            width: 100%; border-collapse: collapse;
            background: white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            border-radius: 8px; overflow: hidden;
        }
        th { background: #e53935; color: white; padding: 12px 15px; text-align: left; }
        td { padding: 12px 15px; border-bottom: 1px solid #eee; }
        tr:last-child td { border-bottom: none; }
        tr:hover { background: #fafafa; }
        a.del-btn {
            background: #e53935; color: white;
            padding: 5px 12px; border-radius: 5px;
            text-decoration: none; font-size: 13px;
        }
        a.del-btn:hover { background: #b71c1c; }
        .msg-success { color: green; margin-bottom: 15px; font-size: 14px; }
        .msg-error   { color: red;   margin-bottom: 15px; font-size: 14px; }
        .no-data {
            text-align: center; padding: 40px;
            color: #999; background: white; border-radius: 8px;
        }
    </style>
</head>
<body>

<div class="navbar">
    <span>🗑️ Delete Records</span>
    <a href="home.php">🏠 Back to Home</a>
</div>

<div class="content">
    <h2>🗑️ Delete a Record</h2>

    <?php if ($message !== ""): ?>
        <?php
            list($type, $text) = explode(":", $message, 2);
            $css = ($type === "success") ? "msg-success" : "msg-error";
        ?>
        <p class="<?= $css ?>"><?= htmlspecialchars($text) ?></p>
    <?php endif; ?>

    <?php if (count($_SESSION['records']) === 0): ?>
        <div class="no-data">
            <p>No records to delete.</p>
            <p style="margin-top:10px;"><a href="create.php">➕ Add some records first</a></p>
        </div>
    <?php else: ?>
        <table>
            <tr>
                <th>#</th>
                <th>Student Name</th>
                <th>Course</th>
                <th>Grade</th>
                <th>Action</th>
            </tr>
            <?php foreach ($_SESSION['records'] as $i => $rec): ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= htmlspecialchars($rec['name']) ?></td>
                <td><?= htmlspecialchars($rec['course']) ?></td>
                <td><?= htmlspecialchars($rec['grade']) ?></td>
                <td>
                    <a href="delete.php?id=<?= $i ?>"
                       class="del-btn"
                       onclick="return confirm('Delete <?= htmlspecialchars($rec['name']) ?>? This cannot be undone.')">
                        🗑️ Delete
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</div>

</body>
</html>