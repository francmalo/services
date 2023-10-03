
<!DOCTYPE html>
<html>
<head>
    <title>Enter Service Data</title>
      <!-- Include Bootstrap CSS (optional) -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
     
</head>

<?php
// Connect to the database (configure database connection)
$servername = "localhost";
$username = "root";
$password = "safaricom";
$dbname = "service_data";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch the total number of items
$totalItemsQuery = "SELECT COUNT(*) as total FROM services";
$totalItemsResult = $conn->query($totalItemsQuery);

if ($totalItemsResult) {
    $totalItemsRow = $totalItemsResult->fetch_assoc();
    $totalItems = $totalItemsRow["total"];
} else {
    $totalItems = 0;
}


// Pagination settings
$itemsPerPage = 10; // Number of items per page
if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 1;
}
$offset = ($page - 1) * $itemsPerPage;

// Query to fetch data with pagination
$sql = "SELECT * FROM services LIMIT $itemsPerPage OFFSET $offset";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Item</th>
                    <th>Service Type</th>
                    <th>Description</th>
                    <th>Vendor</th>
                    <th>Cost</th>
                    <th>Configuration</th>
                    <th>SubTotal</th>
                    <th>VAT</th>
                    <th>VAT Value</th>
                    <th>Total Cost</th>
                    <th>Currency</th>
                    <th>Renewal Date</th>
                    <th>Expiry Date</th>
                    <th>Plan</th>
                    <th>Actions</th>

                </tr>
            </thead>
            <tbody>';

    while ($row = $result->fetch_assoc()) {
        echo '<tr>
        <td>' . $row["id"] . '</td>
        <td>' . $row["item"] . '</td>
        <td>' . $row["service_type"] . '</td>
        <td>' . $row["description"] . '</td>
        <td>' . $row["vendor"] . '</td>
        <td>'. $row["cost"]. '</td>
        <td>'. $row["configuration"]. '</td>
        <td>'. $row["subtotal"]. '</td>
        <td>'. $row["vat"]. '</td>
        <td>'. $row["vat_value"]. '</td>
        <td>'. $row["total_cost"]. '</td>
        <td>'. $row["currency"]. '</td>
        <td>'. $row["renewal_date"]. '</td>
        <td>'. $row["expiry_date"]. '</td>
        <td>'. $row["plan"]. '</td>
        <td>
                    <a href="view.php?id=' . $row["id"] . '" class="btn btn-info">View</a>
                    <a href="edit.php?id=' . $row["id"] . '" class="btn btn-warning">Edit</a>
                    <a href="delete.php?id=' . $row["id"] . '" class="btn btn-danger">Delete</a>
                </td>
            </tr>';
    }

    echo '</tbody></table>';
} else {
    echo "No records found.";
}

// Close the database connection
$conn->close();

// Pagination
$totalPages = ceil($totalItems / $itemsPerPage);

echo '<ul class="pagination">';
for ($i = 1; $i <= $totalPages; $i++) {
    echo '<li class="page-item ' . ($i == $page ? 'active' : '') . '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
}
echo '</ul>';
?>
