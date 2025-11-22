<?php
// Debug test script to verify password hashing/verification
// This simulates the exact flow during signup and login

echo "=== Password Hash/Verify Test ===\n\n";

// Test 1: Hash a test password (like during signup)
$testPassword = "test123";
$hashedPassword = password_hash($testPassword, PASSWORD_DEFAULT);

echo "1. Original Password: " . $testPassword . "\n";
echo "2. Hashed Password: " . $hashedPassword . "\n";
echo "3. Hash Length: " . strlen($hashedPassword) . " characters\n\n";

// Test 2: Verify the password (like during login)
$loginPassword = "test123";
$isVerified = password_verify($loginPassword, $hashedPassword);

echo "4. Login with password: " . $loginPassword . "\n";
echo "5. Password Verify Result: " . ($isVerified ? "TRUE (Match!)" : "FALSE (No Match)") . "\n\n";

// Test 3: Try wrong password
$wrongPassword = "wrongpass";
$isWrongVerified = password_verify($wrongPassword, $hashedPassword);

echo "6. Login with wrong password: " . $wrongPassword . "\n";
echo "7. Password Verify Result: " . ($isWrongVerified ? "TRUE (Match!)" : "FALSE (No Match)") . "\n\n";

// Test 4: Simulate database storage and retrieval
echo "=== Simulating Database Storage ===\n\n";

$dbStoredHash = $hashedPassword; // This is what gets stored in DB
echo "8. Stored in DB: " . $dbStoredHash . "\n";

// Retrieve and verify (like in LoginUser)
$retrievedHash = $dbStoredHash; // Simulating database retrieval
$loginAttempt = "test123";
$dbVerification = password_verify($loginAttempt, $retrievedHash);

echo "9. Retrieved from DB: " . $retrievedHash . "\n";
echo "10. Login attempt with correct password: " . $loginAttempt . "\n";
echo "11. Verification Result: " . ($dbVerification ? "TRUE (Should Log In!)" : "FALSE (Wrong Password)") . "\n\n";

// Test 5: Check for whitespace issues
echo "=== Checking for Whitespace Issues ===\n\n";

$passwordWithSpaces = " test123 ";
$hashedWithSpaces = password_hash($passwordWithSpaces, PASSWORD_DEFAULT);
$verifyWithSpaces = password_verify($passwordWithSpaces, $hashedWithSpaces);
$verifyNoSpaces = password_verify("test123", $hashedWithSpaces);

echo "12. Password with spaces: '" . $passwordWithSpaces . "'\n";
echo "13. Hashed: " . $hashedWithSpaces . "\n";
echo "14. Verify WITH spaces: " . ($verifyWithSpaces ? "TRUE" : "FALSE") . "\n";
echo "15. Verify WITHOUT spaces: " . ($verifyNoSpaces ? "TRUE" : "FALSE") . "\n\n";

echo "=== Conclusion ===\n";
if ($isVerified && $dbVerification && !$verifyNoSpaces) {
    echo "✓ Password hashing and verification are working correctly.\n";
    echo "✓ If login still fails, the issue is likely:\n";
    echo "  - Username not matching between signup and login\n";
    echo "  - Password field from form has extra whitespace\n";
    echo "  - Database query not retrieving the correct user\n";
} else {
    echo "✗ Password hashing/verification has issues.\n";
}
?>
