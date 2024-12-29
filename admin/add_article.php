<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
  header('Location: login.php');
  exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  include('../includes/db.php');

  // Get form data
  $title = $_POST['title'];
  $content = $_POST['content'];
  $slug = strtolower(str_replace(" ", "-", $title)); // Simple slug generation
  $author = $_SESSION['user'];

  // Insert the article into the database
  $stmt = $pdo->prepare("INSERT INTO articles (title, content, slug, author) VALUES (?, ?, ?, ?)");
  $stmt->execute([$title, $content, $slug, $author]);

  echo "Article added successfully!";
}
?>

<h1>Add New Article</h1>
<form method="POST">
  <label for="title">Title</label>
  <input type="text" name="title" required>

  <label for="content">Content</label>
  <textarea name="content" required></textarea>

  <button type="submit">Add Article</button>
</form>