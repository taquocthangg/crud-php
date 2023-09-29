<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $newUsername = $_POST["new_username"];
    $newPassword = $_POST["new_password"];

    $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    $conn = new mysqli("localhost", "root", "", "db_auth");

    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    $username = $_SESSION["username"];

    $sql = "UPDATE users SET username = '$newUsername', password = '$hashedNewPassword' WHERE username = '$username'";

    if ($conn->query($sql) === TRUE) {
        session_unset(); 
        session_destroy(); 
        header("Location: login.php");
        exit();
    } else {
        echo "Lỗi: " . $conn->error;
    }

    $conn->close();
}
?>


?>
<!DOCTYPE html>
<html>

<head>
    <title>Cập Nhập Thông Tin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container mt-5">
        <h1>Cập Nhập Thông Tin</h1>
        <form action="edit_profile.php" method="POST">
            <div class="mb-3">
                <label for="new_username" class="form-label">Tên đăng nhập mới</label>
                <input type="text" name="new_username" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="new_password" class="form-label">Mật Khẩu</label>
                <input name="new_password" required type="password" class="form-control" id="exampleInputPassword1">
            </div>
            <button type="submit" value="Lưu thay đổi" class="btn btn-primary">Lưu thay đổi</button>
        </form>
    </div>
</body>