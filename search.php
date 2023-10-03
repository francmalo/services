<!DOCTYPE html>
<html>
<head>
    <title>Enter Service Data</title>
      <!-- Include Bootstrap CSS (optional) -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

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

if (isset($_GET["search"])) {
    $search = $_GET["search"];

    // Query to search for records based on the search query
    $sql = "SELECT * FROM services WHERE 
        item LIKE '%$search%' OR
        service_type LIKE '%$search%' OR
        description LIKE '%$search%' OR
        vendor LIKE '%$search%' OR
        cost LIKE '%$search%' OR
        configuration LIKE '%$search%' OR
        subtotal LIKE '%$search%' OR
        vat LIKE '%$search%' OR
        vat_value LIKE '%$search%' OR
        total_cost LIKE '%$search%' OR
        currency LIKE '%$search%' OR
        renewal_date LIKE '%$search%' OR
        expiry_date LIKE '%$search%' OR
        plan LIKE '%$search%'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
     
        echo '<h2>Search Results</h2>';
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
                        <th>Action</th>
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
                        <a href="view.php?id=' . $row["id"] . '"><i class="fas fa-eye text-primary"></i></a>
                        <a href="edit.php?id=' . $row["id"] . '"><i class="fas fa-edit text-success"></i></a>
                        <a href="delete.php?id=' . $row["id"] . '"><i class="fas fa-trash-alt text-danger"></i></a>
                    </td>
                </tr>';
        }

        echo '</tbody></table>';

    } else {
        echo '<div class="container mt-4">';
        echo '<h2>Search Results</h2>';
        echo "No records found.";
        echo '</div>';
    }
} else {
    // If the search query is not set, display a message or redirect to the search page
    header("Location: index.php"); // Replace with the correct URL if needed
}

// Close the database connection
$conn->close();
?>
