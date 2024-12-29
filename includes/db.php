<?php
try {
  $pdo = new PDO('mysql:host=localhost;dbname=blog', 'root', 'root');  // Change username and password as per your setup
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
  exit;
}
