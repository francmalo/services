<!DOCTYPE html>
<html>
<head>
    <title>View Service</title>
    <!-- Include Bootstrap CSS (optional) -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Service Details</h2>
        <?php
        // Check if the 'id' parameter is set in the URL
        if (isset($_GET['id'])) {
            // Get the 'id' parameter from the URL
            $serviceId = $_GET['id'];

            // Connect to the database (configure database connection)
            $servername = "localhost";
            $username = "root";
            $password = "safaricom";
            $dbname = "service_data";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Query to fetch service details based on the provided ID
            $sql = "SELECT * FROM services WHERE id = $serviceId";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                // Display service details
                echo '<table class="table table-dark">
                        <tbody>
                           
                            <tr>
                                <th>Item</th>
                                <td>' . $row["item"] . '</td>
                            </tr>
                            <tr>
                                <th>Service Type</th>
                                <td>' . $row["service_type"] . '</td>
                            </tr>
                            <tr>
                                <th>Description</th>
                                <td>' . $row["description"] . '</td>
                            </tr>
                            <tr>
                                <th>Vendor</th>
                                <td>' . $row["vendor"] . '</td>
                            </tr>
                            
                            <tr>
                                <th>Cost</th>
                                <td>' . $row["cost"] . '</td>
                            </tr>
                            <tr>
                                <th>Configuration</th>
                                <td>' . $row["configuration"] . '</td>
                            </tr>
                            <tr>
                                <th>SubTotal</th>
                                <td>' . $row["subtotal"] . '</td>
                            </tr>
                            <tr>
                                <th>VAT</th>
                                <td>' . $row["vat"] . '</td>
                            </tr>
                           
                            <tr>
                                <th>VAT Value</th>
                                <td>' . $row["vat_value"] . '</td>
                            </tr>
                            <tr>
                                <th>Total Cost</th>
                                <td>' . $row["total_cost"] . '</td>
                            </tr>
                            <tr>
                                <th>Currency</th>
                                <td>' . $row["currency"] . '</td>
                            </tr>
                            <tr>
                                <th>Renewal Date</th>
                                <td>' . $row["renewal_date"] . '</td>
                            </tr>
                            <tr>
                                <th>Expiry Date</th>
                                <td>' . $row["total_cost"] . '</td>
                            </tr>
                            <tr>
                                <th>Plan</th>
                                <td>' . $row["plan"] . '</td>
                            </tr>



                           
                           
                        </tbody>
                    </table>';
            } else {
                echo "Service not found.";
            }

            // Close the database connection
            $conn->close();
        } else {
            echo "Invalid service ID.";
        }
        ?>
        <a href="display.php">Back to Service List</a>
    </div>
</body>
</html>
