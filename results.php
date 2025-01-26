<?php
// Database connection
$host = 'localhost';
$dbName = 'image_classification';
$username = 'root';
$password = ''; // Update with your MySQL password
$conn = new mysqli($host, $username, $password, $dbName);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch analytics data
$query = "SELECT model_name, accuracy, loss, upload_date FROM classification_results ORDER BY upload_date DESC LIMIT 10";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    echo "<table class='table'>";
    echo "<thead><tr><th>Model Name</th><th>Accuracy</th><th>Loss</th><th>Date</th></tr></thead><tbody>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['model_name']}</td>
                <td>{$row['accuracy']}</td>
                <td>{$row['loss']}</td>
                <td>{$row['upload_date']}</td>
              </tr>";
    }

    echo "</tbody></table>";
} else {
    echo "No analytics available.";
}

$conn->close();
?>
