<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
    header('Location: login.php');
    exit;
}
include('config/conn_db.php');

// Hapus pengguna
if (isset($_POST['delete_user'])) {
    $user_id = $_POST['user_id'];
    $conn->query("DELETE FROM users WHERE id='$user_id'");
    header('Location: manage_users.php');
    exit;
}
// Edit pengguna
if (isset($_POST['edit_user'])) {
    $user_id = $_POST['user_id'];
    $name = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']); // Enkripsi password
    $conn->query("UPDATE users SET name='$name', email='$email', password='$password' WHERE id='$user_id'");
    header('Location: manage_users.php');
    exit;
}

$users = $conn->query("SELECT * FROM users");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Users</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
  <link rel="stylesheet" href="framework/manage_users.css">
</head>
<body>
  <div class="container mt-4">
    <h1>Manage Users</h1>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Roles</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $users->fetch_assoc()): ?>
        <tr>
          <td><?= htmlspecialchars($row['id']) ?></td>
          <td><?= htmlspecialchars($row['name']) ?></td>
          <td><?= htmlspecialchars($row['email']) ?></td>
          <td><?= $row['is_admin'] == 1 ? 'Admin' : 'User' ?></td>
          <td>
            <form action="manage_users.php" method="POST" style="display:inline-block;">
              <input type="hidden" name="user_id" value="<?= $row['id'] ?>">
              <button type="submit" name="delete_user" class="btn btn-danger">Delete</button>
            </form>
            <button class="btn btn-warning" onclick="showEditForm(<?= htmlspecialchars($row['id']) ?>, '<?= htmlspecialchars($row['name']) ?>', '<?= htmlspecialchars($row['email']) ?>')">Edit</button>
          </td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
    <a href="admin.php" class="btn btn-secondary mt-4">Back to Admin</a>
  </div>

  <div id="editUserModal" class="modal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="manage_users.php" method="POST">
          <div class="modal-body">
            <input type="hidden" id="edit_user_id" name="user_id">
            <div class="form-group">
              <label for="edit_username">Name</label>
              <input type="text" class="form-control" id="edit_username" name="username" required>
            </div>
            <div class="form-group">
              <label for="edit_email">Email</label>
              <input type="email" class="form-control" id="edit_email" name="email" required>
            </div>
            <div class="form-group">
              <label for="edit_password">Password</label>
              <input type="password" class="form-control" id="edit_password" name="password" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="edit_user" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    function showEditForm(id, username, email) {
      document.getElementById('edit_user_id').value = id;
      document.getElementById('edit_username').value = username;
      document.getElementById('edit_email').value = email;
      $('#editUserModal').modal('show');
    }
  </script>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
