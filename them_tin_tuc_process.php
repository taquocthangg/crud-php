<?php
$conn = new mysqli("localhost", "root", "", "db_auth");

if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}
// Xử lý khi người dùng gửi biểu mẫu
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tieude = $_POST["tieude"];
    $ngaydang = $_POST["ngaydang"];
    $danhmuc = $_POST["danhmuc"];
    $noidung = $_POST["noidung"];

    // Xử lý tải lên ảnh đại diện và lưu vào thư mục trên server
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["anhdaidien"]["name"]);
    move_uploaded_file($_FILES["anhdaidien"]["tmp_name"], $target_file);

    // Thực hiện truy vấn để thêm dữ liệu vào cơ sở dữ liệu
    $sql = "INSERT INTO tin_tuc (tieude, ngaydang, danhmuc, noidung, anhdaidien) VALUES ('$tieude', '$ngaydang', '$danhmuc', '$noidung', '$target_file')";

    if (mysqli_query($conn, $sql)) {
        echo '<script>alert("Thêm tin tức thành công!");</script>';
        echo '<script>setTimeout(function() { window.location.href = "list_tin_tuc.php"; }, 100);</script>';
        exit; 
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }
}

// Đóng kết nối đến cơ sở dữ liệu (nếu cần)
mysqli_close($conn);
