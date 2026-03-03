<?php
require_once 'session_setup.php';
require_once 'contact.php';

$email    = trim($_POST['email'] ?? '');
$password = trim($_POST['password'] ?? '');

// جلب المستخدم
$stmt = $con->prepare(query: "SELECT user_id, full_name, password ,role FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows === 1) {

    $user = $result->fetch_assoc();

    if (password_verify($password, $user['password'])) {

        
        $_SESSION['user_id']   = $user['user_id'];
        $_SESSION['user_name'] = $user['full_name'];
        $_SESSION['role']      = $user['role'];
        header("Location: index.php");
        exit;
    }
}


$_SESSION['login_error'] = 'بيانات الدخول غير صحيحة';
header("Location: login.php");
exit;
