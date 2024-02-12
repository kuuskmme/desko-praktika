<?php

$host = 'localhost'; 
$dbname = 'desko-praktika'; 
$user = 'desko-praktika'; 
$pass = 'desko-praktika'; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $stmt = $pdo->prepare("SELECT password FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
          header("Location: login_success.php"); // Redirecting to login_success.php upon successful login
          exit();
      } else {
          echo "Login failed. Invalid email or password.";
      }
    }
} catch (PDOException $e) {
    die("Error connecting to the database: " . $e->getMessage());
}

?>
