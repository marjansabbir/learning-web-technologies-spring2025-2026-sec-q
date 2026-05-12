<?php $pageTitle = 'Add Employee'; ?>
<?php require BASE_PATH . '/app/views/layout/header.php'; ?>

<h3>Add New Employee</h3>

<?php if (!empty($error)): ?>
    <p style="color:red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="POST" action="index.php?controller=employee&action=create" onsubmit="return validateForm()">
    <table>
        <tr>
            <td>Employee Name:</td>
            <td><input type="text" name="name" id="name" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>"></td>
        </tr>
        <tr>
            <td>Contact No:</td>
            <td><input type="text" name="contact_no" id="contact_no" value="<?= htmlspecialchars($_POST['contact_no'] ?? '') ?>"></td>
        </tr>
        <tr>
            <td>Username:</td>
            <td><input type="text" name="username" id="username" value="<?= htmlspecialchars($_POST['username'] ?? '') ?>"></td>
        </tr>
        <tr>
            <td>Password:</td>
            <td><input type="password" name="password" id="password"></td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" value="Add Employee">
                &nbsp;
                <a href="index.php?controller=employee&action=index">Cancel</a>
            </td>
        </tr>
    </table>
</form>

<script>
// NULL validation using JavaScript
function validateForm() {
    var name       = document.getElementById('name').value.trim();
    var contact_no = document.getElementById('contact_no').value.trim();
    var username   = document.getElementById('username').value.trim();
    var password   = document.getElementById('password').value.trim();

    if (name === '')       { alert('Employee name is required.');  return false; }
    if (contact_no === '') { alert('Contact number is required.'); return false; }
    if (username === '')   { alert('Username is required.');       return false; }
    if (password === '')   { alert('Password is required.');       return false; }
    return true;
}
</script>

<?php require BASE_PATH . '/app/views/layout/footer.php'; ?>
