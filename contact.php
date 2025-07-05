<?php
// contact.php - Handle form submission

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $message = isset($_POST['message']) ? trim($_POST['message']) : '';
    
    // Validate input
    if (empty($message)) {
        $error = "Please enter a message.";
    } else {
        // Here you can process the message
        // For example: save to database, send email, etc.
        
        // For now, we'll just save to a text file
        $timestamp = date('Y-m-d H:i:s');
        $log_entry = "[$timestamp] Message: $message\n";
        
        // Save to messages.txt file
        file_put_contents('messages.txt', $log_entry, FILE_APPEND | LOCK_EX);
        
        $success = "Thank you for your message. I received it and will respond soon.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message Received - I'm Sorry</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="card" style="max-width: 600px; margin: 50px auto; text-align: center;">
            <?php if (isset($success)): ?>
                <h2 style="color: #4CAF50;">Message Received! 💕</h2>
                <p style="font-size: 1.2rem; color: #333; margin: 20px 0;">
                    <?php echo htmlspecialchars($success); ?>
                </p>
                <div style="background: #e8f5e8; padding: 20px; border-radius: 10px; margin: 20px 0;">
                    <p><strong>Your message:</strong></p>
                    <p style="font-style: italic; color: #666;">
                        "<?php echo htmlspecialchars($message); ?>"
                    </p>
                </div>
            <?php elseif (isset($error)): ?>
                <h2 style="color: #f44336;">Oops! 😔</h2>
                <p style="color: #f44336; font-size: 1.1rem;">
                    <?php echo htmlspecialchars($error); ?>
                </p>
            <?php else: ?>
                <h2>Something went wrong</h2>
                <p>Please try again.</p>
            <?php endif; ?>
            
            <div style="margin-top: 30px;">
                <a href="index.html" style="background: linear-gradient(45deg, #e91e63, #f06292); color: white; text-decoration: none; padding: 15px 30px; border-radius: 50px; display: inline-block; transition: all 0.3s ease;">
                    ← Back to Apology
                </a>
            </div>
            
            <div style="margin-top: 20px; font-size: 2rem;">
                💕 I Love You 💕
            </div>
        </div>
    </div>
</body>
</html>