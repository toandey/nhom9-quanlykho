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
require_once "config.php";

$masanpham = $tensanpham = $gianhap = $giaban = $tonkho ="";
$masanpham_err = $tensanpham_err = $gianhap_err = $giaban_err =$tonkho_err ="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $masanpham = trim($_POST["masanpham"]);
    if(empty($masanpham)){
        $masanpham_err = "Address is required.";
    } else {
        $masanpham = $masanpham;
    }
    
    $tensanpham = trim($_POST["tensanpham"]);
    if(empty($tensanpham)){
        $tensanpham_err = "Address is required.";
    } else {
        $tensanpham = $tensanpham;
    }

    $gianhap = trim($_POST["gianhap"]);
    if(empty($gianhap)){
        $gianhap_err = "Address is required.";
    } else {
        $gianhap = $gianhap;
    }

    $giaban = trim($_POST["giaban"]);
    if(empty($giaban)){
        $giaban_err = "Address is required.";
    } else {
        $giaban = $giaban;
    }

    $tonkho = trim($_POST["tonkho"]);
    if(empty($tonkho)){
        $tonkho_err = "Address is required.";
    } else {
        $tonkho = $tonkho;
    }



    if(empty($masanpham_err) && empty($tensanpham_err) && empty($gianhap_err)&& empty($giaban_err)&& empty($tonkho_err)){
          $sql = "INSERT INTO `sanpham` (`masanpham`, `tensanpham`, `gianhap`, `giaban`, `tonkho`) VALUES ('$masanpham', '$tensanpham', '$gianhap', '$giaban', '$tonkho')";

          if (mysqli_query($link, $sql)) {
              header("location: product.php");
          } else {
               echo "Something went wrong. Please try again later.";
          }
      }
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Thêm sản phẩm mới - Hệ Thống Quản Lý Kho</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
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

    <style type="text/css">
        .wrapper {
            width: 500px;
            margin: 0 auto;
        }
        .button{
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2 style="text-align: center;">Thêm Sản Phẩm</h2>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group <?php echo (!empty($masanpham_err)) ? 'has-error' : ''; ?>">
                            <label>Mã Sản Phẩm</label>
                            <input type="text" name="masanpham" class="form-control" value="<?php echo $masanpham; ?>">
                            <span class="help-block"><?php echo $masanpham_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($tensanpham_err)) ? 'has-error' : ''; ?>">
                            <label>Tên Sản Phẩm</label>
                            <input type="text" name="tensanpham" class="form-control" value="<?php echo $tensanpham; ?>">
                            <span class="help-block"><?php echo $tensanpham_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($gianhap_err)) ? 'has-error' : ''; ?>">
                            <label>Giá Nhập</label>
                            <input name="gianhap" class="form-control"><?php echo $gianhap; ?></input>
                            <span class="help-block"><?php echo $gianhap_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($giaban_err)) ? 'has-error' : ''; ?>">
                            <label>Giá Bán</label>
                            <input name="giaban" class="form-control"><?php echo $giaban; ?></input>
                            <span class="help-block"><?php echo $giaban_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($tonkho_err)) ? 'has-error' : ''; ?>">
                            <label>Số Lượng</label>
                            <input type="text" name="tonkho" class="form-control" value="<?php echo $tonkho; ?>">
                            <span class="help-block"><?php echo $tonkho_err;?></span>
                        </div>

                        <div class="button">
                            <input type="submit" class="btn btn-primary" value="Hoàn thành">
                            <a href="product.php" class="btn btn-default">Huỷ</a>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>