<?php

session_start();

if (isset($_POST["submit"])) {

    $username = trim($_POST["u_name"]);
    $password = trim($_POST["pwd"]);

    require_once "dbconnect.php";

    if (empty($username) || empty($password)) {
        header("Location:login.php?error=emptyinput");
        exit();
    }

    // First try finding the user in students
    $sql = "SELECT * FROM student WHERE Username = ? OR Email = ? LIMIT 1;";
    $stmt = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "ss", $username, $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($result)) {
            // verify password
            if (password_verify($password, $row['Password'])) {
                $_SESSION["student_id"] = $row["St_id"];
                $_SESSION["username"] = $row["Username"];
                $_SESSION["role"] = "student";
                header("Location: index.php");
                exit();
            } else {
                header("Location: login.php?error=wrongpassword");
                exit();
            }
        }
        mysqli_stmt_close($stmt);
    }

    // Then try tutors
    $sql2 = "SELECT * FROM tutor WHERE Username = ? OR Email = ? LIMIT 1;";
    $stmt2 = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($stmt2, $sql2)) {
        mysqli_stmt_bind_param($stmt2, "ss", $username, $username);
        mysqli_stmt_execute($stmt2);
        $result2 = mysqli_stmt_get_result($stmt2);
        if ($row2 = mysqli_fetch_assoc($result2)) {
            if (password_verify($password, $row2['Password'])) {
                $_SESSION["Tutor_id"] = $row2["Tutor_id"];
                $_SESSION["username"] = $row2["Username"];
                $_SESSION["role"] = "tutor";
                header("Location: index.php");
                exit();
            } else {
                header("Location: login.php?error=wrongpassword");
                exit();
            }
        }
        mysqli_stmt_close($stmt2);
    }

    // If we got here nobody found
    header("Location: login.php?error=wronglogin");
    exit();

} else {
    header("Location:login.php");
    exit();
}





