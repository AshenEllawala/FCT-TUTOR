function selectRole(role) {
    localStorage.setItem("selectedRole", role);
    
    if (role === 'student') {
        window.location.href = "student_registration.php";
    } else if (role === 'tutor') {
        window.location.href = "tutor_registration.php";
    }
}
