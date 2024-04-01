<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Employee Hours Worked</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<!-- Header -->
<header class="bg-dark text-white text-center py-4">
    <div class="container">
        <h1>Employee Hours Tracker</h1>
    </div>
</header>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="./index.html">Home</a>
        <!-- Add other navigation links if needed -->
    </div>
</nav>

<!-- Content -->
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <h2>View Employee Hours Worked</h2>
            <table class="table">
                <thead>
                <tr>
                    <th>Employee ID</th>
                    <th>Employee Name</th>
                    <th>Department</th>
                    <th>Hours Worked</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    // Database connection
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "hourstracker";

                    // Create connection
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Check connection
                    if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
                }

                // SQL query to fetch employee hours worked data
                $sql = "SELECT employee_id, employee_name, department, hours_worked FROM employee_hours";
                $result = $conn->query($sql);

                // Check for errors in SQL query
                if (!$result) {
                echo "Error: " . $sql . "<br>" . $conn->error;
                }

                // Displaying records
                if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["employee_id"] . "</td><td>" . $row["employee_name"] . "</td><td>" . $row["department"] . "</td><td>" . $row["hours_worked"] . "</td></tr>";
                }
                } else {
                echo "<tr><td colspan='4'>No records found</td></tr>";
                }

                $conn->close(); // Close connection
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="bg-dark text-white text-center py-3 mt-5">
    <div class="container">
        <p>&copy; 2024 Employee Hours Tracker</p>
    </div>
</footer>

</body>
</html>
