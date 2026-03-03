<!DOCTYPE html>
<?php
/* ================== الجلسة والصلاحيات ================== */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'مسؤول';

include('contact.php');
?>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>الأقسام الأكاديمية</title>

    <!-- ملف التصميم الموحد -->
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <!-- ================== Header ================== -->
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
                <a href="contact.php">اتصل بنا</a>

                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="profile.php" class="login-link">👤 الملف الشخصي</a>
                    <a href="logout.php" class="login-link">تسجيل الخروج</a>
                <?php else: ?>
                    <a href="login.php" class="login-link">تسجيل الدخول</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>

    <!-- ================== Title ================== -->
    <section class="page-title">
        <h1>الأقسام الأكاديمية</h1>
    </section>

    <?php
    $sql = "SELECT * FROM academic ORDER BY id_Academic DESC";
    $result = $con->query($sql);
    ?>

    <!-- ================== المستخدم العادي ================== -->
    <?php if (!$isAdmin): ?>
        <section class="departments">
            <div class="container">
                <div class="grid">
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <div class="card">
                            <?php if (!empty($row['image'])): ?>
                                <img src="uploads/<?= htmlspecialchars($row['image']); ?>" alt="قسم" style="width:100%; height:180px; object-fit:cover; border-radius:6px; margin-bottom:15px;">
                            <?php endif; ?>
                            <h3><?= htmlspecialchars($row['name']); ?></h3>
                            <p><strong>العنوان:</strong> <?= htmlspecialchars($row['Address']); ?></p>
                            <p style="margin:15px 0; line-height:1.7;">
                                <strong>عن القسم:</strong> <?= htmlspecialchars($row['descr']); ?>
                            </p>
                            <p><strong>للتواصل:</strong> <?= htmlspecialchars($row['phone']); ?></p>

                            <small style="color:#666;">
                                تاريخ الإنشاء:
                                <?= htmlspecialchars($row['data_start']); ?>
                            </small>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <!-- ================== المسؤول ================== -->
    <?php if ($isAdmin): ?>
        <?php
        $result->data_seek(0);
        $count = 1;
        ?>

        <section class="departments">
            <div class="container">
                <div class="admin-actions">
                    <a href="insert.php" class="btn-add">إضافة قسم جديد +</a>
                </div>
                <table class="styled-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>الصورة</th>
                            <th>اسم القسم</th>
                            <th>العنوان</th>
                            <th>التفاصيل</th>
                            <th>للتواصل</th>
                            <th>تاريخ الإنشاء</th>
                            <th>تعديل</th>
                            <th>حذف</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?= $count++; ?></td>
                                <td>
                                    <?php if (!empty($row['image'])): ?>
                                        <img src="uploads/<?= htmlspecialchars($row['image']); ?>" alt="قسم" style="width:50px; height:50px; object-fit:cover; border-radius:4px;">
                                    <?php else: ?>
                                        <img src="images/logo.png" alt="default" style="width:50px; height:50px; object-fit:contain; opacity:0.5;">
                                    <?php endif; ?>
                                </td>
                                <td><?= htmlspecialchars($row['name']); ?></td>
                                <td><?= htmlspecialchars($row['Address']); ?></td>
                                <td class="details"><?= htmlspecialchars($row['descr']); ?></td>
                                <td><?= htmlspecialchars($row['phone']); ?></td>
                                <td class="date"><?= htmlspecialchars($row['data_start']); ?></td>
                                <td>
                                    <a class="btn-edit"
                                        href="update.php?id=<?= $row['id_Academic']; ?>&edit=1">
                                        تعديل
                                    </a>
                                </td>
                                <td>
                                    <a class="btn-delete"
                                        href="delete.php?id=<?= $row['id_Academic']; ?>&del=delete"
                                        onclick="return confirm('هل أنت متأكد من حذف هذا القسم؟ لا يمكن التراجع عن هذا الإجراء.')">
                                        X
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </section>
    <?php endif; ?>

    <!-- ================== Footer ================== -->
    <footer class="footer">
        <p>© 2026 كلية الحاسبات وتكنولوجيا المعلومات</p>
    </footer>

</body>

</html>