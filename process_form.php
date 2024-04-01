<?php

// Database connection parameters
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'HoursTracker';

// Create connection
$conn = new mysqli($dbHost,$dbUsername , $dbPassword, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $employee_id = $_POST['employee_id'];
    $employee_name = $_POST['employee_name'];
    $department = $_POST['department'];
    $hours_worked = $_POST['hours_worked'];

    // Validate form data
    if (!empty($employee_id) && !empty($employee_name) && !empty($department) && is_numeric($hours_worked)) {
        // Prepare SQL statement to insert data into the table
        $sql = "INSERT INTO employee_hours (employee_id, employee_name, department, hours_worked) 
                VALUES ('$employee_id', '$employee_name', '$department', '$hours_worked')";

        // Execute SQL statement
        if ($conn->query($sql) === TRUE) {
            echo "Employee hours worked added successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Please fill out all fields correctly.";
    }
}

// Display all content stored in the table
$sql = "SELECT * FROM employee_hours";
$result = $conn->query($sql);

// Check if there are rows returned
if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "Employee ID: " . $row["employee_id"] . " - Employee Name: " . $row["employee_name"] . " - Department: " . $row["department"] . " - Hours Worked: " . $row["hours_worked"] . "<br>";
    }
} else {
    echo "No records found";
}

// Close connection
$conn->close();

