<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Username chỉ có thể chứa các chữ cái, số và dấu gạch dưới.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "Username đã tồn tại, vui lòng chọn username khác!";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Đã sảy ra lỗi! Vui lòng thử lại sau.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Nhập lại mật khẩu";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Mật khẩu tối thiểu 6 ký tự";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Vui lòng nhập lại mật khẩu";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Mật khẩu không khớp.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Đã sảy ra lỗi, vui lòng thử lại sau";
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
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng ký tài khoản - Hệ Thống Quản Lý Kho</title>

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
    
    <div class="container1">
        <div class="wrapper">
            <div class="text-header">
                <h2>Đăng ký tài khoản</h2>
                <p>Vui lòng điền đầy đủ thông tin vào form dưới đây để tạo tài khoản!</p>
            </div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" placeholder="Nhập username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                    <span class="invalid-feedback"><?php echo $username_err; ?></span>
                </div>    
                <div class="form-group">
                    <label>Mật khẩu</label>
                    <input type="password" name="password" placeholder="Nhập mật khẩu" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                    <span class="invalid-feedback"><?php echo $password_err; ?></span>
                </div>
                <div class="form-group">
                    <label>Nhập lại mật khẩu</label>
                    <input type="password" name="confirm_password" placeholder="Nhập lại mật khẩu" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                    <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                </div>
                <div class="form-group" style="text-align: center;">
                    <input type="submit" class="btn btn-primary" value="Đăng ký">
                    <input type="reset" class="btn btn-secondary ml-2" value="Nhập lại">
                </div>
                <p style="text-align: center;">Đã có tài khoản? Đăng nhập<a href="login.php"> tại đây</a>.</p>
            </form>
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