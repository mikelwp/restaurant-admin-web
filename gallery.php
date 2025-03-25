<?php
include('config/conn_db.php');

$images = $conn->query("SELECT * FROM gallery");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gallery</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
  <link rel="stylesheet" href="framework/gallerystyle.css">
</head>
<body>
  <?php include('navbar.php'); ?>
  <div class="container mt-4">
    <h1>Gallery</h1>
    <div class="row">
      <?php while ($row = $images->fetch_assoc()): ?>
        <div class="col-md-3">
          <div class="card mb-4">
            <img src="data:image/jpeg;base64,<?= base64_encode($row['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($row['name']) ?>">
            <div class="card-body">
              <p class="card-text"><?= htmlspecialchars($row['name']) ?></p>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdn.botpress.cloud/webchat/v2/inject.js"></script>
  <script src="https://mediafiles.botpress.cloud/bac8c003-5434-411c-b4dd-68a4a959f0fd/webchat/v2/config.js"></script>
</body>
</html>