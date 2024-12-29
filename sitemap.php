<?php
header('Content-Type: application/xml; charset=utf-8');

include('includes/db.php');

// Fetch all published articles
$articles = $pdo->query("SELECT * FROM articles WHERE published_date IS NOT NULL");

echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

// Add homepage
echo '<url>';
echo '<loc>https://www.yourblog.com/</loc>';
echo '<lastmod>' . date('Y-m-d') . '</lastmod>';
echo '<priority>1.0</priority>';
echo '</url>';

// Add each article to the sitemap
foreach ($articles as $article) {
  echo '<url>';
  echo '<loc>https://www.yourblog.com/article/' . $article['slug'] . '</loc>';
  echo '<lastmod>' . $article['published_date'] . '</lastmod>';
  echo '<priority>0.8</priority>';
  echo '</url>';
}

echo '</urlset>';
