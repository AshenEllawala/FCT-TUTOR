<?php
// Server-rendered student registration page
// Reads `?error=` or `?success=` from query and shows friendly messages
$message = '';
$message_type = 'info';
if (isset($_GET['error'])) {
    switch ($_GET['error']) {
        case 'emptyinput': $message = 'Please fill all fields.'; $message_type='error'; break;
        case 'invalidusername': $message = 'Username contains invalid characters.'; $message_type='error'; break;
        case 'invalidemail': $message = 'Please enter a valid email address.'; $message_type='error'; break;
        case 'usernametaken': $message = 'Username or email already exists.'; $message_type='error'; break;
        case 'stmtfailed': $message = 'Server error. Please try again later.'; $message_type='error'; break;
        default: $message = 'An error occurred.'; $message_type='error';
    }
} elseif (isset($_GET['success']) || (isset($_GET['error']) && $_GET['error']==='none')) {
    $message = 'Registration successful. You can now log in.'; $message_type='success';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <link rel="stylesheet" href="css/registration.css">
</head>

<body>
    <div class="container">
        <div class="registration-box">
            <h1 style="font-weight: 550">Registration</h1>

            <?php if (!empty($message)): ?>
                <div class="message" style="margin-bottom:12px; color: <?php echo ($message_type==='error') ? '#b00020' : '#006600'; ?>;">
                    <?php echo htmlspecialchars($message); ?>
                </div>
            <?php endif; ?>

            <form id="student_registrationForm" action="signup_student.php" method="POST">
                <div class="form-group">
                    <input type="text" name="s_id" id="studentid" placeholder="Student Id :" required>
                </div>

                <div class="form-group">
                    <input type="text" name="u_name" id="username" placeholder="Username :" required>
                </div>

                <div class="form-group">
                    <input type="password" name="pwd" id="password" placeholder="Password :" required>
                </div>
                <div class="form-group">
                    <input type="email" name="email" id="email" placeholder="University Email:" required>
                </div>

                <div class="button-group">
                    <button type="submit" name="submit" class="submit-btn">Submit</button>
                    <button type="button" name="clear" class="clear-btn" id="clearBtn">Clear</button>
                </div>
            </form>
        </div>
    </div>

    <script src="js/student_registration.js"></script>
    <script>
        document.getElementById('clearBtn').addEventListener('click', function(){
            document.getElementById('studentid').value='';
            document.getElementById('username').value='';
            document.getElementById('password').value='';
            document.getElementById('email').value='';
        });
    </script>
</body>

</html>
