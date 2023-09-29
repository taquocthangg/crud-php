<!DOCTYPE html>
<html>

<head>
    <title>Đăng nhập</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container mt-5">
        <h1>Đăng nhập</h1>
        <form action="login_process.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Tên Đăng Nhập</label>
                <input type="text" name="username" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mật Khẩu</label>
                <input name="password" required type="password" class="form-control" id="exampleInputPassword1">
            </div>
            <button type="submit" value="Đăng nhập" class="btn btn-primary">Đăng Nhập</button>
        </form>
    </div>
</body>

</html>