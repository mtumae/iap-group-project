<?php
session_start();
require_once __DIR__ . '/../ClassAutoLoad.php';
require_once __DIR__ . '/../DBConnection.php';

// Check if the session variable for authorization is set
if (!isset($_SESSION['pending_reset_user_id'])) {
    header("Location: /IAP-GROUP-PROJECT/index.php?form=login&error=UnauthorizedReset");
    exit();
}

$new_password = $_POST['new_password'] ?? '';
$confirm_password = $_POST['confirm_password'] ?? '';
$user_id = $_SESSION['pending_reset_user_id'];

// In new_password_action.php
if (empty($new_password) || $new_password !== $confirm_password) {
    // This line redirects back to the form with the specific error code
    header("Location: /IAP-GROUP-PROJECT/index.php?form=newpassword&error=PasswordsDoNotMatch");
    exit();
}
$db = new database($conf);
$conn = $db->connect();

try {
    // 1. Hash the new password
    $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

    // 2. Update the user's password using the authorized user ID
    $db->query("UPDATE users SET password = ? WHERE id = ?",
        [$hashed_password, $user_id]);

    // 3. Clear the session authorization variable
    unset($_SESSION['pending_reset_user_id']);

    // 4. Redirect to login with success message
    header("Location: /IAP-GROUP-PROJECT/index.php?form=login&message=PasswordResetSuccess");
    exit();

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}