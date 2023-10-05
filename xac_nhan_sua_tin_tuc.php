<?php

$conn = new mysqli("localhost", "root", "", "db_auth");

if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
    $id = $_POST["id"];
    $tieude = $_POST["tieude"];
    $ngaydang = $_POST["ngaydang"];
    $danhmuc = $_POST["danhmuc"];
    $noidung = $_POST["noidung"];

    // Kiểm tra xem người dùng đã tải lên tệp ảnh mới chưa
    if (isset($_FILES["anhdaidien"]) && $_FILES["anhdaidien"]["error"] == 0) {
        $anhdaidien = $_FILES["anhdaidien"]["name"];
        $target_dir = "uploads/"; // Thay đổi đường dẫn thư mục lưu trữ tệp ảnh
        $target_file = $target_dir . basename($_FILES["anhdaidien"]["name"]);

        // Di chuyển tệp ảnh vào thư mục lưu trữ
        if (move_uploaded_file($_FILES["anhdaidien"]["tmp_name"], $target_file)) {
            echo "Tải ảnh lên thành công.";

            // Thực hiện truy vấn để cập nhật tin tức, bao gồm cả ảnh đại diện mới
            $update_sql = "UPDATE tin_tuc SET tieude='$tieude', ngaydang='$ngaydang', danhmuc='$danhmuc', noidung='$noidung', anhdaidien='$target_file' WHERE id=$id";

            if (mysqli_query($conn, $update_sql)) {
                echo '<script>alert("Sửa tin tức thành công!");</script>';
                echo '<script>setTimeout(function() { window.location.href = "list_tin_tuc.php"; }, 100);</script>';
            } else {
                echo "Lỗi: " . mysqli_error($conn);
            }
        } else {
            echo "Có lỗi xảy ra khi tải ảnh lên.";
        }
    } else {
        // Người dùng không tải lên tệp ảnh mới, chỉ cập nhật các thông tin khác
        $update_sql = "UPDATE tin_tuc SET tieude='$tieude', ngaydang='$ngaydang', danhmuc='$danhmuc', noidung='$noidung' WHERE id=$id";

        if (mysqli_query($conn, $update_sql)) {
            echo '<script>alert("Sửa tin tức thành công!");</script>';
            echo '<script>setTimeout(function() { window.location.href = "list_tin_tuc.php"; }, 100);</script>';
        } else {
            echo "Lỗi: " . mysqli_error($conn);
        }
    }
}
