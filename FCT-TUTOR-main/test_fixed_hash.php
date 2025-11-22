<?php
// Manual test signup with hashing
require_once "dbconnect.php";
require_once "functions_student.php";

echo "=== Testing Password Hashing with Corrected DB Schema ===\n\n";

// Simulate form data
$email = "testuser@university.com";
$studentId = "STU_TEST_001";
$username = "testuser";
$password = "password123";

// This simulates the signup process
echo "1. Calling createStudent() with:\n";
echo "   Password: " . $password . "\n\n";

// We'll hash manually here to verify
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
echo "2. Generated hash: " . $hashedPassword . "\n";
echo "3. Hash length: " . strlen($hashedPassword) . " characters\n\n";

// Clean up first
$delSql = "DELETE FROM student WHERE St_id = ?";
$delStmt = $conn->prepare($delSql);
$delStmt->bind_param("s", $studentId);
$delStmt->execute();
$delStmt->close();

// Insert with hashed password
$sql = "INSERT INTO student (Email, St_id, Username, Password) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $email, $studentId, $username, $hashedPassword);

if ($stmt->execute()) {
    echo "4. Insert successful\n\n";
    
    // Retrieve and verify
    echo "5. Retrieving from database...\n";
    $querySql = "SELECT Password FROM student WHERE St_id = ?";
    $queryStmt = $conn->prepare($querySql);
    $queryStmt->bind_param("s", $studentId);
    $queryStmt->execute();
    $result = $queryStmt->get_result();
    $row = $result->fetch_assoc();
    $dbPassword = $row["Password"];
    
    echo "6. Password in DB: " . $dbPassword . "\n";
    echo "7. DB password length: " . strlen($dbPassword) . " characters\n\n";
    
    if (strlen($dbPassword) == 60) {
        echo "✓ Password is correctly hashed (60 char bcrypt)\n\n";
    } else {
        echo "❌ Password is NOT hashed correctly!\n\n";
    }
    
    // Test verification
    echo "8. Testing login with correct password...\n";
    $verify1 = password_verify($password, $dbPassword);
    echo "   Result: " . ($verify1 ? "✓ MATCH" : "❌ NO MATCH") . "\n\n";
    
    echo "9. Testing login with wrong password...\n";
    $verify2 = password_verify("wrongpass", $dbPassword);
    echo "   Result: " . ($verify2 ? "✓ MATCH" : "❌ NO MATCH (Correct!)") . "\n\n";
    
    $queryStmt->close();
    
    // Clean up test record
    $delSql2 = "DELETE FROM student WHERE St_id = ?";
    $delStmt2 = $conn->prepare($delSql2);
    $delStmt2->bind_param("s", $studentId);
    $delStmt2->execute();
    $delStmt2->close();
    
} else {
    echo "❌ Insert failed: " . $stmt->error . "\n";
}

$stmt->close();
$conn->close();

echo "\n=== NEXT STEPS ===\n";
echo "1. Delete all old accounts from student and tutor tables\n";
echo "2. Register a NEW account via the web form\n";
echo "3. Login with that new account\n";
echo "4. It should now work!\n";
?>
