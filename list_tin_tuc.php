<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="list_tin_tuc.css">
    <title >Danh sách tin tức</title>
</head>
<body>
    <div class="container_list_news">
        <h1 class="title_list">Danh sách tin tức</h1>
        <div class="content_news">
            <h3>
    
               <button class="btn_insert"> <a href="./them_tin_tuc.php">Tạo Tin Tức</a></button>
            </h3>
            <table class="table_news" border="1">
                <tr class="title_th">
                    <th>Tiêu đề</th>
                    <th>Ngày đăng</th>
                    <th>Danh mục</th>
                    <th>Nội Dung</th>
                    <th>Ảnh</th>
                    <th>Thao tác</th>
                </tr>
                <?php
                // Kết nối đến cơ sở dữ liệu
                $conn = new mysqli("localhost", "root", "", "db_auth");
        
                if (!$conn) {
                    die("Kết nối thất bại: " . mysqli_connect_error());
                }
        
                // Truy vấn để lấy danh sách tin tức
                $sql = "SELECT * FROM tin_tuc";
                $result = mysqli_query($conn, $sql);
        
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr >";
                        echo "<td>" . $row["tieude"] . "</td>";
                        echo "<td>" . $row["ngaydang"] . "</td>";
                        echo "<td>" . $row["danhmuc"] . "</td>";
                        echo "<td>" . $row["noidung"] . "</td>";
                        echo "<td><img src='" . $row["anhdaidien"] . "' alt='Ảnh đại diện' width='100'></td>";
                        echo "<td>";
                        echo "<a class='btn_update btn' href='sua_tin_tuc.php?id=" . $row["id"] . "'>Sửa</a> | ";
                        echo "<a class='btn_delete btn' href='xoa_tin_tuc.php?id=" . $row["id"] . "'>Xóa</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "Không có tin tức nào.";
                }
        
                mysqli_close($conn);
                ?>
            </table>
        </div>

    </div>
</body>
</html>
