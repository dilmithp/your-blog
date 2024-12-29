<?php
session_start();
if (!isset($_SESSION['user'])) {
  header('Location: login.php');
  exit();
}

include('../includes/db.php');
$stmt = $pdo->query("SELECT * FROM articles ORDER BY published_date DESC");
$articles = $stmt->fetchAll();
?>
<h1>Welcome, <?php echo $_SESSION['user']; ?>!</h1>
<a href="logout.php">Logout</a>
<h2>Articles</h2>
<table>
  <tr>
    <th>Title</th>
    <th>Actions</th>
  </tr>
  <?php foreach ($articles as $article): ?>
    <tr>
      <td><?php echo $article['title']; ?></td>
      <td><a href="edit_article.php?id=<?php echo $article['id']; ?>">Edit</a> | <a href="delete_article.php?id=<?php echo $article['id']; ?>">Delete</a></td>
    </tr>
  <?php endforeach; ?>
</table>