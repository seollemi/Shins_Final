<?php
include('constants.php');
require_once('tcpdf/tcpdf.php'); // Include the TCPDF library

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

    // Retrieve form data
    $customer_name = $_SESSION['fullname'];
    $items = implode(", ", $_SESSION['items']);
    $total = $_SESSION['total'];
    $payment_method = $_POST['paymentMethod'];
    $delivery_method = $_POST['deliveryMethod'];
    $delivery_address = ($delivery_method == 'StandardDelivery') ? $_POST['StandardDelivery'] : 'Pickup';
    $phone_number = $_POST['phoneNumber'];
    $email = $_POST['email'];
    $amount = $_POST['amount'];
    $order_date = date('Y-m-d H:i:s');
    $username = $_SESSION['username']; // Added username from session

    // Insert data into orders table
    $sql = "INSERT INTO orders (Customer_name, Items, Total, payment_method, delivery_method, delivery_address, phone_number, email, amount, order_date, username)
            VALUES ('$customer_name', '$items', '$total', '$payment_method', '$delivery_method', '$delivery_address', '$phone_number', '$email', '$amount', '$order_date', '$username')";

    if ($conn->query($sql) === TRUE) {
        // New order created successfully, now generate PDF receipt
        $order_id = $conn->insert_id;
        generatePDFReceipt($order_id, $customer_name, $items, $total, $payment_method, $delivery_method, $delivery_address, $phone_number, $email, $amount, $order_date);
        $emptyCartSql = "DELETE FROM cart";
            if ($conn->query($emptyCartSql) === TRUE) {
                echo "Cart emptied successfully.";
            } else {
                echo "Error emptying cart: " . $conn->error;
            }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

// Function to generate PDF receipt
function generatePDFReceipt($order_id, $customer_name, $items, $total, $payment_method, $delivery_method, $delivery_address, $phone_number, $email, $amount, $order_date) {
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // Set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Your Company');
    $pdf->SetTitle('Order Receipt');
    $pdf->SetSubject('Order Receipt');
    $pdf->SetKeywords('TCPDF, PDF, receipt, order');

    // Add a page
    $pdf->AddPage();

    $change = $amount - $total;

    // Set content
    $html = <<<EOD
<h1>Order Receipt</h1>
<p><strong>Order ID:</strong> {$order_id}</p>
<p><strong>Customer Name:</strong> {$customer_name}</p>
<p><strong>Items:</strong> {$items}</p>
<p><strong>Total:</strong> P{$total}</p>
<p><strong>Payment Method:</strong> {$payment_method}</p>
<p><strong>Delivery Method:</strong> {$delivery_method}</p>
<p><strong>Delivery Address:</strong> {$delivery_address}</p>
<p><strong>Phone Number:</strong> {$phone_number}</p>
<p><strong>Email:</strong> {$email}</p>
<p><strong>Amount:</strong> P{$amount}</p>  
<p><strong>Change:</strong> P{$change}</p>
<p><strong>Order Date:</strong> {$order_date}</p>
EOD;

    // Print text using writeHTMLCell()
    $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

    // Close and output PDF document
    $pdf->Output("order_receipt_{$order_id}.pdf", 'D');
}
?>
