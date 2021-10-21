<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>


<DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tạo phiếu xuất hàng - Sản Phẩm - Hệ thống quản lý kho</title>

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    *{
        margin: 0;
        border: 1;
    }
    .menu2{
        text-align: right;
        padding: 5px 50px;
    }
    .doi-mat-khau-dang-xuat{
        display: inline-block;
    }
    #doi-mat-khau-dang-xuat{
        color: white;
        margin-right: 5px;
        border-radius: 3px;
        width: 500px;
        max-width: 120px;
        padding: 0px 5px;
    }
    .footer1{
        position: fixed;
        bottom: 0;
        width: 100%;
    }
    .button1{
      margin: 0px auto;
      text-align: center;
    }
</style>
<body>
    <div class="header">
        Hệ thống quản lý kho
    </div>
    <div class="vien"></div>
    
    <div class="container">
      <div>
        <h3 style="text-align: center; margin: 50px 0px;">Tạo Phiếu Xuất Hàng</h3>
        <h4 style="text-align: center; margin: 50px 0px;">Chức năng hiện đang được phát triển, bạn vui lòng quay lại sau!</h4>
      </div>
      <div class="button1">
        <a href="./product.php"><button type="button" class="btn btn-primary">Submit</button></a>
        <a href="./product.php"><button type="button" class="btn btn-secondary">Quay Trở Lại</button></a>
      </div>
    </div>
    <div class="footer1">
        <div class="vien"></div>
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