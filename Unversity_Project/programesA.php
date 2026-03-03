<!DOCTYPE html>
<?php
require_once 'session_setup.php';
$isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'مسؤول';
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
                <a href="news.php">الأخبار</a>
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
        <h1>اقسام البرامج</h1>
    </section>

    <?php
    include('contact.php');


    $dept_sql = "SELECT * FROM academic ORDER BY id_Academic DESC";
    $dept_result = $con->query($dept_sql);
    $departments = [];
    while ($row = $dept_result->fetch_assoc()) {
        $departments[] = $row;
    }

    // Function to get programs for a department
    function getProgramsByDept($con, $dept_id)
    {
        $sql = "SELECT * FROM program WHERE department_id = ? ORDER BY id_program DESC";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $dept_id);
        $stmt->execute();
        return $stmt->get_result();
    }

    $no_dept_sql = "SELECT * FROM program WHERE department_id IS NULL OR department_id = 0 ORDER BY id_program DESC";
    $no_dept_result = $con->query($no_dept_sql);
    ?>

    <!-- ================== المستخدم العادي (عرض حسب الأقسام) ================== -->
    <?php if (!$isAdmin): ?>
        <section class="programs">
            <div class="container">
                <h2 class="section-title">البرامج الأكاديمية</h2>

                <?php foreach ($departments as $dept): ?>
                    <?php
                    $prog_result = getProgramsByDept($con, $dept['id_Academic']);
                    if ($prog_result->num_rows > 0):
                    ?>
                        <div class="department-section" style="margin-bottom: 50px;">
                            <h3 class="dept-title" style="text-align: center; font-size: 24px; color: #4b7f2f; margin-bottom: 30px; border-bottom: 2px solid #eef5ea; padding-bottom: 5px; display: inline-block; width: 100%;">
                                <?= (mb_strpos($dept['name'], 'قسم') === 0) ? '' : 'قسم '; ?><?= htmlspecialchars($dept['name']); ?>
                            </h3>

                            <div class="grid">
                                <?php while ($row = $prog_result->fetch_assoc()): ?>
                                    <div class="card program-card">
                                        <?php if (!empty($row['image'])): ?>
                                            <img src="uploads/<?= htmlspecialchars($row['image']); ?>"
                                                alt="برنامج"
                                                style="width:100%;height:180px;object-fit:cover;border-radius:6px;margin-bottom:15px;">
                                        <?php endif; ?>

                                        <h3><?= htmlspecialchars($row['name_program']); ?></h3>
                                        <p><strong>عن البرنامج:</strong> <?= htmlspecialchars($row['text_program']); ?></p>
                                        <p><strong>الرؤية:</strong> <?= htmlspecialchars($row['son']); ?></p>
                                        <p><strong>الهدف:</strong> <?= htmlspecialchars($row['goal']); ?></p>
                                        <p><strong>للتواصل:</strong> <?= htmlspecialchars($row['phone']); ?></p>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>

                <!-- عرض البرامج غير المرتبطة بقسم (إن وجدت) -->
                <?php if ($no_dept_result->num_rows > 0): ?>
                    <div class="department-section" style="margin-bottom: 50px;">
                        <h3 class="dept-title" style="text-align: center; font-size: 24px; color: #4b7f2f; margin-bottom: 30px; border-bottom: 2px solid #eef5ea; padding-bottom: 5px; display: inline-block; width: 100%;">
                            برامج عامة / أخرى
                        </h3>
                        <div class="grid">
                            <?php while ($row = $no_dept_result->fetch_assoc()): ?>
                                <div class="card program-card">
                                    <?php if (!empty($row['image'])): ?>
                                        <img src="uploads/<?= htmlspecialchars($row['image']); ?>"
                                            alt="برنامج"
                                            style="width:100%;height:180px;object-fit:cover;border-radius:6px;margin-bottom:15px;">
                                    <?php endif; ?>
                                    <h3><?= htmlspecialchars($row['name_program']); ?></h3>
                                    <p><strong>عن البرنامج:</strong> <?= htmlspecialchars($row['text_program']); ?></p>
                                    <p><strong>الرؤية:</strong> <?= htmlspecialchars($row['son']); ?></p>
                                    <p><strong>الهدف:</strong> <?= htmlspecialchars($row['goal']); ?></p>
                                    <p><strong>للتواصل:</strong> <?= htmlspecialchars($row['phone']); ?></p>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                <?php endif; ?>

            </div>
        </section>
    <?php endif; ?>

    <!-- ================== المسؤول (عرض حسب الأقسام) ================== -->
    <?php if ($isAdmin): ?>
        <div class="container" style="margin-top: 30px;">
            <div class="admin-actions">
                <a href="insert_program.php" class="btn-add">إضافة برنامج جديد +</a>
            </div>

            <?php
            $count = 1;
            foreach ($departments as $dept):
                $prog_result = getProgramsByDept($con, $dept['id_Academic']);
                if ($prog_result->num_rows > 0):
            ?>
                    <div class="department-table-section" style="margin-bottom: 40px;">
                        <h3 style="background:#f8f9fa; padding:10px; border-right: 5px solid #2980b9; margin-bottom:15px;">
                            <?= (mb_strpos($dept['name'], 'قسم') === 0) ? '' : 'قسم '; ?><?= htmlspecialchars($dept['name']); ?>
                        </h3>
                        <table class="styled-table">
                            <thead>
                                <tr>
                                    <th>الرقم</th>
                                    <th>اسم البرنامج</th>
                                    <th>الشعار</th>
                                    <th>تفاصيل</th>
                                    <th>الرؤية</th>
                                    <th>الهدف</th>
                                    <th>للتواصل</th>
                                    <th>تاريخ الاضافة</th>
                                    <th>تارخ التعديل</th>
                                    <th>التعديل</th>
                                    <th>حذف</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $prog_result->fetch_assoc()): ?>
                                    <tr>
                                        <td><?= $count++; ?></td>
                                        <td><?= htmlspecialchars($row["name_program"]); ?></td>
                                        <td><img src="uploads/<?php echo $row["image"]; ?>" width=50></td>
                                        <td><?= htmlspecialchars($row["text_program"]); ?></td>
                                        <td><?= htmlspecialchars($row["son"]); ?></td>
                                        <td><?= htmlspecialchars($row["goal"]); ?></td>
                                        <td><?= htmlspecialchars($row["phone"]); ?></td>
                                        <td class="date"><?= htmlspecialchars($row["date_add"]); ?></td>
                                        <td class="date"><?= htmlspecialchars($row["date_up"]); ?></td>
                                        <td><a class="btn-edit" href="updateprogrames.php?id=<?= $row['id_program'] ?>&edit=update">تعديل</a></td>
                                        <td><a class="btn-delete" href="deleteprograms.php?id=<?= $row['id_program'] ?>&del=delete" onclick="return confirm('هل أنت متأكد من حذف هذا البرنامج؟')">X</a></td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
            <?php
                endif;
            endforeach;
            ?>

            <!-- عرض البرامج غير المرتبطة بقسم للمسؤول -->
            <?php if ($no_dept_result->num_rows > 0): ?>
                <div class="department-table-section" style="margin-bottom: 40px;">
                    <h3 style="background:#f8f9fa; padding:10px; border-right: 5px solid #7f8c8d; margin-bottom:15px;">
                        برامج عامة / أخرى
                    </h3>
                    <table class="styled-table">
                        <thead>
                            <tr>
                                <th>الرقم</th>
                                <th>اسم البرنامج</th>
                                <th>الشعار</th>
                                <th>تفاصيل</th>
                                <th>الرؤية</th>
                                <th>الهدف</th>
                                <th>للتواصل</th>
                                <th>تاريخ الاضافة</th>
                                <th>تارخ التعديل</th>
                                <th>التعديل</th>
                                <th>حذف</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $no_dept_result->fetch_assoc()): ?>
                                <tr>
                                    <td><?= $count++; ?></td>
                                    <td><?= htmlspecialchars($row["name_program"]); ?></td>
                                    <td><img src="uploads/<?php echo $row["image"]; ?>" width=50></td>
                                    <td><?= htmlspecialchars($row["text_program"]); ?></td>
                                    <td><?= htmlspecialchars($row["son"]); ?></td>
                                    <td><?= htmlspecialchars($row["goal"]); ?></td>
                                    <td><?= htmlspecialchars($row["phone"]); ?></td>
                                    <td class="date"><?= htmlspecialchars($row["date_add"]); ?></td>
                                    <td class="date"><?= htmlspecialchars($row["date_up"]); ?></td>
                                    <td><a class="btn-edit" href="updateprogrames.php?id=<?= $row['id_program'] ?>&edit=update">تعديل</a></td>
                                    <td><a class="btn-delete" href="deleteprograms.php?id=<?= $row['id_program'] ?>&del=delete" onclick="return confirm('هل أنت متأكد من حذف هذا البرنامج؟')">X</a></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>

        </div>
    <?php endif; ?>
    <footer class="footer">
        <p>© 2026 كلية الحاسبات وتكنولوجيا المعلومات</p>
    </footer>
</body>

</html>
<?php





?>