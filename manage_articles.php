<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
    header('Location: login.php');
    exit;
}
include('config/conn_db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete_article'])) {
        $article_id = $_POST['article_id'];
        $sql = "DELETE FROM articles WHERE id='$article_id'";
        $conn->query($sql);
    } elseif (isset($_POST['title'])) {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $source = $_POST['source'];
        $stmt = $conn->prepare("INSERT INTO articles (title, content, source) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $title, $content, $source);
        $stmt->execute();
    }
}

$articles = $conn->query("SELECT * FROM articles ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Articles</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
  <link rel="stylesheet" href="framework/manage_articles.css">
</head>
<body>
  <div class="container mt-4">
    <h1>Manage Articles</h1>
    <form action="manage_articles.php" method="POST">
      <div class="form-group">
        <label for="title">Judul</label>
        <input type="text" class="form-control" id="title" name="title" required>
      </div>
      <div class="form-group">
        <label for="content">Isi</label>
        <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
      </div>
      <div class="form-group">
        <label for="source">Sumber</label>
        <input type="text" class="form-control" id="source" name="source">
      </div>
      <button type="submit" class="btn btn-primary">Tambahkan</button>
    </form>
    <h2 class="mt-4">Artikel yang Ada</h2>
    <div class="row">
      <?php while ($row = $articles->fetch_assoc()): ?>
        <div class="col-md-4">
          <div class="card mb-4">
            <div class="card-body">
              <h5 class="card-title"><?= htmlspecialchars($row['title']) ?></h5>
              <p class="card-text"><?= nl2br(htmlspecialchars($row['content'])) ?></p>
              <p class="card-text"><small class="text-muted">Sumber : <?= htmlspecialchars($row['source']) ?></small></p>
              <form action="manage_articles.php" method="POST">
                <input type="hidden" name="article_id" value="<?= $row['id'] ?>">
                <button type="submit" name="delete_article" class="btn btn-danger">Hapus</button>
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
