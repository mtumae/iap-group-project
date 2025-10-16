<?php
session_start();
require_once __DIR__ . '/../ClassAutoLoad.php';


$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if (empty($email) || empty($password)) {
    die("Email and password are required.");
}

$db = new database($conf);
$conn = $db->getConnection();

try {
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $code = rand(100000, 999999);
            $_SESSION['pending_user_id'] = $user['id'];
            $_SESSION['pending_username'] = $user['username'];
            $_SESSION['pending_email'] = $email;
            $_SESSION['2fa_code'] = $code;

            $mail = new Mail();
            $mail->verifyAccount($email, $code);

            
            header("Location: /IAP-GROUP-PROJECT/index.php?form=twofa");
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No account found with that email.";
    }

    $stmt->close();
    //$db->close();

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
