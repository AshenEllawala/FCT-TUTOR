<?php
session_start();

// Default role is student
$role = "student";

if (isset($_GET["role"])) {
    $role = $_GET["role"];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="container">
        <div class="left-section">
            <div class="illustration">
                <img src="images/login_ilusstrator.png" alt="Learning illustration">
            </div>
        </div>
        
        <div class="right-section">
            <div class="logo-container">
                <div class="logo"><img src="images/logo.png"></div>
            </div>
            
            <div class="login-form">

                <?php
                // Map error codes to user-friendly messages
                $msg = '';
                if (isset($_GET['error'])) {
                    switch ($_GET['error']) {
                        case 'wronglogin':
                            $msg = 'User not found. Please register or check username/email.';
                            break;
                        case 'wrongpassword':
                            $msg = 'Incorrect password. Try again.';
                            break;
                        case 'emptyinput':
                            $msg = 'Please fill in all required fields.';
                            break;
                        case 'invalidusername':
                            $msg = 'Username contains invalid characters.';
                            break;
                        case 'invalidemail':
                            $msg = 'Please enter a valid email address.';
                            break;
                        case 'usernametaken':
                            $msg = 'Username or email already taken.';
                            break;
                        case 'stmtfailed':
                            $msg = 'Server error. Please try again later.';
                            break;
                        case 'none':
                            $msg = 'Registration successful. You can now log in.';
                            break;
                        default:
                            $msg = '';
                    }
                }
                ?>

                <?php if (!empty($msg)): ?>
                    <div class="error-message" style="color: #b00020; margin-bottom: 12px;"><?php echo htmlspecialchars($msg); ?></div>
                <?php endif; ?>

                <form id="loginForm" action="login_process.php" method="post">
                    <div class="form-group">
                        <input type="text" name="u_name" id="username" placeholder="User Name:" required>
                    </div>

                    <div class="form-group">
                        <input type="password" name="pwd" id="password" placeholder="Password:" required>
                    </div>

                    <button type="submit" name="submit" class="login-btn">Log In</button>
                </form>

                <div class="form-links">
                    <a href="#" class="link">Forget Your Password</a>
                    <a href="user_role.html" class="link">Create an account</a>
                </div>
                
               
                
                <div class="terms">
                    By continuing, you agree to our 
                    <a href="#">Terms of Service</a> and 
                    <a href="#">Privacy Policy</a>
                </div>
            </div>
        </div>
    </div>
    
   <!-- <script src="js/login.js"></script>-->
</body>
</html>