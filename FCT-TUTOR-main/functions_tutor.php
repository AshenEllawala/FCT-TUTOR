<?php

// --- VALIDATION FUNCTIONS ---

// Check for empty fields
// I've added $studentId and $role to match your new form
function emptyInputSignup($email, $tutorId, $username, $password,$courseId) {
    $result=false;
    if (empty($email) || empty($tutorId)|| empty($username) || empty($password)||empty($courseId)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

// Check for invalid username characters (from your notes)
function invalidUid($username) {
    $result = false;
    if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

// Check for invalid email format (from your notes)
function invalidEmail($email) {
    $result = false;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}


// --- DATABASE FUNCTIONS ---

// Check if username or email already exists in the DB (from your notes)
function uidExists($conn, $username, $email) {
    $sql = "SELECT * FROM tutor WHERE Username = ? OR Email = ?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location:tutor_registration.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        mysqli_stmt_close($stmt);
        return $row; // Return user data if user exists
    } else {
        mysqli_stmt_close($stmt);
        return false;
    }
}

// Create the new user in the database
// I've added $studentId and $role to this function

// Create the new user in the database
// I've added $studentId and $role to this function
function createTutor($conn,$tutorId,$username,$password,$email,$courseId) {

    $sql = "INSERT INTO tutor (Tutor_id,Username,Password,Email,Course_id) 
            VALUES (?, ?, ?, ?,?)";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location:tutor_registration.php?error=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($password,PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sssss",
        $tutorId,
        $username,
        $hashedPwd,
        $email,
        $courseId
    );

    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("Location: login.php?error=none");
    exit();
}


function LoginUser($conn, $username, $password){

    // Correct: check username or email
    $uidExists = uidExists($conn, $username, $username);

    if($uidExists === false){
        header("Location:login.php?error=wronglogin");
        exit();
    }
    // Make sure correct column name
    $pwdHashed = $uidExists["Password"];
    $checkpwd=password_verify($password, $pwdHashed);

    if ($checkpwd===false) {
        header("Location:login.php?error=wrongpassword");
        exit();
    }

    if($checkpwd===true){
        // session_start() is already called in login_process.php, no need to call again
        $_SESSION["Tutor_id"] = $uidExists["Tutor_id"]; 
        $_SESSION["username"] = $uidExists["Username"];
        $_SESSION["role"] = "tutor";

        header("Location: index.php");
        exit();
    }
}
