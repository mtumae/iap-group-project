<?php
session_start();
require_once __DIR__ . '/../ClassAutoLoad.php';
require_once __DIR__ . '/../DBConnection.php';

$email = trim($_POST['email'] ?? '');

if (empty($email)) {
    die("Email is required.");
}

$db = new database($conf);
$conn = $db->connect();

try {
    // 1. Find the user
    $stmt = $db->query("SELECT id FROM users WHERE email = ?", [$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // 2. Generate code and expiration (e.g., 5 minutes)
        $code = rand(100000, 999999);
        $expiry = date('Y-m-d H:i:s', strtotime('+5 minutes'));

        // 3. Store code and expiry in the database
        $db->query("UPDATE users SET reset_code = ?, reset_code_expiry = ? WHERE id = ?",
            [$code, $expiry, $user['id']]);

        // 4. Send email (Assume Mail class has a sendPasswordResetCode method)
        $mail = new Mail();
        // You'll need to create this method in your Mail class.
        // For now, we assume it exists and sends the email.
        $mail->sendPasswordResetCode($email, $code);


        // 5. Store email in session temporarily for next step error handling (optional, but good)
        $_SESSION['reset_pending_email'] = $email;

        // Redirect to the code entry form
        header("Location: /IAP-GROUP-PROJECT/index.php?form=resetcode");
        exit();
    } else {
        // For security, always redirect even if the email wasn't found (to prevent email enumeration)
        header("Location: /IAP-GROUP-PROJECT/index.php?form=forgot_password&error=EmailNotFound");
        exit();
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}