<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, otherwise redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate new password
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Vui lòng nhập lại mật khẩu mới";     
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "Mật khẩu tối thiểu 6 ký tự";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Vui lòng nhập lại mật khẩu";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
        
    // Check input errors before updating the database
    if(empty($new_password_err) && empty($confirm_password_err)){
        // Prepare an update statement
        $sql = "UPDATE users SET password = ? WHERE id = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);
            
            // Set parameters
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Password updated successfully. Destroy the session, and redirect to login page
                session_destroy();
                header("location: login.php");
                exit();
            } else{
                echo "Đã sảy ra lỗi, vui lòng thử lại";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Đổi mật khẩu - Hệ Thống Quản lý Kho</title>
    <!--icon-->
    <link rel="shortcut icon" href="https://codesign.com.bd/conversations/content/images/2020/03/Sprint-logo-design-Codesign-agency.png" type="image/x-icon">
    <!--seo-->
    <meta property = "og:description" content="Hệ thống quản lý kho hàng thông minh, hiện đại, dễ dàng sử dụng. Phù hợp cho hộ kinh doanh và các doanh nghiệp nhỏ.">
    <meta property = "og:title" content="HỆ THỐNG QUẢN LÝ KHO HÀNG">
    <meta property = "og:url" content="QUANLYKHO.GA">
    <meta property = "og:image" content="https://quanlykho.ga/img/img-logo-seo.png">
    <meta property = "og:type" content="software">

    <!--css-->
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        body{ 
            background-color: #d1d1d9;
        }
        .wrapper{ 
            width: 360px; 
            padding: 20px; 
            margin: 50px auto;
            background-color: whitesmoke;
            border: 1px solid black;
            border-radius: 12px;
        }
        .text-header{
            text-align: center;
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
        HỆ THỐNG QUẢN LÝ KHO HÀNG
    </div>
    <div class="vien"></div>
    <div class="wrapper">
        <div class="text-header">
            <h2>Đổi Mật Khẩu</h2>
            <p>Vui lòng nhập chính xác các thông tin dưới đây</p>
        </div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
            <div class="form-group">
                <label>Mật khẩu mới</label>
                <input type="password" name="new_password" class="form-control <?php echo (!empty($new_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $new_password; ?>">
                <span class="invalid-feedback"><?php echo $new_password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Nhập lại mật khẩu mới</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group" style="text-align: center;">
                <input type="submit" class="btn btn-primary" value="Đổi mật khẩu">
                <a class="btn btn-link ml-2" href="dashboard.php">Huỷ</a>
            </div>
        </form>
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