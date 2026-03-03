<?php require_once 'session_setup.php';
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>كلية الحاسبات وتكنولوجيا المعلومات</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>

<body>

    <!-- Header -->
    <header class="header">
        <div class="container">
            <div class="logo">
                <img src="images/logo.png" alt="Green Tech">
                <span>كلية الحاسبات وتكنولوجيا المعلومات</span>
            </div>
            <nav class="nav">
                <a href="index.php">الرئيسية</a>
                <a href="about.php">عن الكلية</a>
                <a href="department.php">الأقسام</a>
                <a href="programesA.php">البرامج</a>
                <a href="news.php">الأخبار</a>
                <a href="contact_us.php">اتصل بنا</a>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="profile.php" class="login-link">
                        👤 الملف الشخصي
                    </a>
                    <a href="logout.php" class="login-link">
                        تسجيل الخروج
                    </a>
                <?php else: ?>
                    <a href="login.php" class="login-link">
                        تسجيل الدخول
                    </a>
                <?php endif; ?>

            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="overlay"></div>
        <div class="hero-content">
            <h1>افتتاح برنامج جديد في كلية الحاسبات</h1>
            <p>نسعى لإعداد كوادر تقنية متميزة تلبي متطلبات سوق العمل</p>
            <a href="News.php" class="btn">اقرأ المزيد</a>
        </div>
    </section>

    <!-- About -->
    <section class="about">
        <div class="container">
            <div class="about-text">
                <h2>عن الكلية</h2>
                <p>
                    تهدف كلية الحاسبات وتكنولوجيا المعلومات إلى إعداد خريجين
                    مؤهلين علميًا وعمليًا في مجالات الحوسبة والتقنيات الحديثة.
                </p>
            </div>
            <div class="about-logo">
                <img src="images/logo.png" alt="Green Tech">
            </div>
        </div>
    </section>

    <!-- Programs -->
    <?php
    include('contact.php');
    $sql = "select * from program order by id_program DESC";
    $sp = $con->prepare($sql);
    $sp->execute();
    $result = $sp->get_result();
    ?>
    <section class="programs">
        <h2 class="section-title">البرامج الأكاديمية</h2>

        <div class="container grid">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="card">

                    <?php if (!empty($row['image'])): ?>
                        <img src="uploads/<?= htmlspecialchars($row['image']); ?>"
                            alt="برنامج"
                            style="width:100%;height:160px;object-fit:cover;border-radius:6px;margin-bottom:12px;">
                    <?php endif; ?>

                    <h3><?= htmlspecialchars($row['name_program']); ?></h3>

                    <p>
                        <?= htmlspecialchars($row['text_program']); ?>
                    </p>

                </div>
            <?php endwhile; ?>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>© 2026 كلية الحاسبات وتكنولوجيا المعلومات</p>
        </div>
    </footer>

</body>

</html>