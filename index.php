<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND password=?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $_SESSION['login'] = true;
        header("Location: dashboard.php");
        exit();
    } else {
        echo "<script>alert('Login gagal. Coba lagi ya!');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login - Galeri Kita</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(to right, #e0f7fa, #e8f5e9); /* biru muda dan hijau pucat */
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .login-box {
      background-color: #ffffff;
      padding: 40px;
      border-radius: 16px;
      box-shadow: 0 8px 16px rgba(0,0,0,0.1);
      text-align: center;
      width: 300px;
    }
    h1 {
      font-size: 26px;
      color: #3f51b5; /* biru netral */
      margin-bottom: 10px;
    }
    h2 {
      font-size: 16px;
      color: #555;
      margin-bottom: 20px;
    }
    input {
      padding: 10px;
      margin: 10px 0;
      width: 100%;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 14px;
    }
    button {
      padding: 10px 20px;
      background-color: #4caf50; /* hijau lembut */
      color: white;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-size: 16px;
      transition: background-color 0.3s ease;
    }
    button:hover {
      background-color: #43a047;
    }
  </style>
</head>
<body>
  <div class="login-box">
    <h1>Galeri Kita 📸</h1>
    <form method="POST">
      <h2>Jeje and Cece's Memory</h2>
      <input type="text" name="username" placeholder="Given name" required><br>
      <input type="password" name="password" placeholder="Our Number" required><br>
      <button type="submit">Masuk</button>
    </form>
  </div>
</body>
</html>
