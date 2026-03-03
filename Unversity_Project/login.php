<?php
require_once 'session_setup.php';
$errors = $_SESSION['errors'] ?? [];
$login_error = $_SESSION['login_error'] ?? '';
$old = $_SESSION['old'] ?? [];
unset($_SESSION['errors'], $_SESSION['old'], $_SESSION['login_error']);
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>تسجيل الدخول</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>

<body class="login-body">

    <div class="login-box">
        <img src="images/logo.png">
        <h2>تسجيل الدخول</h2>

        <form action="login_process.php" method="POST">
            <input type="email" name="email" placeholder="البريد الإلكتروني" required value="<?= htmlspecialchars($old['email'] ?? '') ?>">
            <?php if (isset($errors['email'])): ?>
                <span class="error"><?= $errors['email'] ?></span>
            <?php endif; ?>

            <input type="password" name="password" placeholder="كلمة المرور" required>
            <?php if (isset($errors['password'])): ?>
                <span class="error"><?= $errors['password'] ?></span>
            <?php endif; ?>
            <?php if ($login_error): ?>
                <span class="error" style="color: red; display: block; margin-top: 5px;"><?= $login_error ?></span>
            <?php endif; ?>



            <?php if (isset($errors['general'])): ?>
                <div class="error" style="display:block;margin-bottom:10px;"><?= $errors['general'] ?></div>
            <?php endif; ?>

            <input type="submit" value="تسجيل الدخول">
            <p class="form-link">
                ليس لديك حساب؟
                <a href="create.php">إنشاء حساب</a>
            </p>
        </form>
    </div>

</body>

</html>