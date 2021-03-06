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

if (isset($_POST["id"]) && !empty($_POST["id"])) {

    $id = $_POST["id"];

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

          $sql = "UPDATE `sanpham` SET `masanpham`= '$masanpham', `tensanpham`= '$tensanpham', `gianhap`= '$gianhap', `giaban`= '$giaban', `tonkho`= '$tonkho' WHERE id='$id'";

          if (mysqli_query($link, $sql)) {
              header("location: product.php");
          } else {
              echo "Something went wrong. Please try again later.";
          }

    }

    mysqli_close($link);
} else {
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        $id = trim($_GET["id"]);
        $query = mysqli_query($link, "SELECT * FROM sanpham WHERE ID = '$id'");

        if ($sanpham    = mysqli_fetch_assoc($query)) {
            $masanpham  = $sanpham["masanpham"];
            $tensanpham = $sanpham["tensanpham"];
            $gianhap    = $sanpham["gianhap"];
            $giaban     = $sanpham["giaban"];
            $tonkho     = $sanpham["tonkho"];
        } else {
            echo "Something went wrong. Please try again later.";
            header("location: update.php");
            exit();
        }
        mysqli_close($link);
    }  else {
        echo "Something went wrong. Please try again later.";
        header("location: update.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ch???nh S???a Th??ng Tin S???n Ph???m - H??? Th???ng Qu???n L?? Kho</title>

    <!--css-->
    <link rel="stylesheet" href="./css/style.css">
    <!--icon-->
    <link rel="shortcut icon" href="https://codesign.com.bd/conversations/content/images/2020/03/Sprint-logo-design-Codesign-agency.png" type="image/x-icon">
    <!--seo-->
    <meta property = "og:description" content="Ph???n m???m qu???n l?? chi ti??u th??ng minh. Gi??p b???n ki???m so??t d??ng ti???n v?? s??? d???ng m???t c??ch hi???u qu???. Thi???t k??? v?? ph??t tri???n b???i VanToan!">
    <meta property = "og:title" content="PH???N M???M QU???N L?? CHI TI??U">
    <meta property = "og:url" content="QUANLYCHITIEU.GA">
    <meta property = "og:image" content="https://codesign.com.bd/conversations/content/images/2020/03/Sprint-logo-design-Codesign-agency.png">
    <meta property = "og:type" content="software">

    <!--boostrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
    body{
        font-size: 14pt;
    }
    .wrapper {
        width: 50%;
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
        H??? th???ng qu???n l?? kho
    </div>
    <div class="vien"></div>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header" style="text-align: center; margin-top: 5px">
                        <h2>Ch???nh s???a s???n ph???m</h2>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                      <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                      <div class="form-group <?php echo (!empty($masanpham_err)) ? 'has-error' : ''; ?>">
                            <label>M?? S???n Ph???m</label>
                            <input type="text" name="masanpham" class="form-control" value="<?php echo $masanpham; ?>">
                            <span class="help-block"><?php echo $masanpham_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($tensanpham_err)) ? 'has-error' : ''; ?>">
                            <label>T??n S???n Ph???m</label>
                            <input type="text" name="tensanpham" class="form-control" value="<?php echo $tensanpham; ?>">
                            <span class="help-block"><?php echo $tensanpham_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($gianhap_err)) ? 'has-error' : ''; ?>">
                            <label>Gi?? Nh???p</label>
                            <input type="text" name="gianhap" class="form-control" value="<?php echo $gianhap; ?>">
                            <span class="help-block"><?php echo $gianhap_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($giaban_err)) ? 'has-error' : ''; ?>">
                            <label>Gi?? B??n</label>
                            <input type="text" name="giaban" class="form-control" value="<?php echo $giaban; ?>">
                            <span class="help-block"><?php echo $giaban_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($tonkho_err)) ? 'has-error' : ''; ?>">
                            <label>S??? l?????ng</label>
                            <input type="text" name="tonkho" class="form-control" value="<?php echo $tonkho; ?>">
                            <span class="help-block"><?php echo $tonkho_err;?></span>
                        </div>

                        <div class="subbmit" style="text-align: center;">
                            <input type="submit" class="btn btn-primary" value="Ho??n t???t">
                            <a href="product.php" class="btn btn-default">Hu???</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="footer1">
      <div class="footer">
          <div class="text-footer" style="font-size: 12pt;">
              Nh??m 9 - L???p 19CN2
              <br>
              H??? th???ng qu???n l?? kho h??ng th??ng minh, ti???n l???i, d??? d??ng s??? d???ng.
              <br>
              <img src="https://nhanh.vn/img/logo/bocongthuong/dathongbaobct.png" alt="Th??ng b??o b??? c??ng th????ng" width="90" height="36">
              <img src="https://nhanh.vn/img/logo/bocongthuong/dadangkybct.png" alt="Th??ng b??o b??? c??ng th????ng" width="90" height="36">
          </div>
      </div>
      <div class="end-footer" style="font-size: 12pt;">
          Copyright 2021 by QuanLyKho. Made with ????????? in HaNoi.
      </div>
    </div>
</body>
</html>