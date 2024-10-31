<?php
session_start();
$databasePath = __DIR__ . '/sqlite.db';
$conn = new PDO("sqlite:" . $databasePath);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];

    if (!empty($start_time) && !empty($end_time)) {
        if ($start_time < $end_time) {
            $start = strtotime($start_time);
            $end = strtotime($end_time);
            $duration_seconds = $end - $start;
            $duration = gmdate("H:i:s", $duration_seconds);

            $sql = "INSERT INTO time_logs (user_id, start_time, end_time, duration) VALUES (1, :start_time, :end_time, :duration)";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':start_time', $start_time);
            $stmt->bindValue(':end_time', $end_time);
            $stmt->bindValue(':duration', $duration);
            $stmt->execute();
        } else {
            echo "<p style='color:red;'>Start time must be before end time.</p>";
        }
    } else {
        echo "<p style='color:red;'>Please provide both start time and end time.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Time Tracker</title>
    <link rel="stylesheet" href="../styles.css">
    <script>
        function validateForm() {
            const start_time = document.getElementById('start_time').value;
            const end_time = document.getElementById('end_time').value;

            if (!start_time || !end_time) {
                alert('Please provide both start time and end time.');
                return false;
            }

            if (start_time >= end_time) {
                alert('Start time must be before end time.');
                return false;
            }
            return true;
        }
    </script>
</head>
<body>

<form method="POST" onsubmit="return validateForm()">
    <label for="start_time">Start Time:</label>
    <input type="datetime-local" id="start_time" name="start_time" required>
    <br><br>
    <label for="end_time">End Time:</label>
    <input type="datetime-local" id="end_time" name="end_time" required>
    <br><br>
    <button type="submit" name="submit">Submit</button>
</form>

<table>
    <tr>
        <th>Start Time</th>
        <th>End Time</th>
        <th>Duration</th>
    </tr>
    <?php
    $result = $conn->query("SELECT start_time, end_time, duration FROM time_logs WHERE user_id = 1 ORDER BY start_time DESC");
    foreach ($result as $row) {
        echo "<tr>
                <td>{$row['start_time']}</td>
                <td>{$row['end_time']}</td>
                <td>{$row['duration']}</td>
              </tr>";
    }
    ?>
</table>

</body>
</html>
