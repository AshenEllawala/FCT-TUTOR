<?php
// Simple auth helper: include this at the top of pages that require login
session_start();
if (!isset($_SESSION['username']) || !isset($_SESSION['role'])) {
    header('Location: login.php');
    exit();
}
?>