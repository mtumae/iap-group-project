<?php
session_start();
require_once __DIR__ . '/ClassAutoLoad.php';

// Ensure user completed 2FA
if (!isset($_SESSION['user_id'])) {
    header("Location: /iap-group-project/IAP-GROUP-PROJECT/Forms/login.php");
    exit();
}

$db = new database($conf);
$conn = $db->getConnection();

try {
    $stmt = $conn->prepare("SELECT id, username, email FROM users");
    $stmt->execute();
    $result = $stmt->get_result();
} catch (Exception $e) {
    die("Database error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
    <!-- ✅ Use a separate stylesheet for dashboard -->
    <link rel="stylesheet" href="users.css">
</head>
<body>
    <div id="page-content">
        <div id="dashboard">
            <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username'] ?? 'User'); ?></h2>
            <p>Here are all registered users:</p>

            <table border="1" cellpadding="10" cellspacing="0" style="width:100%; margin-top:20px; text-align:left;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['username']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
