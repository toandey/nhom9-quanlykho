<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tổng quan - Quản lý kho</title>
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

    <style>
        *{
            margin: 0;
            border: 0;
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
        .thong-bao{
            margin: 0px 13.9%;
            border-radius: 5px;
            max-width: 71%;
            line-height: 1.7;
            background-color: #fab1a0;
            box-shadow: 5px 5px 5px #b2bec3;
            border: 1px solid #535c68;
        }
        #thong-bao-text{
            padding: 5px;

        }
        #ngay-thong-bao{
            line-height: 1;
            font-size: 13px;
            padding: 0px 0px 7px 35px;
        }
        .thong-bao-nhap-xuat{
            float: left;
        }
        .button-1{
            padding: 20px 40px 10px 40px;
            margin: 0px 9.7%;
        }
        .button-2{
            padding: 10px 40px 20px 40px;
            margin: 0px 9.7%;
        }
        #button-1, #button-2{
            box-sizing:content-box;
            padding: 0px 5px;
            display: inline-block;
            margin: 0 25px;
            width: 220px;
            height: 80px;
            border: 0;
            border-radius: 5px;
            box-shadow: 5px 5px 5px #95afc0;
            border: 1px solid #535c68;
        }
    </style>
</head>
<body>
    <div class="header">
        Hệ thống quản lý kho
    </div>
    <div class="vien"></div>
    <div class="menu2">
      Xin chào <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>  
      <div class="doi-mat-khau-dang-xuat">
        <a href="reset-password.php" ><button style="background-color: #ffca2c; color:black" id="doi-mat-khau-dang-xuat">Đổi mật khẩu</button></a>
      </div>
      <div class="doi-mat-khau-dang-xuat">
        <a href="logout.php"><button id="doi-mat-khau-dang-xuat" style="background-color: #dc3545;">Đăng xuất</button></a>
      </div>
    </div>    
    <div class="vien"></div>
    <div class="nav-bar">
        <nav class="navbar navbar-expand-lg navbar-light bg-light" style="max-height: 35px">
            <div class="container-fluid">
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Tổng Quan</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="./product.php">Sản Phẩm</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="./report.php">Báo Cáo</a>
                </ul>
                </form>
              </div>
            </div>
        </nav>
    </div>
    <div class="vien"></div>

    <main>
        <div class="button">
            <div class="button-1">
                <button id="button-1" style="background-color: #5ac15b;">
                    <div style="font-size: 1.8rem;">11.860</div>
                    tổng tồn
                </button>
                <button id="button-1" style="background-color: #ffbe76;">
                    <div style="font-size: 1.8rem;">87.289.400</div>
                    tổng tiền
                </button>
                <button id="button-1" style="background-color: #a29bfe;">
                    <div style="font-size: 1.8rem;">1.987</div>
                    sắp hết hàng
                </button>
                <button id="button-1" style="background-color: #ffeaa7;">
                    <div style="font-size: 1.8rem;">2.038</div>
                    vượt định mức
                </button>
            </div>
            <div class="button-2">
                <button id="button-1" style="background-color: #ff6348;">
                    <div style="font-size: 1.8rem;">35</div>
                    thiếu thông tin
                </button>
                <button id="button-1" style="background-color: #70a1ff;">
                    <div style="font-size: 1.8rem;">7</div>
                    duyệt phiếu nhập
                </button>
                <button id="button-1" style="background-color: #badc58;">
                    <div style="font-size: 1.8rem;">5</div>
                    duyệt phiếu xuất
                </button>
                <button id="button-1" style="background-color: #82ccdd;">
                    <div style="font-size: 1.8rem;">39</div>
                    duyệt yêu cầu
                </button>
            </div>
        </div>
        <div class="thong-bao">
            <div id="thong-bao-text">
                <div><img src="./img/icon-thong-bao.svg" alt="icon thông báo" width="20px" height="20px"><b> Thông báo mới:</b></div>
                👉 Thông báo bảo trì hệ thống lần 3
                <div id="ngay-thong-bao">
                    11/10/2021
                </div>
                👉 Thông báo sự cố server và hướng khắc phục
                <div id="ngay-thong-bao">
                    08/10/2021
                </div>
                👉 Thông báo ảnh hưởng của việc đứt cáp quang đến tốc độ truy cập hệ thống
                <div id="ngay-thong-bao">
                    01/10/2021
                </div>
                👉 Thông báo nghỉ lễ quốc khánh 2/9
                <div id="ngay-thong-bao">
                    30/09/2021
                </div>
            </div>
        </div>
    </main>


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