<?php require_once 'session_setup.php';
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <style>
        .page-title {
            background: #eef5ea;
            padding: 40px 0;
            text-align: center;
            color: #4b7f2f;
        }

        .departments {
            padding: 60px 0;
        }

        .dept-card {
            background: #fff;
            text-align: center;
            padding: 25px;
            border-radius: 6px;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.05);
        }

        .dept-card img {
            width: 80px;
            margin-bottom: 15px;
        }

        .form-container {
            padding: 30px;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
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
            background-color: #f9f9f9;
        }

        .form-control:focus {
            outline: none;
            border-color: #3498db;
            background-color: white;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        }

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
            line-height: 1.5;
        }

        .submit-btn {
            background: linear-gradient(135deg, #27ae60, #2ecc71);
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
            margin-top: 20px;
            letter-spacing: 1px;
            text-decoration: none;
        }

        .submit-btn:hover {
            background: linear-gradient(135deg, #219653, #27ae60);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(39, 174, 96, 0.3);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .back-link {
            display: inline-block;
            margin-top: 0;
            color: #3498db;
            text-decoration: none;
            font-size: 16px;
            transition: all 0.3s;
            padding: 10px 20px;
            border: 1px solid #3498db;
            border-radius: 6px;
            background-color: white;
        }

        .back-link:hover {
            color: white;
            background-color: #3498db;
            text-decoration: none;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(52, 152, 219, 0.2);
        }

        .ll {
            text-align: center;
        }

        .yu {
            background-color: red;
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
            margin-top: 5px;
            letter-spacing: 1px;
            text-decoration: none;


        }

        .yu:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(39, 174, 96, 0.3);
        }
    </style>
    <meta charset="UTF-8">
    <title>الأقسام الأكاديمية</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>

<body>

    <header class="header">
        <div class="container">
            <div class="logo">
                <img src="images/images/logo.png">
                <span>كلية الحاسبات وتكنولوجيا المعلومات</span>
            </div>


            <nav class="nav">
                <a href="index.html">الرئيسية</a>
                <a href="">عن الكلية</a>
                <a href="department.php">الأقسام</a>
                <a href="programesA.php">البرامج</a>
                <a href="news.php">الأخبار</a>
                <a href="contact_us.php">اتصل بنا</a>
                <a href="login.php" class="login-link">تسجيل الدخول </a>
            </nav>

        </div>
    </header>
    <section class="page-title">
        <h1>الأقسام الأكاديمية</h1>
    </section>

    <body>
        <?php
        include('contact.php');

        if (isset($_GET['id']) && isset($_GET['del'])) {
            $id = mysqli_real_escape_string($con, $_GET['id']);
            $sql = "DELETE FROM academic WHERE id_Academic='$id'";
            $r = mysqli_query($con, $sql);
            if ($r) {
                echo "<script>alert('تم الحذف بنجاح'); window.location='department.php';</script>";
            } else {
                echo "<script>alert('فشل الحذف'); window.location='department.php';</script>";
            }
            exit;
        }
        ?>
        <div class="form-container">
            <form action="delete.php" method="post" autocomplete="off">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($id1); ?>">

                <div class="form-row">
                    <div class="form-group">
                        <label for="name" class="required">اسم القسم</label>
                        <input type="text" id="name" name="name" class="form-control"
                            value="<?php echo htmlspecialchars($name1); ?>" required readonly>
                    </div>

                    <div class="form-group">
                        <label for="address" class="required">العنوان</label>
                        <input type="text" id="address" name="address" class="form-control"
                            value="<?php echo htmlspecialchars($address1); ?>" required readonly>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="phone" class="required">رقم التواصل</label>
                        <input type="text" id="phone" name="phone" class="form-control"
                            value="<?php echo htmlspecialchars($phone1); ?>" required readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label for="mas" class="required">الوصف / التفاصيل</label>
                    <textarea id="mas" name="mas" rows="7" class="form-control" required readonly><?php echo htmlspecialchars($mas1); ?></textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="tim" class="required">تاريخ الإضافة</label>
                        <input type="date" id="tim" name="tim1" class="form-control" readonly
                            value="<?php echo htmlspecialchars($tim1); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="tim2">تاريخ التعديل</label>
                        <input type="date" id="tim2" name="tim2" class="form-control" readonly
                            value="<?php echo htmlspecialchars($tim2); ?>">
                    </div>
                </div>

                <input type="submit" name="del" class="submit-btn" value="حذف">
                </input>
                <div class="ll ">
                    <a href="department.php" class=" yu"> التراجع عن الحذف</a>
                </div>
            </form>
    </body>
    <footer class="footer">
        <p>© 2026 كلية الحاسبات وتكنولوجيا المعلومات</p>
    </footer>

</html>