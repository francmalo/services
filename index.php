<!DOCTYPE html>
<html>
<head>
    <title>Enter Service Data</title>
      <!-- Include Bootstrap CSS (optional) -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <style>
        /* Custom CSS to make the form more compact */
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        body{color: #000;
            overflow-x: hidden;
            background-image: url("images/evie-s-bSVGnUCk4tk-unsplash\ \(1\).jpg");
            background-repeat: no-repeat;
            background-size:cover}
        form{
            background-color: white;
            padding: 20px 2px;
            margin-top: 60px;
            margin-bottom: 60px;
            border: none !important;
            box-shadow: 0 6px 12px 0 rgba(0, 0, 0, 0.2);
            border-radius: 15px;
        }
        /* Define a CSS class for success messages */
.success-message {
    color: green;
}

       
    </style>
</head>


<body>
<div class="container">
        <h1 class="mt-3">Enter Service Data</h1>
       
    <?php
    // Initialize variables with default values
    $item = "";
    $service_type = "";
    $description = "";
    $vendor = "";
    $cost = "";
    $configuration = "";
    $subtotal = "";
    $vat = "";
    $vat_value = "";
    $total_cost = "";
    $currency = "";
    $renewal_date = "";
    $expiry_date = "";
    $plan = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $item = $_POST["item"];
        $service_type = $_POST["service_type"];
        $description = $_POST["description"];
        $vendor = $_POST["vendor"];
        $cost = $_POST["cost"];
        $configuration = $_POST["configuration"];
        $subtotal = $_POST["subtotal"];
        $vat = $_POST["vat"];
        $vat_value = $_POST["vat_value"];
        $total_cost = $_POST["total_cost"];
        $currency = $_POST["currency"];
        $renewal_date = $_POST["renewal_date"];
        $expiry_date = $_POST["expiry_date"];
        $plan = $_POST["plan"];

        // Establish a database connection (you need to configure this)
        $servername = "localhost";
        $username = "root";
        $password = "safaricom";
        $dbname = "service_data";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Insert data into the database
        $sql = "INSERT INTO services (item, service_type, description, vendor, cost, configuration, subtotal, vat, vat_value, total_cost, currency, renewal_date, expiry_date, plan)
            VALUES ('$item', '$service_type', '$description', '$vendor', '$cost', '$configuration', '$subtotal', '$vat', '$vat_value', '$total_cost', '$currency', '$renewal_date', '$expiry_date', '$plan')";

        if ($conn->query($sql) === TRUE) {
            echo  '<h4 class="success-message">Service added successfully!</h4>';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close the database connection
        $conn->close();
    }
    ?>
   

        <form action="index.php" method="post" class="mt-3 row g-3">
            <!-- Bootstrap form styling -->

          <!-- Item -->
          <div class="col-md-6">
                <label for="item">Item:</label>
                <input type="text" class="form-control" id="item" name="item" required>
            </div>

            <!-- Service Type -->
            <div class="col-md-6">
                <label for="service_type">Service Type:</label>
                <input type="text" class="form-control" id="service_type" name="service_type" required>
            </div>

            <!-- Description -->
            <div class="col-12">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>

            <!-- Vendor -->
            <div class="col-12">
                <label for="vendor">Vendor:</label>
                <input type="text" class="form-control" id="vendor" name="vendor" required>
            </div>

            <!-- Cost -->
            <div class="col-md-4">
                <label for="cost">Cost:</label>
                <input type="text" class="form-control" id="cost" name="cost" required>
            </div>

            <!-- Configuration Charges -->
            <div class="col-md-4">
                <label for="configuration">Configuration Charges:</label>
                <input type="text" class="form-control" id="configuration" name="configuration" required>
            </div>

            <!-- Subtotal -->
            <div class="col-md-4">
                <label for="subtotal">Sub Total:</label>
                <input type="text" class="form-control" id="subtotal" name="subtotal" required>
            </div>

            <!-- VAT (16%) -->
            <div class="col-md-4">
                <label for="vat">VAT:</label>
                <input type="text" class="form-control" id="vat" name="vat" required>
            </div>

            <!-- VAT Value (16% Subtotal) -->
            <div class="col-md-4">
                <label for="vat_value">VAT Value:</label>
                <input type="text" class="form-control" id="vat_value" name="vat_value" required>
            </div>

            <!-- Total Cost (Subtotal + VAT Value) -->
            <div class="col-md-4">
                <label for="total_cost">Total Cost:</label>
                <input type="text" class="form-control" id="total_cost" name="total_cost" required>
            </div>

            <!-- Currency -->
            <div class="col-md-3">
                <label for="currency">Currency:</label>
                <input type="text" class="form-control" id="currency" name="currency" required>
            </div>

            <!-- Renewal Date -->
            <div class="col-md-3">
                <label for="renewal_date">Renewal Date:</label>
                <input type="date" class="form-control" id="renewal_date" name="renewal_date" required>
            </div>

            <!-- Expiry Date -->
            <div class="col-md-3">
                <label for="expiry_date">Expiry Date:</label>
                <input type="date" class="form-control" id="expiry_date" name="expiry_date" required>
            </div>

            <!-- Plan -->
            <div class="col-md-3">
                <label for="plan">Plan:</label>
                <input type="text" class="form-control" id="plan" name="plan" required>
            </div>
            <div class="col-12 mt-3">
            <button type="submit" class="btn btn-primary">Add Service</button>
            </div>
        </form>
    </div>
<script>
    if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
    </script>

</body>
</html>
