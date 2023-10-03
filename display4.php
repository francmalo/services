<!DOCTYPE html>
<html>
<head>
    <title>Enter Service Data</title>
    <!-- Include Bootstrap CSS (optional) -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <nav class="navbar navbar-light bg-light justify-content-between">
        <a class="navbar-brand">Service Data</a>
        <form class="form-inline" method="GET" action="search.php">
            <input class="form-control mr-sm-2" id="search" name="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </nav>
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

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_id"])) {
        // Handle the deletion here
        $delete_id = $_POST["delete_id"];
        $sql = "DELETE FROM services WHERE id = $delete_id";
        if ($conn->query($sql) === TRUE) {
            echo '<div class="alert alert-success" role="alert">Record deleted successfully.</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Error deleting record: ' . $conn->error . '</div>';
        }
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
                        <th><a href="#" onclick="sortTable(\'item\')">Item</a></th>
                        <th><a href="#" onclick="sortTable(\'service_type\')">Service Type</a></th>
                        <!-- Add headers for other columns here -->
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
                    <td>' . $row["item"] . '</td>
                    <td>' . $row["service_type"] . '</td>
                    <td>' . $row["description"] . '</td>
                    <td>' . $row["vendor"] . '</td>
                    <td>' . $row["cost"] . '</td>
                    <td>' . $row["configuration"] . '</td>
                    <td>' . $row["subtotal"] . '</td>
                    <td>' . $row["vat"] . '</td>
                    <td>' . $row["vat_value"] . '</td>
                    <td>' . $row["total_cost"] . '</td>
                    <td>' . $row["currency"] . '</td>
                    <td>' . $row["renewal_date"] . '</td>
                    <td>' . $row["expiry_date"] . '</td>
                    <td>' . $row["plan"] . '</td>
                    <td>
                        <a href="view.php?id=' . $row["id"] . '"><i class="fas fa-eye text-primary"></i></a>
                        <a href="edit.php?id=' . $row["id"] . '"><i class="fas fa-edit text-success"></i></a>
                        <a href="javascript:void(0);" onclick="deleteRecord(' . $row['id'] . ')"><i class="fas fa-trash-alt text-danger"></i></a>
                    </td>
                </tr>';
        }

        echo '</tbody></table>';
    } else {
        echo '<div class="container mt-4">';
        echo '<h2>Service Data</h2>';
        echo "No records found.";
        echo '</div>';
    }

    // Close the database connection
    $conn->close();

    // Pagination
    $totalPages = ceil($totalItems / $itemsPerPage);

    echo '<div class="container mt-4">';
    echo '<ul class="pagination justify-content-center">';

    // Previous Button
    if ($page > 1) {
        $prevPage = $page - 1;
        echo '<li class="page-item"><a class="page-link" href="?page=' . $prevPage . '">Previous</a></li>';
    } else {
        echo '<li class="page-item disabled"><span class="page-link">Previous</span></li>';
    }

    // Page Numbers
    for ($i = 1; $i <= $totalPages; $i++) {
        echo '<li class="page-item ' . ($i == $page ? 'active' : '') . '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
    }

    // Next Button
    if ($page < $totalPages) {
        $nextPage = $page + 1;
        echo '<li class="page-item"><a class="page-link" href="?page=' . $nextPage . '">Next</a></li>';
    } else {
        echo '<li class="page-item disabled"><span class="page-link">Next</span></li>';
    }

    echo '</ul>';
    echo '</div>';
    ?>

    <script>
        function deleteRecord(id) {
            var confirmation = confirm('Are you sure you want to delete this record?');
            if (confirmation) {
                // If confirmed, submit a form with the delete_id to handle the deletion
                var form = document.createElement('form');
                form.method = 'post';
                form.action = 'display.php';
                var input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'delete_id';
                input.value = id;
                form.appendChild(input);
                document.body.appendChild(form);
                form.submit();
            }
        }

        // Function to sort the table by a given column
        function sortTable(columnName) {
            var table, rows, switching, i, x, y, shouldSwitch;
            table = document.querySelector("table");
            switching = true;

            while (switching) {
                switching = false;
                rows = table.rows;

                for (i = 1; i < (rows.length - 1); i++) {
                    shouldSwitch = false;

                    x = rows[i].querySelector("td:nth-child(" + (columnNameIndex(columnName) + 1) + ")");
                    y = rows[i + 1].querySelector("td:nth-child(" + (columnNameIndex(columnName) + 1) + ")");

                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                }

                if (shouldSwitch) {
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                }
            }
        }

        // Function to get the index of the column to be sorted
        function columnNameIndex(columnName) {
            var headers = document.querySelectorAll("thead th");
            for (var i = 0; i < headers.length; i++) {
                if (headers[i].textContent === columnName) {
                    return i;
                }
            }
            return -1; // Column not found
        }
    </script>
</body>
</html>
