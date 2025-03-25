<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
    header('Location: homepage.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
  <link rel="stylesheet" href="framework/adminstyle.css">
</head>
<body>
  <div class="container mt-4">
    <h1>Welcome Admin!</h1>
    <div class="btn-group-vertical">
      <a href="manage_gallery.php" class="btn btn-primary">Manage Gallery</a>
      <a href="manage_articles.php" class="btn btn-primary">Manage Articles</a>
      <a href="manage_users.php" class="btn btn-primary">Manage Users</a>
      <a href="contacts.xml" class="btn btn-primary">Contact Us XML</a>
      <a href="logout.php" class="btn btn-danger mt-3">Logout</a>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
