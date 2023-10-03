<!DOCTYPE html>
<html>
<head>
    <title>Edit Service Data</title>
    <!-- Include Bootstrap CSS (optional) -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
 
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
<h1 class="mt-3">Edit Service Data</h1>
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

    $sql = "SELECT * FROM services WHERE id = $service_id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Handle the form submission and update the database record
            $newItem = $_POST["item"];
            $newService_type = $_POST["service_type"];
            $newDescription = $_POST["description"];
            $newVendor = $_POST["vendor"];
            $newCost = $_POST["cost"];
            $newConfiguration = $_POST["configuration"];
            $newSubtotal = $_POST["subtotal"];
            $newVat = $_POST["vat"];
            $newVat_value = $_POST["vat_value"];
            $newTotal_cost = $_POST["total_cost"];
            $newCurrency = $_POST["currency"];
            $newRenewal_date = $_POST["renewal_date"];
            $newExpiry_date = $_POST["expiry_date"];
            $newplan = $_POST["plan"];

            // Repeat this for other fields you want to update

            $updateSql = "UPDATE services SET item='$newItem' ,
             service_type='$newService_type', 
            description='$newDescription', 
            vendor='$newVendor', 
            cost='$newCost', 
            configuration='$newConfiguration', 
            subtotal='$newSubtotal', 
            vat='$newVat', 
            vat_value='$newVat_value', 
            total_cost='$newTotal_cost', 
            currency='$newCurrency', 
            renewal_date='$newRenewal_date', 
            expiry_date='$newExpiry_date', 
            plan='$newplan' 
            WHERE id=$service_id";
            // Repeat this for other fields you want to update

            if ($conn->query($updateSql) === TRUE) {
                echo "Record updated successfully";
            } else {
                echo "Error updating record: " . $conn->error;
            }
        }
      
        
       
        echo '<form method="POST" action="" class="mt-3 row g-3">'; // Removed the action attribute to submit to the same page
        echo '<div class="col-md-6">';
        echo '<label for="item">Item:</label>';
        echo '<input type="text" class="form-control" id="item" name="item" value="' . $row["item"] . '">';
        echo '</div>';
        echo '<div class="col-md-6">';
        echo '<label for="service_type">Service Type:</label>';
        echo '<input type="text" class="form-control" id="service_type" name="service_type" value="'. $row["service_type"]. '
        ">';
        echo '</div>';
        echo '<div class="col-md-12">';
        echo '<label for="description">Description:</label>';
        echo '<input type="text" class="form-control" id="description" name="description" value="'. $row["description"]. '">';
        echo '</div>';
        echo '<div class="col-md-12">';
        echo '<label for="vendor">Vendor:</label>';
        echo '<input type="text" class="form-control" id="vendor" name="vendor" value="'. $row["vendor"]. '">';
        echo '</div>';
        echo '<div class="col-md-4">';
        echo '<label for="cost">Cost:</label>';
        echo '<input type="text" class="form-control" id="cost" name="cost" value="'. $row["cost"]. '">';
        echo '</div>';
        echo '<div class="col-md-4">';
        echo '<label for="configuration">Configuration:</label>';
        echo '<input type="text" class="form-control" id="configuration" name="configuration" value="'. $row["configuration"]. '">';
        echo '</div>';
        echo '<div class="col-md-4">';
        echo '<label for="subtotal">Subtotal:</label>';
        echo '<input type="text" class="form-control" id="subtotal" name="subtotal" value="'. $row["subtotal"]. '">';
        echo '</div>';
        echo '<div class="col-md-4">';
        echo '<label for="vat">Vat:</label>';
        echo '<input type="text" class="form-control" id="vat" name="vat" value="'. $row["vat"]. '">';
        echo '</div>';
        echo '<div class="col-md-4">';
        echo '<label for="vat_value">Vat Value:</label>';
        echo '<input type="text" class="form-control" id="vat_value" name="vat_value" value="'. $row["vat_value"]. '">';
        echo '</div>';
        echo '<div class="col-md-4">';
        echo '<label for="total_cost">Total Cost:</label>';
        echo '<input type="text" class="form-control" id="total_cost" name="total_cost" value="'. $row["total_cost"]. '">';
        echo '</div>';
        echo '<div class="col-md-3">';
        echo '<label for="currency">Currency:</label>';
        echo '<input type="text" class="form-control" id="currency" name="currency" value="'. $row["currency"]. '">';
        echo '</div>';
        echo '<div class="col-md-3">';
        echo '<label for="renewal_date">Renewal Date:</label>';
        echo '<input type="text" class="form-control" id="renewal_date" name="renewal_date" value="'. $row["renewal_date"]. '">';
        echo '</div>';
        echo '<div class="col-md-3">';
        echo '<label for="expiry_date">Expiry Date:</label>';
        echo '<input type="text" class="form-control" id="expiry_date" name="expiry_date" value="'. $row["expiry_date"]. '">';
        echo '</div>';
        echo '<div class="col-md-3">';
        echo '<label for="plan">Plan:</label>';
        echo '<input type="text" class="form-control" id="plan" name="plan" value="'. $row["plan"]. '">';
        echo '</div>';




      
        
        echo '<div class="col-md-6 mt-3">';
        echo '<a href="display.php" class="btn btn-secondary ">Back</a>';
        echo '</div>';
        echo '<div class="col-md-6 mt-3">';
        echo '<button type="submit" class="btn btn-primary float-right">Update</button>';
        echo '</div>';
      
        
        echo '</form>';
        echo '</div>';
    } else {
        echo '<div class="container mt-4">';
        echo '<h2>Edit Service Data</h2>';
        echo "Service not found.";
        echo '</div>';
    }
} else {
    echo '<div class="container mt-4">';
    echo '<h2>Edit Service Data</h2>';
    echo "Service ID not provided.";
    echo '</div>';
}

$conn->close();

?>

</body>
</html>
