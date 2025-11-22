<?php
// Server-rendered tutor registration page
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
    <title>Tutor Registration</title>
    <link rel="stylesheet" href="css/registration.css">
</head>

<body>
    <div class="container">
        <div class="registration-box">
            <h1 style="font-weight: 550">Tutor Registration</h1>

            <?php if (!empty($message)): ?>
                <div class="message" style="margin-bottom:12px; color: <?php echo ($message_type==='error') ? '#b00020' : '#006600'; ?>;">
                    <?php echo htmlspecialchars($message); ?>
                </div>
            <?php endif; ?>

            <form id="registrationForm" action="signup_tutor.php" method="POST">
                <div class="form-group">
                    <input type="text" name="t_id" id="tutorid" placeholder="Tutor Id :" required>
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

                <div class="form-group">
                    <label for="courseid">Course:</label>
                    <select name="c_id" id="courseid" required>
                        <option value="">-- Select a Course --</option>
                        <option value="C101">C101 - Mathematics</option>
                        <option value="C102">C102 - Physics</option>
                        <option value="C103">C103 - Programming</option>
                        <option value="C104">C104 - Chemistry</option>
                        <option value="C105">C105 - Biology</option>
                        <option value="CT31043">CT31043 - Structure Programming</option>
                    </select>
                </div>

                <div class="button-group">
                    <button type="submit" name="submit" class="submit-btn">Submit</button>
                    <button type="button" class="clear-btn" id="clearBtn">Clear</button>
                </div>
            </form>
        </div>
    </div>

    <script src="js/tutor_registration.js"></script>
    <script>
        document.getElementById('clearBtn').addEventListener('click', function(){
            document.getElementById('tutorid').value='';
            document.getElementById('username').value='';
            document.getElementById('password').value='';
            document.getElementById('email').value='';
            document.getElementById('courseid').value='';
        });
    </script>
</body>

</html>
