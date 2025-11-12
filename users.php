<?php
session_start();

require_once __DIR__ . '/ClassAutoLoad.php'; 
require_once __DIR__ . '/DBConnection.php';  

if (!isset($_SESSION['user_id'])) {
    header("Location: /iap-group-project/Forms/login.php");
    exit();
}


if (!isset($conf)) {
    die("Error: \$conf variable is not set. Check Config.php and ClassAutoLoad.php.");
}


$db = new Database($conf); 

$db->connect(); 


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

   
    if (isset($_POST['action']) && $_POST['action'] === 'delete') {
        $id = (int)$_POST['id'];
        if ($id > 0) {
            try {
                $sql = "DELETE FROM users WHERE id = ?";
              
                $db->delete($sql, [$id]); 
            } catch (Exception $e) {
                die("Delete failed: " . $e->getMessage());
            }
        }
        header("Location: users.php?status=deleted");
        exit();
    }

   
    if (isset($_POST['action']) && $_POST['action'] === 'edit') {
        $id = (int)$_POST['id'];
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        
        if ($id > 0 && !empty($username) && !empty($email)) {
            try {
                $sql = "UPDATE users SET username = ?, email = ? WHERE id = ?";
               
                $db->update($sql, [$username, $email, $id]);
            } catch (Exception $e) {
                die("Update failed: " . $e->getMessage());
            }
        }
        header("Location: users.php?status=edited");
        exit();
    }
}


try {
  
    $items = $db->fetch("SELECT id, username, email FROM users");
} catch (Exception $e) {
    die("Database error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="users.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.4/css/dataTables.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.4/js/dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="p-4">
    <div class="container">
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username'] ?? 'User'); ?></h2>
        <p>Here are all registered users:</p>
      
        <?php if(isset($_GET['status']) && $_GET['status'] === 'edited'): ?>
            <div class="alert alert-success auto-dismiss-alert">User updated successfully!</div>
        <?php endif; ?>
        <?php if(isset($_GET['status']) && $_GET['status'] === 'deleted'): ?>
            <div class="alert alert-success auto-dismiss-alert">User deleted successfully!</div>
        <?php endif; ?>

        <table id="myTable" class="display table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($items as $item){?>
                    <tr>
                        <td><?= htmlspecialchars($item['id']); ?></td>
                        <td><?= htmlspecialchars($item['username']); ?></td>
                        <td><?= htmlspecialchars($item['email']); ?></td>
                        <td>
                            <button class="btn btn-sm btn-primary edit-btn" 
                                    data-id="<?= $item['id'] ?>"
                                    data-username="<?= htmlspecialchars($item['username']) ?>"
                                    data-email="<?= htmlspecialchars($item['email']) ?>">
                                Edit
                            </button>
                            
                            <form method="POST" action="users.php" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form id="editForm" method="POST" action="users.php">
            <div class="modal-header">
              <h5 class="modal-title">Edit User</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <input type="hidden" name="action" value="edit">
              <input type="hidden" name="id" id="edit-id">
              
              <div class="mb-3">
                <label>Full Name</label>
                <input type="text" name="username" id="edit-username" class="form-control" required>
              </div>
              <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" id="edit-email" class="form-control" required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success">Save Changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>
<script>
$(document).ready(function () {
    // 1. Initialize DataTables (This provides the Search box)
    $('#myTable').DataTable();

    // 2. Handle Edit button click
    $('#myTable').on('click', '.edit-btn', function () {
        const id = $(this).data('id');
        const username = $(this).data('username');
        const email = $(this).data('email');

        $('#edit-id').val(id);
        $('#edit-username').val(username);
        $('#edit-email').val(email);

        new bootstrap.Modal(document.getElementById('editModal')).show();
    });

    // 3. --- ADD THIS CODE ---
    // Auto-dismiss alerts after 3 seconds
    setTimeout(function() {
        $('.auto-dismiss-alert').slideUp('slow'); // You can also use .fadeOut('slow')
    }, 3000); // 3000 milliseconds = 3 seconds
    
});
</script>

</body>
</html>