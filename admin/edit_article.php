<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
  header('Location: login.php');
  exit();
}

include('../includes/db.php');
$id = $_GET['id'];  // Get the article ID
$stmt = $pdo->prepare("SELECT * FROM articles WHERE id = ?");
$stmt->execute([$id]);
$article = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $title = $_POST['title'];
  $content = $_POST['content'];

  // Update the article
  $stmt = $pdo->prepare("UPDATE articles SET title = ?, content = ?, updated_at = NOW() WHERE id = ?");
  $stmt->execute([$title, $content, $id]);

  echo "Article updated successfully!";
}
?>

<h1>Edit Article</h1>
<form method="POST">
  <label for="title">Title</label>
  <input type="text" name="title" value="<?php echo htmlspecialchars($article['title']); ?>" required>

  <label for="content">Content</label>
  <textarea name="content" required><?php echo htmlspecialchars($article['content']); ?></textarea>

  <button type="submit">Update Article</button>
</form>