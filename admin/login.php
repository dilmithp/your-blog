<?php
session_start();

// Redirect to dashboard if already logged in
if (isset($_SESSION['user'])) {
  header('Location: dashboard.php');
  exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Get the input values
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Connect to database
  include('../includes/db.php');
  $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
  $stmt->bindParam(':username', $username);
  $stmt->execute();
  $user = $stmt->fetch();

  // Verify password
  if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user'] = $user['username'];
    header('Location: dashboard.php');
    exit();
  } else {
    $error = "Invalid username or password!";
  }
}
?>

<form method="POST">
  <label for="username">Username:</label>
  <input type="text" name="username" required>
  <label for="password">Password:</label>
  <input type="password" name="password" required>
  <button type="submit">Login</button>
  <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
</form>