<!DOCTYPE html>
<?php
require_once 'session_setup.php';
?>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اتصل بنا</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        .page-title {
            background: #eef5ea;
            padding: 40px 0;
            text-align: center;
            color: #4b7f2f;
        }

        /* Form Specific Styles to match insert/update pages */
        .contact-section {
            padding: 60px 0;
            background-color: #f9f9f9;
        }

        .contact-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            padding: 40px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #2c3e50;
            font-size: 16px;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s;
            background-color: #fafafa;
        }

        .form-control:focus {
            outline: none;
            border-color: #3498db;
            background-color: white;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        }

        textarea.form-control {
            min-height: 150px;
            resize: vertical;
        }

        .submit-btn {
            background: linear-gradient(135deg, #2980b9, #3498db);
            color: white;
            border: none;
            padding: 14px 30px;
            font-size: 18px;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
            display: block;
            width: 100%;
            margin-top: 10px;
        }

        .submit-btn:hover {
            background: linear-gradient(135deg, #2573a7, #2980b9);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(41, 128, 185, 0.3);
        }

        .contact-info {
            text-align: center;
            margin-bottom: 40px;
        }

        .contact-info p {
            color: #666;
            margin-bottom: 10px;
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
                <a href="contact_us.php" class="active">اتصل بنا</a> <!-- Added active class if applicable in CSS -->

                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="profile.php" class="login-link">👤 الملف الشخصي</a>
                    <a href="logout.php" class="login-link">تسجيل الخروج</a>
                <?php else: ?>
                    <a href="login.php" class="login-link">تسجيل الدخول</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>

    <section class="page-title">
        <h1>اتصل بنا</h1>
    </section>

    <section class="contact-section">
        <div class="container">
            <div class="contact-container">
                <div class="contact-info">
                    <h3>نحن هنا لمساعدتك</h3>
                    <p>يمكنك التواصل معنا عبر النموذج التالي أو زيارة الكلية في أوقات الدوام الرسمي.</p>
                </div>

                <form action="" class="contact-form">
                    <div class="form-group">
                        <label for="name">الاسم الكامل</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="أدخل اسمك الكامل" required>
                    </div>

                    <div class="form-group">
                        <label for="email">البريد الإلكتروني</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="example@email.com" required>
                    </div>

                    <div class="form-group">
                        <label for="message">رسالتك</label>
                        <textarea id="message" name="message" class="form-control" placeholder="اكتب استفسارك أو رسالتك هنا..." required></textarea>
                    </div>

                    <button type="submit" class="submit-btn">إرسال الرسالة</button>
                </form>
            </div>
        </div>
    </section>

    <footer class="footer">
        <p>© 2026 كلية الحاسبات وتكنولوجيا المعلومات</p>
    </footer>

</body>

</html>