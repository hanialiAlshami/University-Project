<!DOCTYPE html>
<?php require_once 'session_setup.php';
?>
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

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f5f5;
            color: #333;
            line-height: 1.6;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 30px auto;
            background: white;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, #2c3e50, #3498db);
            color: white;
            padding: 25px;
            text-align: center;
            border-bottom: 5px solid #2980b9;
        }

        .header h1 {
            font-size: 28px;
            margin-bottom: 5px;
            font-weight: 600;
        }

        .header p {
            opacity: 0.9;
            font-size: 16px;
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
                <img src="images/logo.png">
                <span>كلية الحاسبات وتكنولوجيا المعلومات</span>
            </div>


            <nav class="nav">
                <a href="index.php ">الرئيسية</a>
                <a href="">عن الكلية</a>
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

    <body>
        <section class="page-title">
            <h1>الأخبار</h1>
        </section>
        <?php
        include('contact.php');

        $name1 = $mas1 = $tim1  = "";
        $id1 = 0;

        if (isset($_GET['edit'])) {

            $id = $_GET['id'];

            $sql = "select * from news where id_News=" . $id;
            $r = mysqli_query($con, $sql);

            if (!$r) {
                die("Error");
            }

            if ($row = mysqli_fetch_assoc($r)) {
                $id1      = $row['id_News'];
                $name1    = $row["Name"];
                $mas1     = $row["details"];
                $tim1     = $row["date_pub"];
                $image1   = $row["image"];
            }
        }

        if (isset($_POST['update'])) {

            $name    = $_POST["name"];

            $mas     = $_POST["mas"];
            $tim11   = $_POST["tim1"];
            $number  = (int)$_POST["id"];

            // Image Upload/Update Logic
            $image_sql = "";
            if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
                $target_dir = "uploads/";
                if (!is_dir($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }
                $image_name = time() . "_" . basename($_FILES["image"]["name"]);
                $target_file = $target_dir . $image_name;
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $image_sql = ", image='$image_name'";
                }
            }

            $sql = "update news set 
               Name='$name',
            details='$mas',
           date_pub='$tim11'
           $image_sql
            where id_News='$number' LIMIT 1";

            $r = mysqli_query($con, $sql);

            if ($r) {
                echo "<script>alert('تم التعديل بنجاح'); window.location='News.php';</script>";
            } else {
                echo "<script>alert('فشل التعديل: " . mysqli_error($con) . "');</script>";
            }
        }
        ?>
        <div class="form-container">
            <form action="update_news1.php" method="post" enctype="multipart/form-data" autocomplete="off">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($id1); ?>">

                <div class="form-row">
                    <div class="form-group">
                        <label for="name" class="required">عنوان الخبر</label>
                        <input type="text" id="name" name="name" class="form-control"
                            value="<?php echo htmlspecialchars($name1); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="image">تحديث الصورة</label>
                        <input type="file" id="image" name="image" class="form-control" accept="image/*">
                        <?php if (!empty($image1)): ?>
                            <small>الصورة الحالية: <a href="uploads/<?php echo $image1; ?>" target="_blank"><?php echo $image1; ?></a></small>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="mas" class="required">الوصف / التفاصيل</label>
                    <textarea id="mas" name="mas" rows="7" class="form-control" required><?php echo htmlspecialchars($mas1); ?></textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="tim" class="required">تاريخ الإضافة</label>
                        <input type="date" id="tim" name="tim1" class="form-control"
                            value="<?php echo htmlspecialchars($tim1); ?>" required>
                    </div>


                </div>

                <input type="submit" name="update" class="submit-btn" value="تعديل">
                </input>
                <div class="ll ">
                    <a href="News.php" class=" yu"> إلغاء </a>
                </div>
            </form>
    </body>
    <footer class="footer">
        <p>© 2026 كلية الحاسبات وتكنولوجيا المعلومات</p>
    </footer>

</html>