<?php

require_once ("dbconnect.php");
require_once ("functions_tutor.php");

// Check if the user clicked the submit button
if (isset($_POST["submit"])) {

    // 1. Get data from the form
    $email = $_POST["email"];
    $tutorId = $_POST["t_id"];
    $username = $_POST["u_name"];
    $password = $_POST["pwd"];
    $courseId = $_POST["c_id"];


    // Trim whitespace from inputs
    $email = trim($email);
    $tutorId = trim($tutorId);
    $username = trim($username);
    $password = trim($password);
    $courseId = trim($courseId);

    $emptyInput=emptyInputSignup($email,$tutorId,$username,$password,$courseId);
    $invalidUid=invalidUid($username);
    $invalidEmail=invalidEmail($email);
    $uidExists=uidExists($conn,$username, $email);

    if($emptyInput !== false){
        header("Location:tutor_registration.php?error=emptyinput");
        exit();
    }
     if($invalidUid !== false){
        header("Location:tutor_registration.php?error=invalidusername");
        exit();
    }
     if($invalidEmail !== false){
        header("Location:tutor_registration.php?error=invalidemail");
        exit();
    }

     if($uidExists !== false){
        header("Location:tutor_registration.php?error=usernametaken");
        exit();
    }
    createTutor($conn,$tutorId,$username,$password,$email,$courseId);

}
    else{
        header("Location:login.php");
        exit();
    }