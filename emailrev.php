<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Collect form data
    $sender_name = htmlspecialchars($_POST['sender_name']);
    $sender_email = htmlspecialchars($_POST['sender_email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // Collect file attachment
    $attachment = $_FILES['attachment'];
    
    // Recipient email
    $to = "shinsskibidi@gmail.com"; // Replace with your email address
    
    // Create a boundary string
    $boundary = md5(time());
    
    // Email headers
    $headers = "From: $sender_name <$sender_email>\r\n";
    $headers .= "Reply-To: $sender_email\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";
    
    // Email body
    $message_body = "--$boundary\r\n";
    $message_body .= "Content-Type: text/plain; charset=\"UTF-8\"\r\n";
    $message_body .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    $message_body .= "Name: $sender_name\r\n";
    $message_body .= "Email: $sender_email\r\n";
    $message_body .= "Subject: $subject\r\n";
    $message_body .= "Message: $message\r\n\r\n";
    
    // Check if a file is uploaded
    if ($attachment['error'] == UPLOAD_ERR_OK) {
        // Get file content and encode it
        $file_name = $attachment['name'];
        $file_type = $attachment['type'];
        $file_content = chunk_split(base64_encode(file_get_contents($attachment['tmp_name'])));
        
        // Attachment part
        $message_body .= "--$boundary\r\n";
        $message_body .= "Content-Type: $file_type; name=\"$file_name\"\r\n";
        $message_body .= "Content-Disposition: attachment; filename=\"$file_name\"\r\n";
        $message_body .= "Content-Transfer-Encoding: base64\r\n\r\n";
        $message_body .= "$file_content\r\n\r\n";
    }
    
    // End boundary
    $message_body .= "--$boundary--";
    
    // Attempt to send the email
    if (mail($to, $subject, $message_body, $headers)) {
        // Email sent successfully
        echo '<script>alert("Message sent successfully."); window.location.href = "ContactUs.php";</script>';
        exit;
    } else {
        // Email not sent
        echo '<script>alert("Message could not be sent. Please try again later."); window.location.href = "ContactUs.php";</script>';
        exit;
    }
}
?>
