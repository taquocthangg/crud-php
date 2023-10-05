<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="sua_tin_tuc.css">
    <link rel="stylesheet" href="them_tin_tuc.css">
    <title>Sửa tin tức</title>
</head>

<body>
    <div class="container_update">
        <h1>Sửa tin tức</h1>
        <a href="list_tin_tuc.php" class="home_back">Quay lại</a>

        <?php

        $conn = new mysqli("localhost", "root", "", "db_auth");

        if (!$conn) {
            die("Kết nối thất bại: " . mysqli_connect_error());
        }

        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
            $id = $_GET["id"];

            // Truy vấn để lấy tin tức cần sửa
            $sql = "SELECT * FROM tin_tuc WHERE id = $id";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);

            if ($row) {
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST[""])) {
                    $id = $_POST["id"];
                    $tieude = $_POST["tieude"];
                    $ngaydang = $_POST["ngaydang"];
                    $danhmuc = $_POST["danhmuc"];
                    $noidung = $_POST["noidung"];

                    // Check if a file was uploaded
                    if (isset($_FILES["anhdaidien"]) && $_FILES["anhdaidien"]["name"]) {
                        $target_dir = "uploads/";
                        $target_file = $target_dir . basename($_FILES["anhdaidien"]["name"]);

                        // Check file size (20MB limit)
                        if ($_FILES["anhdaidien"]["size"] > 20 * 1024 * 1024) {
                            echo "Kích thước tệp ảnh quá lớn, chỉ cho phép tải lên tệp tin dưới 20MB.";
                        } else {
                            // Check if the uploaded file is an image
                            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                                echo "Chỉ cho phép tải lên các tệp ảnh JPG, JPEG, PNG, hoặc GIF.";
                            } else {
                                // Move the uploaded file and update the database
                                if (move_uploaded_file($_FILES["anhdaidien"]["tmp_name"], $target_file)) {
                                    // Thực hiện truy vấn để cập nhật tin tức và đường dẫn ảnh đại diện
                                    $updateSql = "UPDATE tin_tuc SET tieude='$tieude', ngaydang='$ngaydang', danhmuc='$danhmuc', noidung='$noidung', anhdaidien='$target_file' WHERE id=$id";
                                    if (mysqli_query($conn, $updateSql)) {
                                        echo "Cập nhật tin tức thành công!";
                                    } else {
                                        echo "Lỗi: " . mysqli_error($conn);
                                    }
                                } else {
                                    echo "Lỗi khi tải lên tệp ảnh.";
                                }
                            }
                        }
                    } else {
                        // Nếu người dùng không tải lên ảnh mới, chỉ cập nhật thông tin khác
                        $updateSql = "UPDATE tin_tuc SET tieude='$tieude', ngaydang='$ngaydang', danhmuc='$danhmuc', noidung='$noidung' WHERE id=$id";
                        if (mysqli_query($conn, $updateSql)) {
                            echo "Cập nhật tin tức thành công!";
                        } else {
                            echo "Lỗi: " . mysqli_error($conn);
                        }
                    }
                }


                // Hiển thị biểu mẫu chỉnh sửa tin tức
        ?>
                <div class="content_insert">
                    <form method="POST" action="xac_nhan_sua_tin_tuc.php" enctype="multipart/form-data">
                        <div class="insert">
                            <div class="insert_right update_right">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <label for="tieude">Tiêu đề:</label>
                                <input type="text" name="tieude" value="<?php echo $row['tieude']; ?>" required><br>

                                <label for="ngaydang">Ngày đăng:</label>
                                <input type="date" name="ngaydang" value="<?php echo $row['ngaydang']; ?>" required><br>

                                <label for="danhmuc">Danh mục:</label>
                                <input type="text" name="danhmuc" value="<?php echo $row['danhmuc']; ?>" required><br>\

                                <div class="btn_insert">
                                    <button type="submit" class="insert_btn" name="update">Cập nhật tin tức</button>
                                </div>
                            </div>
                            <div class="insert_left">
                                <!-- Thêm trường input cho tệp ảnh -->
                                <label for="anhdaidien">Ảnh đại diện hiện tại</label>
                                <!-- <input type="file" name="anhdaidien" accept="image/*"><br> -->
                                <?php if (!empty($row['anhdaidien'])) : ?>
                                    <img src="<?php echo $row['anhdaidien']; ?>" alt="Ảnh đại diện hiện tại" width="100">
                                <?php endif; ?>
                                <div class="left_img">
                                    <label for="anhdaidien">Ảnh đại diện muốn đổi:</label>
                                    <input type="file" name="anhdaidien" accept="image/*" onchange="previewImage(this);" required><br>
                                    <img id="preview" src="#" alt="Ảnh đại diện" style="max-width: 200px; max-height: 200px; display: none;">
                                </div>
                                <label for="noidung">Nội dung:</label><br>
                                <textarea name="noidung" class="insert_noidung" rows="4" cols="50" required><?php echo $row['noidung']; ?></textarea><br>
                            </div>

                        </div>

                    </form>





            <?php
            } else {
                echo "Không tìm thấy tin tức.";
            }
        }

        mysqli_close($conn);
            ?>
                </div>
    </div>
    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    document.getElementById('preview').src = e.target.result;
                    document.getElementById('preview').style.display = 'block';
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>

</html>