<?php

require_once ("dbconnect.php");
require_once ("functions_student.php");

// Check if the user clicked the submit button
if (isset($_POST["submit"])) {

    // 1. Get data from the form
    $email = $_POST["email"];
    $studentId = $_POST["s_id"];
    $username = $_POST["u_name"];
    $password = $_POST["pwd"];


    // Trim whitespace from inputs
    $email = trim($email);
    $studentId = trim($studentId);
    $username = trim($username);
    $password = trim($password);

    $emptyInput=emptyInputSignup($email, $studentId, $username, $password);
    $invalidUid=invalidUid($username);
    $invalidEmail=invalidEmail($email);
    $uidExists=uidExists($conn, $username, $email);

    if($emptyInput !== false){
        header("Location:student_registration.php?error=emptyinput");
        exit();
    }
     if($invalidUid !== false){
        header("Location:student_registration.php?error=invalidusername");
        exit();
    }
     if($invalidEmail !== false){
        header("Location:student_registration.php?error=invalidemail");
        exit();
    }

     if($uidExists !== false){
        header("Location:student_registration.php?error=usernametaken");
        exit();
    }
    createStudent($conn,$email,$studentId,$username,$password);

}
    else{
        header("Location:login.php");
        exit();
    }








    

