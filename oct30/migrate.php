<?php
$databaseHost = 'localhost';
$databaseName = 'timetracker';
$databaseUser = 'root';
$databasePassword = 'root';

$conn = new mysqli($databaseHost, $databaseUser, $databasePassword, $databaseName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "
CREATE TABLE IF NOT EXISTS time_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    start_time DATETIME NOT NULL,
    end_time DATETIME,
    duration TIME
)";

if ($conn->query($sql) === TRUE) {
    echo "Table `time_logs` created successfully.";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>