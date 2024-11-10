<?php
include('constants.php');

$phoneNumber = isset($_SESSION['email']) ? $_SESSION['email'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Form</title>
    <style>
body {
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 0;
    font-family: Arial, sans-serif;
}

.container {
    width: 80%;
    max-width: 800px;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 8px;
    background-color: #f9f9f9;
    overflow: hidden; /* Ensure content inside .container doesn't overflow */
}


        .error {
            color: red;
        }

        fieldset {
            margin-bottom: 20px;
        }

        label {
            display: inline-block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="number"],
        input[type="month"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 10px;
        }

        button[type="button"] {
            background-color: #ccc;
        }

        button[type="submit"] {
            background-color: #007BFF;
        }

        button:hover {
            opacity: 0.8;
        }
        .receipt {
            width: 80%;
            margin: 0 auto;

            padding: 20px;
            font-family: Arial, sans-serif;
        }

        .receipt h2 {
            text-align: center;
        }

        .receipt table {
            width: 100%;
            border-collapse: collapse;
        }

        .receipt th, .receipt td {
            border: 1px solid #000;
            padding: 10px;
            text-align: left;
        }

        .receipt th {
            background-color: #f2f2f2;
        }

        .receipt td {
            text-align: right;
        }

        .receipt td:first-child {
            text-align: left;
        }
    </style>
</head>
<body>
    
    <div class="container"style="margin-top:20px;">
        <h1 style="text-align: center;">Payment Form</h1>
        <form id="paymentForm" action="process_payment.php" method="POST" onsubmit="return confirmPayment()">
            <fieldset>
                <legend>Order Summary:</legend>
                <?php


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

                    // fetch products from 'cart' table
                    $sql = "SELECT name, price, quantity, size FROM cart";
                    $result = $conn->query($sql);
                    
                    if ($result->num_rows > 0) {
                        $total = 0;
                        $items = []; // Array to store items with quantities
                    
                        echo "<div class='receipt'>";
                        echo "<table>";
                        echo "<tr><th>Item</th><th>Price</th><th>Quantity</th><th>Size</th><th>Total</th></tr>";
                    
                        // Output data of each row
                        while ($row = $result->fetch_assoc()) {
                            $itemTotal = $row['price'] * $row['quantity'];
                            $total += $itemTotal;
                    
                            // Build the item string with quantity
                            $itemName = "{$row['name']} ({$row['quantity']})";
                            $items[] = $itemName; // Add item to the array
                    
                            echo "<tr>";
                            echo "<td>{$row['name']}</td>";
                            echo "<td>₱{$row['price']}</td>";
                            echo "<td>{$row['quantity']}</td>";
                            echo "<td>{$row['size']}</td>";
                            echo "<td>₱{$itemTotal}</td>";
                            echo "</tr>";
                        }
                    
                        echo "<tr><td colspan='4'><strong>Total:</strong></td><td><strong>₱{$total}</strong></td></tr>";
                        echo "</table>";
                    
                        // Store items and total in session variables
                        $_SESSION['items'] = $items;
                        $_SESSION['total'] = $total;
                    
                        echo "</div>";
                    } else {
                        echo "No items in cart.";
                    }
                    

                    $conn->close();
                ?>
            </fieldset>

            <fieldset>
                <legend>Select Payment Method:</legend>
                <input type="radio" id="gcash" name="paymentMethod" value="Gcash" required>
                <label for="gcash">Gcash</label><br>
                <input type="radio" id="paymaya" name="paymentMethod" value="Paymaya">
                <label for="paymaya">Paymaya</label><br>
                <input type="radio" id="cashOnDelivery" name="paymentMethod" value="CashOnDelivery">
                <label for="cashOnDelivery">Cash</label><br><br>
            </fieldset>

            <fieldset>
                <legend>Select Delivery Method:</legend>
                <input type="radio" id="pickUp" name="deliveryMethod" value="PickUp" required>
                <label for="pickUp">Pick Up</label><br>
                <input type="radio" id="standardDelivery" name="deliveryMethod" value="StandardDelivery">
                <label for="standardDelivery">Standard Delivery</label><br><br>
            </fieldset>

            <div id="StandardDelivery" style="display: none;">
                <label for="StandardDeliverySelect">Select Delivery Address:</label>
                <select id="StandardDeliverySelect" name="StandardDelivery" required>
                    <option value="">--Please Select Delivery Address--</option>
                    <option value="<?php echo $_SESSION['client_address']; ?>"><?php echo $_SESSION['client_address']; ?></option>
                    <option value="custom">Enter a Different Address</option>
                </select><br><br>

                <div id="customAddress" style="display: none;">
                    <label for="customAddressInput">Enter Secondary Address:</label>
                    <input type="text" id="customAddressInput" name="customAddressInput">
                </div>
            </div>

            <div id="mobileDetails" style="display: none;">
                <label for="phoneNumber">Phone Number:</label>
                <input type="tel" id="phoneNumber" name="phoneNumber" pattern="\d{11}" value="<?php echo $_SESSION['Phone_num'] ?>" title="Phone number must be 11 digits" required><br><br>
            </div>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $_SESSION['email']; ?>" required><br><br>

            <label for="amount">Amount:</label>
            <input type="number" id="amount" name="amount" required min="<?php echo $total ?>" step="1" title="Enter a valid amount"><br><br>

            <div style="text-align: center;">
                <button type="submit">Submit Payment</button>
                <button type="button" onclick="window.location.href='products.php'">Return to Menu</button>
            </div>
        </form>
    </div>

    <script>
document.addEventListener('DOMContentLoaded', function () {
    const StandardDeliverySelect = document.getElementById('StandardDeliverySelect');
    const customAddressDiv = document.getElementById('customAddress');
    const deliveryMethodRadios = document.querySelectorAll('input[name="deliveryMethod"]');
    const deliveryAddressInput = document.getElementById('deliveryAddress'); // Assuming this is where you want to display the delivery address

    // Function to toggle custom address input based on selection
    StandardDeliverySelect.addEventListener('change', function() {
        const selectValue = this.value;
        if (selectValue === 'custom') {
            customAddressDiv.style.display = 'block';
        } else {
            customAddressDiv.style.display = 'none';
        }
    });

    // Function to update delivery address based on delivery method selection
    function updateDeliveryAddress() {
        deliveryMethodRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.value === 'PickUp') {
                    deliveryAddressInput.value = 'Pick Up'; // Update with desired pickup address text or logic
                } else {
                    deliveryAddressInput.value = StandardDeliverySelect.value; // Update with selected standard delivery address
                }
            });
        });
    }

    // Function to toggle details based on selected payment method
    function toggleDetails() {
        const selectedPayment = document.querySelector('input[name="paymentMethod"]:checked');
        if (selectedPayment && (selectedPayment.value === 'Gcash' || selectedPayment.value === 'Paymaya')) {
            mobileDetails.style.display = 'block';
            document.getElementById('phoneNumber').required = true;
        } else {
            mobileDetails.style.display = 'none';
            document.getElementById('phoneNumber').required = false;
        }
    }

    // Function to toggle pickup locations based on selected delivery method
    function togglePickupLocations() {
        const selectedDelivery = document.querySelector('input[name="deliveryMethod"]:checked');
        if (selectedDelivery && selectedDelivery.value === 'StandardDelivery') {
            StandardDelivery.style.display = 'block';
            document.getElementById('StandardDeliverySelect').required = true;
        } else {
            StandardDelivery.style.display = 'none';
            document.getElementById('StandardDeliverySelect').required = false;
        }
    }

    // Function to update form state on load and on change
    function updateForm() {
        toggleDetails();
        togglePickupLocations();
        updateDeliveryAddress();
    }

    // Event listeners for changes in payment and delivery methods
    document.querySelectorAll('input[name="paymentMethod"]').forEach(radio => {
        radio.addEventListener('change', updateForm);
    });

    document.querySelectorAll('input[name="deliveryMethod"]').forEach(radio => {
        radio.addEventListener('change', updateForm);
    });

    // Initial update of form state on page load
    updateForm();

});

// Function to show payment confirmation
function confirmPayment() {
    return confirm('Are you sure you want to submit the payment?');
}
</script>


</body>
</html>
