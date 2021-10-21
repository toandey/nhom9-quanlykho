<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>


<?php
if (isset($_POST["id"]) && !empty($_POST["id"])) {
    require_once "config.php";
    $id = $_POST["id"];

    $query = "DELETE FROM sanpham WHERE id = '$id'";

    if (mysqli_query($link, $query)) {
        header("location: product.php");
    } else {
         echo "Something went wrong. Please try again later.";
    }

    mysqli_close($link);
} else {
    if (empty(trim($_GET["id"]))) {
        echo "Something went wrong. Please try again later.";
        header("location: product.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Xoá sản phẩm - Hệ Thống Quản Lý Kho</title>

    <!--css-->
    <link rel="stylesheet" href="./css/style.css">
    <!--icon-->
    <link rel="shortcut icon" href="https://codesign.com.bd/conversations/content/images/2020/03/Sprint-logo-design-Codesign-agency.png" type="image/x-icon">
    <!--seo-->
    <meta property = "og:description" content="Phần mềm quản lý chi tiêu thông minh. Giúp bạn kiểm soát dòng tiền và sử dụng một cách hiệu quả. Thiết kế và phát triển bởi VanToan!">
    <meta property = "og:title" content="PHẦN MỀM QUẢN LÝ CHI TIÊU">
    <meta property = "og:url" content="QUANLYCHITIEU.GA">
    <meta property = "og:image" content="https://codesign.com.bd/conversations/content/images/2020/03/Sprint-logo-design-Codesign-agency.png">
    <meta property = "og:type" content="software">

    <!--boostrap-->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
        .footer1{
          position: fixed;
          bottom: 0;
          width: 100%;
        }
    </style>
</head>
<body>
<div class="header">
        Hệ thống quản lý kho
    </div>
    <div class="vien"></div>
    <div class="wrapper">
        <div class="container-fluid" style="font-size: 15pt; text-align: center;">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2 ">Xoá sản phẩm</h2>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger fade in">
                            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                            <p>Bạn có chắc chắc muốn xoá sản phẩm?</p><br>
                            <p>
                                <input type="submit" value="Ok" class="btn btn-danger">
                                <a href="product.php" class="btn btn-default">Không</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="footer1">
      <div class="footer">
          <div class="text-footer" style="font-size: 12pt;">
              Nhóm 9 - Lớp 19CN2
              <br>
              Hệ thống quản lý kho hàng thông minh, tiện lợi, dễ dàng sử dụng.
              <br>
              <img src="https://nhanh.vn/img/logo/bocongthuong/dathongbaobct.png" alt="Thông báo bộ công thương" width="90" height="36">
              <img src="https://nhanh.vn/img/logo/bocongthuong/dadangkybct.png" alt="Thông báo bộ công thương" width="90" height="36">
          </div>
      </div>
      <div class="end-footer" style="font-size: 12pt;">
          Copyright 2021 by QuanLyKho. Made with ❤️️ in HaNoi.
      </div>
    </div>
</body>
</html>