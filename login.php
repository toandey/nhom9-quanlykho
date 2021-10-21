<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to dashboard page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: dashboard.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Vui lòng nhập username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Vui lòng nhập mật khẩu.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to dashboard page
                            header("location: dashboard.php");
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Sai username hoặc mật khẩu.";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Sai username hoặc mật khẩu.";
                }
            } else{
                echo "Đã sảy ra lỗi, vui lòng thử lại.";
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Đăng nhập - Hệ Thống Quản Lý Kho Hàng</title>

    <!--icon-->
    <link rel="shortcut icon" href="https://codesign.com.bd/conversations/content/images/2020/03/Sprint-logo-design-Codesign-agency.png" type="image/x-icon">
    <!--seo-->
    <meta property = "og:description" content="Hệ thống quản lý kho hàng thông minh, hiện đại, dễ dàng sử dụng. Phù hợp cho hộ kinh doanh và các doanh nghiệp nhỏ.">
    <meta property = "og:title" content="HỆ THỐNG QUẢN LÝ KHO HÀNG">
    <meta property = "og:url" content="QUANLYKHO.GA">
    <meta property = "og:image" content="https://quanlykho.ga/img/img-logo-seo.png">
    <meta property = "og:type" content="software">
</head>
<style>
    body{
        background-color: #d1d1d9;
        font-size: 12pt;
    }
</style>
<body>
    <div class="header">
        HỆ THỐNG QUẢN LÝ KHO HÀNG
    </div>
    <div class="vien"></div>
    <div id="container">
    <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div id="form-login">
                <h1 id="h1-header">ĐĂNG NHẬP VÀO HỆ THỐNG</h1>
                <div class="img-login">
                    <img src="https://www.w3schools.com/howto/img_avatar2.png" alt="img login" class="avatar">
                </div>
                <div id="input-box">
                    <input type="text" name="username" placeholder="Nhập username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                    <span class="invalid-feedback"><?php echo $username_err; ?></span> 
                </div>
                <div id="input-box">
                    <input type="password" name="password" placeholder="Nhập mật khẩu" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                    <span class="invalid-feedback"><?php echo $password_err; ?></span>
                </div>
                <p style="text-align: right; padding-bottom: 10px;"><i>Quên mật khẩu?</i></p>
                <div class="button-login">
                    <input type="submit" id="button-login" value="Đăng nhập">
                </div>
                <div id="text-body" style="margin-bottom: 5px;">
                    Đăng nhập nhanh bằng
                </div>
                <div id="social-network-login">
                    <ul>
                        <li style="background-color: #385898; color: #fff;">Facebook</li>
                        <li style="background-color: #dd4b39; color: #fff;">Google</li>
                    </ul>
                </div>
                <div id="register">
                    Không có tài khoản? <a href="register.php">Đăng ký ngay!</a>
                </div>
            </div>
        </form>
    </div>
        
    <div class="footer">
        <div class="text-footer" style="font-size: 12pt;">
            Nhóm 9 - Lớp 19CN2
            <br>
            Hệ thống quản lý kho hàng thông minh, tiện lợi, dễ dàng sử dụng.
            <br>
            <img src="https://nhanh.vn/img/logo/bocongthuong/dathongbaobct.png" alt="Thông báo bộ công thương" width="90" height="36">
            <img src="https://nhanh.vn/img/logo/bocongthuong/dadangkybct.png" alt="Thông báo bộ công thương" width="90" height="36">
            <p style=" font-size: 11px;"><i>version: 101021(1.0-alpha)</i></p>
        </div>
    </div>
    <div class="end-footer" style="font-size: 12pt;">
        Copyright 2021 by QuanLyKho. Made with ❤️️ in HaNoi.
    </div>
</body>
</html>