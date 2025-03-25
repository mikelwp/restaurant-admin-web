<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: homepage.php');
    exit;
}
?>

<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
<link rel="stylesheet" href="framework/navstyle.css">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php">MAKENA</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
      <li class="nav-item"><a class="nav-link" href="menu.php">Menu</a></li>
      <li class="nav-item"><a class="nav-link" href="location.php">Location</a></li>
      <li class="nav-item"><a class="nav-link" href="gallery.php">Gallery</a></li>
      <li class="nav-item"><a class="nav-link" href="articles.php">Articles</a></li>
      <li class="nav-item"><a class="nav-link" href="contact us.php">Contact Us</a></li>
      <li class="nav-item"><a class="nav-link" href="about us.php">About Us</a></li>
      <li class="nav-item"><a class="nav-link" href="developer.php">Developer</a></li>
      <?php if (isset($_SESSION['user_id'])): ?>
        <li class="nav-item">
          <a class="nav-link btn btn-danger text-white" href="logout.php">Logout</a>
        </li>
      <?php else: ?>
        <li class="nav-item">
          <a class="nav-link btn btn-primary text-white" href="login.php">Login</a>
        </li>
      <?php endif; ?>
    </ul>
  </div>
</nav>