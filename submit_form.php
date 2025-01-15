<?php
// submit_form.php
header('Content-Type: application/json');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');

try {
    // Get JSON input
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    // Validate inputs
    if (empty($data['name']) || empty($data['email']) || empty($data['message'])) {
        throw new Exception('All fields are required');
    }

    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        throw new Exception('Invalid email format');
    }

    // Process the form submission here
    // Add your email sending or database storage logic here
    /*
    $to = "your-email@example.com";
    $subject = "New Contact Form Submission";
    $message = "Name: " . $data['name'] . "\n";
    $message .= "Email: " . $data['email'] . "\n";
    $message .= "Message: " . $data['message'];
    $headers = "From: " . $data['email'];

    mail($to, $subject, $message, $headers);
    */
    
    echo json_encode([
        'success' => true,
        'message' => 'Message sent successfully'
    ]);

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>