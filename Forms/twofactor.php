<?php
session_start();

if (!isset($_SESSION['2fa_code'], $_SESSION['pending_user_id'])) {
    header("Location: /IAP-GROUP-PROJECT/index.php?form=login");
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $entered = trim($_POST['verification_code'] ?? '');

    // Check for exactly 6 digits
    if (!preg_match('/^\d{6}$/', $entered)) {
        $error = "Invalid code format. Please enter a 6-digit number.";
    } elseif ($entered == $_SESSION['2fa_code']) {
        // Move pending data into final session
        $_SESSION['user_id']   = $_SESSION['pending_user_id'];
        $_SESSION['username']  = $_SESSION['pending_username'];
        $_SESSION['email']     = $_SESSION['pending_email'];

        // Clear temporary session values
        unset($_SESSION['2fa_code'], $_SESSION['pending_user_id'], $_SESSION['pending_username'], $_SESSION['pending_email']);

        // Redirect to dashboard
        //header("Location: /IAP_PROJECT/users.php");
        header("Location: /iap-group-project/users.php");
        exit();
    } else {
        $error = "Invalid or expired verification code.";
    }
}
?>

<!-- <!DOCTYPE html>
<html>
<head>
    <title>Two-Factor Authentication</title>
</head>
<body>
    <div style="">
    <h2>Enter 2FA Code</h2>
    <form method="POST">
        <label for="verification_code">Verification Code:</label>
        <input type="text" id="verification_code" name="verification_code" maxlength="6" required>
        <button type="submit">Verify</button>
    </form>

    
</body>
</html> -->
