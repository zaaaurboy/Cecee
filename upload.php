<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit();
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["fileToUpload"])) {
    $target_dir = "uploads/";

    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $message = "Foto berhasil diupload! 😊";
        } else {
            $message = "Gagal upload file.";
        }
    } else {
        $message = "File bukan gambar.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Upload Foto - Galeri Kita</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(to right, #e0f7fa, #e8f5e9);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .upload-box {
      background-color: #fff;
      padding: 30px 40px;
      border-radius: 16px;
      box-shadow: 0 8px 16px rgba(0,0,0,0.1);
      width: 320px;
      text-align: center;
    }
    h1 {
      color: #3f51b5;
      margin-bottom: 20px;
    }
    input[type="file"] {
      margin: 20px 0;
      width: 100%;
      border-radius: 8px;
      cursor: pointer;
    }
    button {
      padding: 10px 20px;
      background-color: #4caf50;
      color: white;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-size: 16px;
      transition: background-color 0.3s ease;
      width: 100%;
    }
    button:hover {
      background-color: #43a047;
    }
    .message {
      margin-top: 15px;
      font-weight: 600;
      color: #333;
    }
    a {
      display: inline-block;
      margin-top: 20px;
      text-decoration: none;
      color: #3f51b5;
      font-size: 14px;
    }
    a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="upload-box">
    <h1>Upload Foto</h1>
    <form method="POST" enctype="multipart/form-data">
      <input type="file" name="fileToUpload" required accept="image/*" />
      <button type="submit">Upload</button>
    </form>
    <?php if ($message): ?>
      <div class="message"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>
    <a href="dashboard.php">← Kembali ke Dashboard</a>
  </div>
</body>
</html>
