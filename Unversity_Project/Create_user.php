<?php
require_once 'session_setup.php';
include('contact.php');
$errors = [];
$old = $_POST;

$name  = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$pass1 = $_POST['password'] ?? '';
$pass2 = $_POST['password1'] ?? '';
$role  = 'طالب';


if ($name === '') {
    $errors['name'] = "اسم المستخدم مطلوب";
}

if ($email === '') {
    $errors['email'] = "البريد الإلكتروني مطلوب";
}

if ($pass1 === '') {
    $errors['password'] = "كلمة المرور مطلوبة";
}

if ($pass1 !== $pass2) {
    $errors['password1'] = "كلمتا المرور غير متطابقتين";
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = "البريد الإلكتروني غير صحيح";
}

if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    $_SESSION['old'] = $old;
    header("Location: create.php");
    exit;
}


$password = password_hash($pass1, PASSWORD_DEFAULT);
$stmt = $con->prepare(
    "INSERT INTO users(full_name, email, password, role) VALUES (?, ?, ?, ?)"
);
$stmt->bind_param("ssss", $name, $email, $password, $role);

if ($stmt->execute()) {
    $_SESSION['success'] = "تم إنشاء الحساب بنجاح";
    header("Location: index.php");
} else {
    $_SESSION['errors']['general'] = "حدث خطأ أثناء التسجيل";
}


header("Location: create.php");
exit;
