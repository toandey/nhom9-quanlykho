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
    <title>Sản Phẩm - Hệ Thống Quản Lý Kho Hàng</title>

    <!--css-->
    <link rel="stylesheet" href="http://quanlykho.ga/css/style.css">
    <!--icon-->
    <link rel="shortcut icon" href="https://codesign.com.bd/conversations/content/images/2020/03/Sprint-logo-design-Codesign-agency.png" type="image/x-icon">
    <!--seo-->
    <meta property = "og:description" content="Phần mềm quản lý chi tiêu thông minh. Giúp bạn kiểm soát dòng tiền và sử dụng một cách hiệu quả. Thiết kế và phát triển bởi VanToan!">
    <meta property = "og:title" content="PHẦN MỀM QUẢN LÝ CHI TIÊU">
    <meta property = "og:url" content="QUANLYCHITIEU.GA">
    <meta property = "og:image" content="https://codesign.com.bd/conversations/content/images/2020/03/Sprint-logo-design-Codesign-agency.png">
    <meta property = "og:type" content="software">



    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        *{
            border: 0px;
            margin: 0px;
            box-sizing: border-box;
        }
        .wrapper{
            width: 80%;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
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
        .container{
            text-align: center;
        }
        .footer1{
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        .container-fluid{
            padding: 0;
            height: 5px;
            margin: 0;
        }
        .nav-link{
            margin: 0;
        }
        .delivery-receipt{
            text-align: right;
        }
        #create-delivery-receipt{
            width: 1000px;
            max-width: 150px;
            padding: 5px;
            border-radius: 5px;
            background-color: #26a69a;
            color: white;
;
        }
        .them-sp{
            margin-bottom: 5px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
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
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link" href="./dashboard.php">Tổng Quan</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Sản Phẩm</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="./report.php">Báo Cáo</a>
                </ul>
                </form>
              </div>
            </div>
        </nav>
    </div>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="delivery-receipt">
                        <a href="./delivery.html"><button id="create-delivery-receipt">Tạo phiếu xuất</button></a>
                        <a href="./receipt.html" ><button id="create-delivery-receipt">Tạo phiếu nhập</button></a>
                    </div>
                    <div class="them-sp">
                        <a href="create.php" class="btn btn-success pull-left">Thêm Sản Phẩm Mới</a>
                    </div>
                    <?php
                    // Include file config.php
                    require_once "config.php";
                    
                    // Cố gắng thực thi truy vấn
                    $sql = "SELECT * FROM sanpham";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Mã Sản Phẩm</th>";
                                        echo "<th>Tên Sản Phẩm</th>";
                                        echo "<th>Giá Nhập</th>";
                                        echo "<th>Giá Bán</th>";
                                        echo "<th>Tồn Kho</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['masanpham'] . "</td>";
                                        echo "<td>" . $row['tensanpham'] . "</td>";
                                        echo "<td>" . $row['gianhap'] . "</td>";
                                        echo "<td>" . $row['giaban'] . "</td>";
                                        echo "<td>" . $row['tonkho'] . "</td>";
                                        echo "<td>";
                                            echo "<a href='read.php?id=". $row['id'] ."' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                            echo "<a href='update.php?id=". $row['id'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "<a href='delete.php?id=". $row['id'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Giải phóng bộ nhớ
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>Không tìm thấy bản ghi.</em></p>";
                        }
                    } else{
                        echo "ERROR: Không thể thực thi $sql. " . mysqli_error($link);
                    }
 
                    // Đóng kết nối
                    mysqli_close($link);
                    ?>
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