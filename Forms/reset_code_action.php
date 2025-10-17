<?php
session_start();
require_once __DIR__ . '/../ClassAutoLoad.php';
require_once __DIR__ . '/../DBConnection.php';

$entered_code = trim($_POST['reset_code'] ?? '');
$current_time = date('Y-m-d H:i:s');

if (!preg_match('/^\d{6}$/', $entered_code)) {
    // Redirect back with an error for invalid format
    header("Location: /IAP-GROUP-PROJECT/index.php?form=resetcode&error=InvalidCodeFormat");
    exit();
}

$db = new database($conf);
$conn = $db->connect();

try {
    // 1. Check database for valid, unexpired code
    $stmt = $db->query("SELECT id, email FROM users WHERE reset_code = ? AND reset_code_expiry > ?",
        [$entered_code, $current_time]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // 2. Code is valid: clear the code and set session for final step authorization
        $db->query("UPDATE users SET reset_code = NULL, reset_code_expiry = NULL WHERE id = ?",
            [$user['id']]);

        // Store user ID in session to authorize the password change
        $_SESSION['pending_reset_user_id'] = $user['id'];
        unset($_SESSION['reset_pending_email']); // Clear optional email storage

        // 3. Redirect to new password form
        header("Location: /IAP-GROUP-PROJECT/index.php?form=newpassword");
        exit();

    // In reset_code_action.php:
// ...
} else {
    // 4. Invalid or expired code
    header("Location: /IAP-GROUP-PROJECT/index.php?form=resetcode&error=InvalidOrExpiredCode");
    exit();
}

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}