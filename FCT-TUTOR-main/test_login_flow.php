<?php
// Diagnostic script to test the actual login flow with database
// This helps identify if the issue is in the uidExists() query

require_once "dbconnect.php";

echo "=== Login Flow Diagnostic ===\n\n";

// Test with functions_student.php
require_once "functions_student.php";

$testUsername = "testuser";  // Change this to a username you actually registered
$testPassword = "test123";   // Change this to the password you used

echo "Testing login for username: " . $testUsername . "\n";
echo "Testing password: " . $testPassword . "\n\n";

// Step 1: Check if user exists in database
echo "Step 1: Checking if user exists using uidExists()...\n";
$userRow = uidExists($conn, $testUsername, $testUsername);

if ($userRow === false) {
    echo "❌ User NOT found in database!\n";
    echo "   - Check if the username was registered correctly\n";
    echo "   - Check if you're querying the correct role (student/tutor)\n\n";
} else {
    echo "✓ User found!\n";
    echo "   Username: " . $userRow["Username"] . "\n";
    echo "   Email: " . $userRow["Email"] . "\n";
    echo "   Stored Password Hash: " . $userRow["Password"] . "\n\n";
    
    // Step 2: Verify the password
    echo "Step 2: Verifying password...\n";
    $storedHash = $userRow["Password"];
    $isPasswordCorrect = password_verify($testPassword, $storedHash);
    
    if ($isPasswordCorrect) {
        echo "✓ Password is CORRECT!\n";
        echo "   Login should succeed.\n\n";
    } else {
        echo "❌ Password is INCORRECT!\n";
        echo "   - The password you entered doesn't match the stored hash\n";
        echo "   - Try re-registering with the same password\n\n";
    }
}

// Step 3: List all students in database to help debug
echo "Step 3: All registered students in database:\n";
$sql = "SELECT St_id, Username, Email FROM student";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "Found " . $result->num_rows . " students:\n";
    while ($row = $result->fetch_assoc()) {
        echo "  - ID: " . $row["St_id"] . " | Username: " . $row["Username"] . " | Email: " . $row["Email"] . "\n";
    }
} else {
    echo "No students registered yet.\n";
}

echo "\n";

// Step 4: List all tutors
echo "Step 4: All registered tutors in database:\n";
$sqlTutor = "SELECT Tutor_id, Username, Email, Course_id FROM tutor";
$resultTutor = $conn->query($sqlTutor);

if ($resultTutor->num_rows > 0) {
    echo "Found " . $resultTutor->num_rows . " tutors:\n";
    while ($row = $resultTutor->fetch_assoc()) {
        echo "  - ID: " . $row["Tutor_id"] . " | Username: " . $row["Username"] . " | Email: " . $row["Email"] . " | Course: " . $row["Course_id"] . "\n";
    }
} else {
    echo "No tutors registered yet.\n";
}

$conn->close();
?>
