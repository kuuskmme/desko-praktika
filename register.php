<?php

$host = 'localhost'; // Or your database host
$port = 8889; // MySQL port
$dbname = 'desko-praktika'; // Your database name
$user = 'desko-praktika'; // Your database username
$pass = 'desko-praktika'; // Your database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $result = $stmt->execute([$username, $email, $password]);

        if ($result) {
            echo "<!DOCTYPE html>";
            echo "<html><head>";
            echo "<style>";
            echo "body { font-family: Arial, sans-serif; display: flex; justify-content: center; align-items: center; flex-direction: column; height: 100vh; margin: 0; }";
            echo "p, a { margin: 20px; }";
            echo "button { padding: 10px 20px; background-color: #5C6BC0; color: #fff; border: none; border-radius: 4px; cursor: pointer; }";
            echo "button:hover { background-color: #3F51B5; }";
            echo "</style>";
            echo "</head><body>";
            echo "<p>Registration successful!</p>";
            echo "<a href='login.html'><button>Log in</button></a>";
            echo "</body></html>";
        } else {
            echo "Error in registration.";
        }
    }
} catch (PDOException $e) {
    die("Error connecting to the database: " . $e->getMessage());
}

?>
