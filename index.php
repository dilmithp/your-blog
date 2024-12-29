<?php
include('includes/header.php');

// Pagination setup
$limit = 5;  // Number of articles per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

include('includes/db.php');
$stmt = $pdo->prepare("SELECT * FROM articles ORDER BY published_date DESC LIMIT ? OFFSET ?");
$stmt->bindParam(1, $limit, PDO::PARAM_INT);
$stmt->bindParam(2, $offset, PDO::PARAM_INT);
$stmt->execute();
$articles = $stmt->fetchAll();
?>
<main>
  <h1>Latest Articles</h1>
  <section>
    <?php foreach ($articles as $article): ?>
      <article>
        <h2><a href="article/<?php echo $article['slug']; ?>"><?php echo htmlspecialchars($article['title']); ?></a></h2>
        <p><?php echo substr(strip_tags($article['content']), 0, 150); ?>...</p>
      </article>
    <?php endforeach; ?>
  </section>

  <!-- Pagination Links -->
  <div class="pagination">
    <?php
    $stmt = $pdo->query("SELECT COUNT(*) FROM articles");
    $total_articles = $stmt->fetchColumn();
    $total_pages = ceil($total_articles / $limit);

    for ($i = 1; $i <= $total_pages; $i++) {
      echo "<a href=\"?page=$i\">$i</a> ";
    }
    ?>
  </div>
</main>

<?php
include('includes/footer.php');
?>