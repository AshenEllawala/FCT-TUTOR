<?php
// Test to verify password_hash is working in the actual signup scenario
require_once "dbconnect.php";

echo "=== Checking Password Hashing in Student Registration ===\n\n";

// Simulate form input
$email = "test_hash@university.com";
$studentId = "STU_HASH_001";
$username = "hash_test_user";
$password = "testpass123";

echo "1. Input password: " . $password . "\n";
echo "2. Testing password_hash()...\n";

$hashedPwd = password_hash($password, PASSWORD_DEFAULT);
echo "3. Hashed password: " . $hashedPwd . "\n";
echo "4. Hash length: " . strlen($hashedPwd) . " characters\n";

if (strlen($hashedPwd) > 50) {
    echo "✓ Hash looks correct (60+ characters for bcrypt)\n\n";
} else {
    echo "❌ Hash is too short - something is wrong!\n\n";
}

// Now try inserting into database
echo "5. Inserting test record into database...\n\n";

// First, delete if exists
$delSql = "DELETE FROM student WHERE St_id = ?";
$delStmt = $conn->prepare($delSql);
$delStmt->bind_param("s", $studentId);
$delStmt->execute();
$delStmt->close();

// Now insert
$sql = "INSERT INTO student (Email, St_id, Username, Password) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $email, $studentId, $username, $hashedPwd);

if ($stmt->execute()) {
    echo "✓ Inserted successfully\n\n";
    
    // Now retrieve and check what's in the database
    echo "6. Retrieving from database...\n";
    $selectSql = "SELECT Password FROM student WHERE St_id = ?";
    $selectStmt = $conn->prepare($selectSql);
    $selectStmt->bind_param("s", $studentId);
    $selectStmt->execute();
    $result = $selectStmt->get_result();
    $row = $result->fetch_assoc();
    $dbPassword = $row["Password"];
    
    echo "7. Password stored in DB: " . $dbPassword . "\n";
    echo "8. Password length in DB: " . strlen($dbPassword) . " characters\n";
    
    if (strlen($dbPassword) == 60) {
        echo "✓ DB password looks correct (60 characters)\n\n";
    } else {
        echo "❌ DB password is wrong length: " . strlen($dbPassword) . "\n\n";
    }
    
    // Test verification
    echo "9. Testing password_verify()...\n";
    $isMatch = password_verify($password, $dbPassword);
    echo "10. Result: " . ($isMatch ? "TRUE (Match!)" : "FALSE (No Match)") . "\n";
    
    $selectStmt->close();
} else {
    echo "❌ Insert failed: " . $stmt->error . "\n";
}

$stmt->close();

// Clean up - delete the test record
$delSql2 = "DELETE FROM student WHERE St_id = ?";
$delStmt2 = $conn->prepare($delSql2);
$delStmt2->bind_param("s", $studentId);
$delStmt2->execute();
$delStmt2->close();

$conn->close();

echo "\n=== Conclusion ===\n";
echo "If hash length is 60 and verify returns TRUE, password hashing is working.\n";
echo "If password in DB is plain text or short, check if password_hash() is being called.\n";
?>
