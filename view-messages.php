<?php
// view-messages.php - View all received messages (for you to read her responses)

// Simple password protection
$password = "temultiamoinfinito"; // Change this to a secure password
$entered_password = isset($_POST['password']) ? $_POST['password'] : '';

if ($entered_password !== $password && !isset($_SESSION['authenticated'])) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>View Messages - Password Required</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <div class="container">
            <div class="card" style="max-width: 400px; margin: 100px auto; text-align: center;">
                <h2>Enter Password</h2>
                <form method="POST" style="margin-top: 20px;">
                    <div class="form-group">
                        <input type="password" name="password" placeholder="Enter password" required style="width: 100%; padding: 15px; border: 2px solid #f8bbd9; border-radius: 10px; font-size: 1rem;">
                    </div>
                    <button type="submit" class="submit-btn">View Messages</button>
                </form>
            </div>
        </div>
    </body>
    </html>
    <?php
    exit;
}

// If password is correct, show messages
session_start();
$_SESSION['authenticated'] = true;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Her Messages - I'm Sorry</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <h2>Messages from Her 💕</h2>
            
            <?php
            if (file_exists('messages.txt')) {
                $messages = file_get_contents('messages.txt');
                if (!empty($messages)) {
                    echo '<div style="background: #f9f9f9; padding: 20px; border-radius: 10px; text-align: left; white-space: pre-line; font-family: monospace;">';
                    echo htmlspecialchars($messages);
                    echo '</div>';
                } else {
                    echo '<p style="color: #666; font-style: italic;">No messages yet.</p>';
                }
            } else {
                echo '<p style="color: #666; font-style: italic;">No messages file found.</p>';
            }
            ?>
            
            <div style="margin-top: 30px; text-align: center;">
                <a href="index.html" style="background: linear-gradient(45deg, #e91e63, #f06292); color: white; text-decoration: none; padding: 15px 30px; border-radius: 50px; display: inline-block; margin-right: 10px;">
                    ← Back to Apology
                </a>
                <a href="?logout=1" style="background: #666; color: white; text-decoration: none; padding: 15px 30px; border-radius: 50px; display: inline-block;">
                    Logout
                </a>
            </div>
        </div>
    </div>
</body>
</html>

<?php
// Handle logout
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: view-messages.php');
    exit;
}
?>