<!DOCTYPE html>
<?php require_once 'session_setup.php';
?>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>الأقسام الأكاديمية</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>

<body>

    <header class="header">
        <div class="container">
            <div class="logo">
                <img src="images/logo.png">
                <span>كلية الحاسبات وتكنولوجيا المعلومات</span>
            </div>
            <nav class="nav">
                <a href="index.php">الرئيسية</a>
                <a href="about.php">عن الكلية</a>
                <a href="department.php">الأقسام</a>
                <a href="programesA.php">البرامج</a>
                <a href="News.php">الأخبار</a>
                <a href="contact_us.php">اتصل بنا</a>

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
        <h1> الأخبار</h1>
    </section>
    <?php
    $isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'مسؤول';
    include('contact.php');
    $sql = "select * from news order by id_News DESC";
    $sp = $con->prepare($sql);
    $sp->execute();
    $result = $sp->get_result();
    ?>

    <!-- ================== المستخدم العادي ================== -->
    <?php if (!$isAdmin): ?>
        <section class="news">
            <div class="container">
                <h2 class="section-title">الأخبار</h2>

                <div class="grid">
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <div class="news-card">
                            <?php if (!empty($row['image'])): ?>
                                <img src="uploads/<?= htmlspecialchars($row['image']); ?>" alt="خبر" style="width:100%; height:180px; object-fit:cover; border-radius:6px; margin-bottom:15px;">
                            <?php else: ?>
                                <img src="images/logo.png" alt="خبر" style="width:100%; height:180px; object-fit:contain; opacity:0.5; margin-bottom:15px;">
                            <?php endif; ?>
                            <h3 style="margin:15px 0;">
                                <?= htmlspecialchars($row['Name']); ?>
                            </h3>

                            <p>
                                <?= htmlspecialchars($row['details']); ?>
                            </p>

                            <small style="color:#666;">
                                <?= htmlspecialchars($row['date_pub']); ?>
                            </small>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <!-- ================== المسؤول ================== -->
    <?php if ($isAdmin): ?>
        <div class="container">
            <div class="admin-actions" style="margin-top: 20px;">
                <a href="insert_news.php" class="btn-add">إضافة خبر جديد +</a>
            </div>
            <?php
            // Reset result pointer to reuse for admin table
            $result->data_seek(0);
            $count = 1;
            ?>
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>الرقم</th>
                        <th>الصورة</th>
                        <th> عنوان الخبر</th>
                        <th> التفاصيل</th>
                        <th>تاريخ النشر</th>
                        <th>تحديث</th>
                        <th>حذف</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                    ?>
                        <tr>
                            <td><?php echo $count++; ?></td>
                            <td>
                                <?php if (!empty($row['image'])): ?>
                                    <img src="uploads/<?php echo htmlspecialchars($row['image']); ?>" alt="خبر" style="width:50px; height:50px; object-fit:cover; border-radius:4px;">
                                <?php else: ?>
                                    <img src="images/logo.png" alt="default" style="width:50px; height:50px; object-fit:contain; opacity:0.5;">
                                <?php endif; ?>
                            </td>
                            <td><?php echo $row["Name"]; ?></td>
                            <td class="details"><?php echo $row["details"]; ?></td>
                            <td class="date"><?php echo $row["date_pub"]; ?></td>
                            <td><a class="btn-edit" href="update_news1.php?id=<?php echo $row['id_News']  ?>&edit=update">تعديل</a></td>
                            <td><a class="btn-delete" href="delete_news.php?id=<?php echo $row['id_News']  ?>&del=delete" onClick="return confirm('هل أنت متأكد من حذف هذا الخبر؟')">X</a></td>
                        </tr>
                    <?php
                    } ?>
                </tbody>
            </table>
        <?php endif; ?>
        <footer class="footer">
            <p>© 2026 كلية الحاسبات وتكنولوجيا المعلومات</p>
        </footer>
</body>

</html>