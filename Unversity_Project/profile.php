<!DOCTYPE html>
<?php
require_once 'session_setup.php';
require_once 'contact.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Fetch additional user details
$user_id = $_SESSION['user_id'];
$stmt = $con->prepare("SELECT email, full_name, role FROM users WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user_data = $stmt->get_result()->fetch_assoc();
?>

<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>الملف الشخصي - كلية الحاسبات</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        .profile-section {
            padding: 80px 0;
            background: #f0f4f8;
            min-height: calc(100vh - 200px);
            display: flex;
            align-items: center;
        }

        .profile-card {
            background: #fff;
            max-width: 500px;
            margin: 0 auto;
            padding: 50px 40px;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            text-align: center;
            position: relative;
        }

        .profile-avatar {
            width: 100px;
            height: 100px;
            background: #7cb342;
            color: #fff;
            font-size: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin: 0 auto 25px;
            box-shadow: 0 8px 15px rgba(124, 179, 66, 0.3);
        }

        .profile-name {
            font-size: 26px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .profile-role {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 25px;
        }

        .role-admin {
            background: #e3f2fd;
            color: #1976d2;
        }

        .role-student {
            background: #f1f8e9;
            color: #558b2f;
        }

        .profile-info {
            border-top: 1px solid #eee;
            padding-top: 25px;
            text-align: right;
            margin-bottom: 35px;
        }

        .info-item {
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 12px;
            color: #555;
        }

        .info-label {
            font-weight: 700;
            color: #7f8c8d;
            width: 80px;
        }

        .profile-actions {
            display: flex;
            gap: 15px;
            justify-content: center;
        }

        .btn-logout {
            background: #e74c3c;
            color: #fff !important;
            padding: 10px 25px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-logout:hover {
            background: #c0392b;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(231, 76, 60, 0.3);
        }

        .btn-home {
            background: #2c3e50;
            color: #fff !important;
            padding: 10px 25px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-home:hover {
            background: #1a252f;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(44, 62, 80, 0.3);
        }
    </style>
</head>

<body>

    <header class="header">
        <div class="container">
            <div class="logo">
                <img src="images/logo.png" alt="Logo">
                <span>كلية الحاسبات وتكنولوجيا المعلومات</span>
            </div>

            <nav class="nav">
                <a href="index.php">الرئيسية</a>
                <a href="about.php">عن الكلية</a>
                <a href="department.php">الأقسام</a>
                <a href="programesA.php">البرامج</a>
                <a href="news.php">الأخبار</a>
                <a href="contact_us.php">اتصل بنا</a>

                <a href="logout.php" class="login-link" style="background:#e74c3c;">تسجيل الخروج</a>
            </nav>
        </div>
    </header>

    <section class="profile-section">
        <div class="container">
            <div class="profile-card">
                <div class="profile-avatar">👤</div>
                <h2 class="profile-name"><?= htmlspecialchars($user_data['full_name']); ?></h2>
                <span class="profile-role <?= ($user_data['role'] === 'مسؤول') ? 'role-admin' : 'role-student'; ?>">
                    <?= htmlspecialchars($user_data['role']); ?>
                </span>

                <div class="profile-info">
                    <div class="info-item">
                        <span class="info-label">الإيميل:</span>
                        <span><?= htmlspecialchars($user_data['email']); ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">العضوية:</span>
                        <span><?= htmlspecialchars($user_data['role']); ?></span>
                    </div>
                </div>

                <div class="profile-actions">
                    <a href="index.php" class="btn-home">الرئيسية</a>
                    <a href="logout.php" class="btn-logout">تسجيل الخروج</a>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <p>© 2026 كلية الحاسبات وتكنولوجيا المعلومات</p>
    </footer>

</body>

</html>