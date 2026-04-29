<!DOCTYPE html>
<html>
<head>
    <title>Update</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: Arial, sans-serif; background: #e8f0fe;
            display: flex; justify-content: center; align-items: center; min-height: 100vh;
        }
        .box {
            background: white; padding: 35px 30px;
            border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.12); width: 370px;
        }
        h2 { text-align: center; color: #333; margin-bottom: 20px; }
        label { font-size: 13px; color: #555; display: block; margin-top: 12px; margin-bottom: 4px; }
        input {
            width: 100%; padding: 10px;
            border: 1px solid #ccc; border-radius: 6px; font-size: 14px;
        }
        button {
            width: 100%; padding: 11px; background: #fb8c00;
            color: white; border: none; border-radius: 6px;
            cursor: pointer; font-size: 15px; margin-top: 18px;
        }
        button:hover { background: #e65100; }
        .msg-success { text-align: center; color: green; margin-top: 12px; font-size: 13px; }
        .msg-error   { text-align: center; color: red;   margin-top: 12px; font-size: 13px; }
        .link { text-align: center; margin-top: 15px; font-size: 13px; }
        .link a { color: #1a73e8; text-decoration: none; }
        table { width: 100%; border-collapse: collapse; }
        th { background: #fb8c00; color: white; padding: 10px; text-align: left; }
        td { padding: 10px; border-bottom: 1px solid #eee; font-size: 14px; }
        a.pick {
            background: #fb8c00; color: white;
            padding: 4px 10px; border-radius: 4px;
            text-decoration: none; font-size: 13px;
        }
    </style>
</head>
<body>
<div class="box">

<?php if ($user['role'] === 'admin'): ?>

    <?php if ($record === null): ?>
        <!-- Step 1: Admin picks which record to edit -->
        <h2>✏️ Select Record to Edit</h2>
        <?php if (empty($records)): ?>
            <p style="text-align:center; color:#999; margin-top:20px;">No records available to update.</p>
        <?php else: ?>
            <table>
                <tr><th>#</th><th>Name</th><th>Pick</th></tr>
                <?php $num = 1; foreach ($records as $rec): ?>
                <tr>
                    <td><?= $num++ ?></td>
                    <td><?= htmlspecialchars($rec['name']) ?></td>
                    <td><a href="index.php?page=update&id=<?= $rec['id'] ?>" class="pick">Edit</a></td>
                </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>

    <?php else: ?>
        <!-- Step 2: Admin fills the edit form -->
        <h2>✏️ Update Record</h2>
        <form method="POST" action="index.php?page=update">
            <input type="hidden" name="id" value="<?= $record['id'] ?>" />

            <label>Student Name</label>
            <input type="text" name="name" value="<?= htmlspecialchars($record['name']) ?>" required />

            <label>Course</label>
            <input type="text" name="course" value="<?= htmlspecialchars($record['course']) ?>" required />

            <label>Grade</label>
            <input type="text" name="grade" value="<?= htmlspecialchars($record['grade']) ?>" required />

            <button type="submit">Update Record</button>
        </form>
    <?php endif; ?>

<?php else: ?>
    <!-- Regular user edits their own profile -->
    <h2>👤 Edit My Profile</h2>
    <form method="POST" action="index.php?page=update">
        <label>New Username</label>
        <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required />

        <label>New Password</label>
        <input type="password" name="password" placeholder="Enter new password" required />

        <button type="submit">Update Profile</button>
    </form>
<?php endif; ?>

    <?php if ($message !== ""): ?>
        <?php
            list($type, $text) = explode(":", $message, 2);
            $css = ($type === "success") ? "msg-success" : "msg-error";
        ?>
        <p class="<?= $css ?>"><?= htmlspecialchars($text) ?>
            <?php if ($type === "success" && $user['role'] === 'admin'): ?>
                — <a href="index.php?page=records">View Records</a>
            <?php endif; ?>
        </p>
    <?php endif; ?>

    <p class="link"><a href="index.php?page=home">← Back to Home</a></p>
</div>
</body>
</html>
