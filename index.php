<!DOCTYPE html>
<html>

<head>
  <title>Trang Chủ</title>
</head>

<body>
  <?php
  session_start();
  if (isset($_SESSION["username"])) {
    echo "<script>window.location.href = 'index.html';</script>";
    echo "<a href='logout.php'>Đăng xuất</a>";
  } else {
    echo "<p>Bạn chưa đăng nhập.</p>";
    echo "<a href='login.php'>Đăng nhập</a> | <a href='register.php'>Đăng ký</a>";
  }
  ?>
</body>

</html>