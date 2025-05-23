<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit();
}
$images = glob("uploads/*.{jpg,png,jpeg,gif}", GLOB_BRACE);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Dashboard - Our Gallery 🤍</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(to right, #e0f7fa, #e8f5e9);
      margin: 0;
      padding: 0;
      display: flex;
      flex-direction: column;
      align-items: center;
      min-height: 100vh;
    }
    h1 {
      color: #3f51b5;
      margin: 30px 0 10px;
      font-weight: 700;
    }

    .slider {
      width: 80%;
      max-width: 800px;
      margin: 0 auto 40px;
      overflow: hidden;
      border-radius: 20px;
      box-shadow: 0 5px 20px rgba(0,0,0,0.2);
      background: white;
    }

    .slides {
      display: flex;
      width: calc(100% * <?= count($images) ?>);
      animation: slide <?= max(10, count($images)*5) ?>s infinite;
    }
    .slides img {
      width: calc(100% / <?= count($images) ?>);
      object-fit: cover;
      border-radius: 20px;
    }
    @keyframes slide {
      <?php
      $count = count($images);
      for ($i = 0; $i < $count; $i++) {
        $percentStart = ($i * 100) / $count;
        $percentEnd = (($i + 1) * 100) / $count - 0.1;
        $marginLeft = -($i * 100);
        echo "{$percentStart}% {margin-left: {$marginLeft}%;}\n";
        echo "{$percentEnd}% {margin-left: {$marginLeft}%;}\n";
      }
      ?>
    }

    .upload-box {
      background-color: #fff;
      padding: 25px 35px;
      border-radius: 16px;
      box-shadow: 0 8px 16px rgba(0,0,0,0.1);
      width: 320px;
      text-align: center;
      margin-bottom: 30px;
    }
    .upload-box h3 {
      color: #3f51b5;
      margin-bottom: 15px;
    }
    input[type="file"] {
      width: 100%;
      margin-bottom: 20px;
      border-radius: 8px;
      cursor: pointer;
      font-size: 14px;
    }
    button {
      width: 100%;
      padding: 10px 0;
      font-size: 16px;
      border: none;
      border-radius: 8px;
      background-color: #4caf50;
      color: white;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    button:hover {
      background-color: #43a047;
    }

    .logout {
      display: inline-block;
      margin-bottom: 30px;
      padding: 10px 20px;
      background-color: #f44336;
      color: white;
      border-radius: 12px;
      text-decoration: none;
      font-weight: 600;
      transition: background-color 0.3s ease;
    }
    .logout:hover {
      background-color: #d32f2f;
    }
  </style>
</head>
<body>
  <h1> Our Memories 🤍</h1>

  <?php if (count($images) > 0): ?>
  <div class="slider">
    <div class="slides">
      <?php foreach ($images as $img): ?>
        <img src="<?= htmlspecialchars($img) ?>" alt="Slide Foto">
      <?php endforeach; ?>
    </div>
  </div>
  <?php else: ?>
    <p style="color:#555; font-style: italic;">Belum ada foto di galeri. Yuk, upload dulu! 💌</p>
  <?php endif; ?>

  <div class="upload-box">
    <form action="upload.php" method="post" enctype="multipart/form-data">
      <h3>Add Photos</h3>
      <input type="file" name="fileToUpload" required accept="image/*"><br>
      <button type="submit">Upload Foto ✨</button>
    </form>
  </div>

  <a class="logout" href="logout.php">Keluar dulu ah 💔</a>
</body>
</html>
