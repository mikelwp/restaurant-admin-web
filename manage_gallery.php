<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
    header('Location: login.php');
    exit;
}
include('config/conn_db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete_image'])) {
        $image_id = $_POST['image_id'];
        $sql = "DELETE FROM gallery WHERE id='$image_id'";
        $conn->query($sql);
    } elseif (isset($_FILES['image'])) {
        $name = $_POST['name'];
        $image = file_get_contents($_FILES['image']['tmp_name']);
        $stmt = $conn->prepare("INSERT INTO gallery (name, image) VALUES (?, ?)");
        $stmt->bind_param("sb", $name, $image);
        $stmt->send_long_data(1, $image);
        $stmt->execute();
    }
}

$images = $conn->query("SELECT * FROM gallery");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Gallery</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
  <link rel="stylesheet" href="framework/manage_gallery.css">
</head>
<body>
  <div class="container mt-4">
    <h1>Manage Gallery</h1>
    <form action="manage_gallery.php" method="POST" enctype="multipart/form-data">
      <div class="form-group">
        <label for="name">Image Description</label>
        <input type="text" class="form-control" id="name" name="name" required>
      </div>
      <div class="form-group">
        <label for="image">Upload Image</label>
        <input type="file" class="form-control" id="image" name="image" required>
      </div>
      <button type="submit" class="btn btn-primary">Upload</button>
    </form>
    <h2 class="mt-4">Stored Images</h2>
    <div class="row">
      <?php while ($row = $images->fetch_assoc()): ?>
        <div class="col-md-4">
          <div class="card mb-4">
            <img src="data:image/jpeg;base64,<?= base64_encode($row['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($row['name']) ?>">
            <div class="card-body">
              <p class="card-text"><?= htmlspecialchars($row['name']) ?></p>
              <form action="manage_gallery.php" method="POST">
                <input type="hidden" name="image_id" value="<?= $row['id'] ?>">
                <button type="submit" name="delete_image" class="btn btn-danger">Delete</button>
              </form>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
    <a href="admin.php" class="btn btn-secondary mt-4">Back to Admin</a>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
