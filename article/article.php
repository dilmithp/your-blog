<?php
include('../includes/db.php');
$slug = $_GET['slug'];
$stmt = $pdo->prepare("SELECT * FROM articles WHERE slug = ?");
$stmt->execute([$slug]);
$article = $stmt->fetch();
?>
<main>
  <article>
    <header>
      <h1><?php echo $article['title']; ?></h1>
      <p>By <?php echo $article['author']; ?> on <?php echo $article['published_date']; ?></p>
    </header>
    <section>
      <p><?php echo $article['content']; ?></p>
    </section>
  </article>
</main>