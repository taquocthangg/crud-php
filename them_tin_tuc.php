<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="them_tin_tuc.css">

    <title>Thêm mới tin tức</title>
</head>
<body>
    <div class="container_insert">
    <h1 class="title_insert">Thêm mới tin tức</h1>
        <div class="content_insert">
                <a href="index.html" class="home_back">Quay lại</a>
            <form method="POST" action="them_tin_tuc_process.php" enctype="multipart/form-data">
                <div class="insert">
                    <div class="insert_right">
                        <label for="tieude">Tiêu đề:</label>
                        <input type="text" name="tieude" required><br>
                        
                        <label for="danhmuc">Danh mục:</label>
                        <input type="text" name="danhmuc" required><br>
                        
                        <label for="ngaydang">Ngày đăng:</label>
                        <input type="date" name="ngaydang" required><br>
                    </div>
                    <div class="insert_left">
                        <div class="left_img">
                            <label for="anhdaidien">Ảnh đại diện:</label>
                            <input type="file" name="anhdaidien" accept="image/*" required><br>
                        </div>
                        <div class="left_content">
                            <label for="noidung">Nội dung:</label><br>
                            <textarea class="insert_noidung" name="noidung" rows="4" cols="50" required></textarea><br>
                        </div>
                
                    </div>
                </div>

        
        
        <div class="btn_insert">
        <input  class="insert_btn" type="submit" value="Thêm tin tức" name="submit">
        </div>
                
        
            </form>
        </div>
    </div>
    
</body>
</html>

