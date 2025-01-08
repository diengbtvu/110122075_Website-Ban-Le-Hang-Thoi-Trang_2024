
<?php
    session_start();
    ob_start();
    include "../model/connectdb.php";
    include "../model/userdb.php";

    // Tạo CSRF token nếu chưa có
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    if(isset($_POST['user_check'])) {
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            die('CSRF token validation failed');
        }

        $user = htmlspecialchars(trim($_POST['username']));
        $pass = trim($_POST['password']);

        if(empty($user) || empty($pass)) {
            $error_msg = "Vui lòng điền đầy đủ thông tin!";
        } else {
            $role = check_user($user, $pass);
            if($role == 1) {
                $_SESSION['name'] = $user;
                $_SESSION['role'] = $role;
                header('location: admin.php?act=statistic');
                exit();
            } else {
                $error_msg = "Tên đăng nhập hoặc mật khẩu không đúng!";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="initial-scale=1, minimum-scale=1, width=device-width" name="viewport">
    <meta name="robots" content="noindex, nofollow">
    <title>Đăng nhập - Hệ thống quản lý</title>
    <link rel="icon" href="images/MiniLogo.png" sizes="32x32">
    <!-- inject:css -->
    <link rel="stylesheet" href="vendors/fomantic-ui/semantic.min.css">
    <link rel="stylesheet" href="css/main.css">
    <!-- endinject -->
</head>

<body class="login-page">
    <div class="ui container centered grid">
        <div class="five wide computer sixteen wide tablet sixteen wide phone column" style="margin-top: 5%;">
            <div class="ui segment">
                <img class="ui centered medium image" src="images/MH-logo.png" alt="Logo">
                <h2 class="ui center aligned header">
                    <div class="content">
                        Đăng nhập hệ thống
                        <div class="sub header">Vui lòng đăng nhập để tiếp tục</div>
                    </div>
                </h2>
                <?php if(isset($error_msg)): ?>
                    <div class="ui negative message">
                        <i class="close icon"></i>
                        <div class="header">Đăng nhập thất bại</div>
                        <p><?php echo $error_msg; ?></p>
                    </div>
                <?php endif; ?>
                <form class="ui form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    <input type="hidden" name="user_check" value="1">
                    <div class="field">
                        <label>Tài khoản</label>
                        <div class="ui left icon input">
                            <input name="username" placeholder="Nhập tên đăng nhập" type="text" required 
                                   value="<?php echo isset($user) ? htmlspecialchars($user) : ''; ?>">
                            <i class="user icon"></i>
                        </div>
                    </div>
                    <div class="field">
                        <label>Mật khẩu</label>
                        <div class="ui left icon input">
                            <input name="password" placeholder="Nhập mật khẩu" type="password" required>
                            <i class="lock icon"></i>
                        </div>
                    </div>
                    <button class="ui fluid large primary submit button" type="submit">
                        <i class="sign in icon"></i>
                        Đăng nhập
                    </button>
                </form>
            </div>
            <div class="ui message">
                <p>Quên mật khẩu? Vui lòng liên hệ quản trị viên</p>
            </div>
        </div>
    </div>

    <!-- inject:js -->
    <script src="vendors/jquery/jquery.min.js"></script>
    <script src="vendors/fomantic-ui/semantic.min.js"></script>
    <!-- endinject -->
    
    <script>
    $(document).ready(function() {
        // Form validation
        $('.ui.form').form({
            fields: {
                username: {
                    identifier: 'username',
                    rules: [
                        {
                            type: 'empty',
                            prompt: 'Vui lòng nhập tên đăng nhập'
                        }
                    ]
                },
                password: {
                    identifier: 'password',
                    rules: [
                        {
                            type: 'empty',
                            prompt: 'Vui lòng nhập mật khẩu'
                        }
                    ]
                }
            }
        });

        // Close message
        $('.message .close').on('click', function() {
            $(this).closest('.message').transition('fade');
        });
    });
    </script>
</body>
</html>