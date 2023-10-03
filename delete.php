<!DOCTYPE html>
<html>
<head>
    <title>Delete Service Data</title>
    <!-- Include Bootstrap CSS (optional) -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
<?php
$servername = "localhost";
$username = "root";
$password = "safaricom";
$dbname = "service_data";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET["id"])) {
    $service_id = $_GET["id"];

    // Check if the service record exists
    $checkSql = "SELECT * FROM services WHERE id = $service_id";
    $checkResult = $conn->query($checkSql);

    if ($checkResult->num_rows == 1) {
        // Service record exists, proceed with deletion
        $deleteSql = "DELETE FROM services WHERE id = $service_id";

        if ($conn->query($deleteSql) === TRUE) {
            echo '<div class="container mt-4">';
            echo '<h2>Delete Service Data</h2>';
            echo '<p>Service record with ID ' . $service_id . ' has been successfully deleted.</p>';
            echo '<a href="display.php" class="btn btn-primary">Back to Service Data</a>';
            echo '</div>';
        } else {
            echo '<div class="container mt-4">';
            echo '<h2>Delete Service Data</h2>';
            echo '<p>Error deleting service record: ' . $conn->error . '</p>';
            echo '<a href="display.php" class="btn btn-primary">Back to Service Data</a>';
            echo '</div>';
        }
    } else {
        // Service record does not exist
        echo '<div class="container mt-4">';
        echo '<h2>Delete Service Data</h2>';
        echo '<p>Service record with ID ' . $service_id . ' not found.</p>';
        echo '<a href="display.php" class="btn btn-primary">Back to Service Data</a>';
        echo '</div>';
    }
} else {
    echo '<div class="container mt-4">';
    echo '<h2>Delete Service Data</h2>';
    echo '<p>Service ID not provided.</p>';
    echo '<a href="display.php" class="btn btn-primary">Back to Service Data</a>';
    echo '</div>';
}

$conn->close();
?>
</body>
</html>
