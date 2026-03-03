<?php
require_once 'session_setup.php';
$errors  = $_SESSION['errors'] ?? [];
$success = $_SESSION['success'] ?? '';
$old     = $_SESSION['old'] ?? [];

unset($_SESSION['errors'], $_SESSION['success'], $_SESSION['old']);
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>إنشاء حساب</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>

<body class="login-body">

    <div class="login-box">
        <img src="images/logo.png">
        <h2>إنشاء حساب جديد</h2>

        <?php if ($success): ?>
            <div class="success"><?= $success ?></div>
        <?php endif; ?>

        <?php if (isset($errors['general'])): ?>
            <div class="error"><?= $errors['general'] ?></div>
        <?php endif; ?>

        <form method="post" action="Create_user.php">

            <input type="text" name="name" placeholder="الاسم الكامل"
                value="<?= htmlspecialchars($old['name'] ?? '') ?>">
            <?php if (isset($errors['name'])): ?>
                <div class="error"><?= $errors['name'] ?></div>
            <?php endif; ?>

            <input type="email" name="email" placeholder="البريد الإلكتروني"
                value="<?= htmlspecialchars($old['email'] ?? '') ?>">
            <?php if (isset($errors['email'])): ?>
                <div class="error"><?= $errors['email'] ?></div>
            <?php endif; ?>

            <input type="password" name="password" placeholder="كلمة المرور">
            <?php if (isset($errors['password'])): ?>
                <div class="error"><?= $errors['password'] ?></div>
            <?php endif; ?>

            <input type="password" name="password1" placeholder="تأكيد كلمة المرور">
            <?php if (isset($errors['password1'])): ?>
                <div class="error"><?= $errors['password1'] ?></div>
            <?php endif; ?>
            <input type="submit" value="إنشاء حساب">
        </form>

        <p class="form-link">
            لديك حساب بالفعل؟
            <a href="login.php">تسجيل الدخول</a>
        </p>
    </div>

</body>

</html>