<?php $pageTitle = 'Search Employee'; ?>
<?php require BASE_PATH . '/app/views/layout/header.php'; ?>

<h3>Search Employee</h3>

<p>Type a name, contact number, or username to search:</p>

<input type="text" id="searchInput" placeholder="Search employees..." onkeyup="searchEmployee()">

<br><br>

<div id="searchResults">
    <p>Start typing to search...</p>
</div>

<script>
/**
 * AJAX Search
 * Sends a GET request to EmployeeController::searchAjax()
 * which returns a JSON array of matching employees.
 * Builds an HTML table from the JSON and injects it into the page.
 * No page reload needed.
 */
function searchEmployee() {
    var keyword    = document.getElementById('searchInput').value.trim();
    var resultsDiv = document.getElementById('searchResults');

    // Clear results if input is empty
    if (keyword === '') {
        resultsDiv.innerHTML = '<p>Start typing to search...</p>';
        return;
    }

    // Create AJAX request
    var xhr = new XMLHttpRequest();
    xhr.open(
        'GET',
        'index.php?controller=employee&action=searchAjax&keyword=' + encodeURIComponent(keyword),
        true
    );

    resultsDiv.innerHTML = '<p>Searching...</p>';

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {

            // Parse the JSON response from the Controller
            var data = JSON.parse(xhr.responseText);

            if (data.length === 0) {
                resultsDiv.innerHTML = '<p>No employees found for "' + keyword + '".</p>';
                return;
            }

            // Build result table from JSON data
            var html = '<table border="1" cellpadding="6" cellspacing="0">';
            html += '<thead><tr>';
            html += '<th>#</th><th>Name</th><th>Contact No</th><th>Username</th><th>Actions</th>';
            html += '</tr></thead><tbody>';

            for (var i = 0; i < data.length; i++) {
                var emp = data[i];
                html += '<tr>';
                html += '<td>' + emp.id + '</td>';
                html += '<td>' + emp.name + '</td>';
                html += '<td>' + emp.contact_no + '</td>';
                html += '<td>' + emp.username + '</td>';
                html += '<td>';
                html += '<a href="index.php?controller=employee&action=edit&id=' + emp.id + '">Edit</a>';
                html += ' | ';
                html += '<a href="index.php?controller=employee&action=delete&id=' + emp.id + '" ';
                html += 'onclick="return confirm(\'Delete this employee?\')">Delete</a>';
                html += '</td>';
                html += '</tr>';
            }

            html += '</tbody></table>';
            html += '<p>Found ' + data.length + ' result(s).</p>';

            resultsDiv.innerHTML = html;
        }
    };

    xhr.send();
}
</script>

<?php require BASE_PATH . '/app/views/layout/footer.php'; ?>
