<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $id = $_GET["id"];
    // Kết nối đến cơ sở dữ liệu
    $conn = new mysqli("localhost", "root", "", "db_auth");

    if (!$conn) {
        die("Kết nối thất bại: " . mysqli_connect_error());
    }

    // Truy vấn để xóa tin tức
    $sql = "DELETE FROM tin_tuc WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        echo '<script>alert("Xóa tin tức thành công!");</script>';
        echo '<script>setTimeout(function() { window.location.href = "list_tin_tuc.php"; }, 100);</script>';
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
