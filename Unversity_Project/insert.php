<!DOCTYPE html>
<?php
require_once 'session_setup.php';
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'مسؤول') {
    header("Location: index.php");
    exit;
}
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
    <title>إضافة قسم جديد</title>
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


            <!-- <nav class="nav">
                <a href="index.php">الرئيسية</a>
                <a href="">عن الكلية</a>
                <a href="department.php">الأقسام</a>
                <a href="programesA.php">البرامج</a>
                <a href="news.php">الأخبار</a>
                <a href="contact_us.php">اتصل بنا</a>
                <a href="login.php" class="login-link">تسجيل الدخول </a>
            </nav>

        </div> -->
    </header>
    <section class="page-title">
        <h1>إضافة قسم جديد</h1>
    </section>

    <body>
        <?php
        include('contact.php');

        if (isset($_POST['add'])) {

            $name    = $_POST["name"];
            $address = $_POST["address"];
            $phone   = $_POST["phone"];
            $mas     = $_POST["mas"];
            $tim11   = $_POST["tim1"];
            $tim22   = $_POST["tim2"];

            // Image Upload Logic
            $image_name = "";
            if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
                $target_dir = "uploads/";
                if (!is_dir($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }
                $image_name = time() . "_" . basename($_FILES["image"]["name"]);
                $target_file = $target_dir . $image_name;
                move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
            }

            $sql = "INSERT INTO academic (name, Address, phone, descr, data_start, data_update, image) VALUES ('$name', '$address', '$phone', '$mas', '$tim11', '$tim22', '$image_name')";

            $r = mysqli_query($con, $sql);

            if ($r) {
                echo "<script>alert('تمت الإضافة بنجاح');</script>";
            } else {
                echo "<script>alert('فشل الإضافة: " . mysqli_error($con) . "');</script>";
            }
        }
        ?>
        <div class="form-container">
            <form action="insert.php" method="post" enctype="multipart/form-data" autocomplete="off">

                <div class="form-row">
                    <div class="form-group">
                        <label for="name" class="required">اسم القسم</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="أدخل اسم القسم" required>
                    </div>

                    <div class="form-group">
                        <label for="image">صورة القسم</label>
                        <input type="file" id="image" name="image" class="form-control" accept="image/*">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="address" class="required">العنوان</label>
                        <input type="text" id="address" name="address" class="form-control" placeholder="أدخل العنوان" required>
                    </div>

                    <div class="form-group">
                        <label for="phone" class="required">رقم التواصل</label>
                        <input type="text" id="phone" name="phone" class="form-control" placeholder="أدخل رقم الهاتف" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="mas" class="required">الوصف / التفاصيل</label>
                    <textarea id="mas" name="mas" rows="7" class="form-control" placeholder="أدخل التفاصيل" required></textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="tim" class="required">تاريخ الإضافة</label>
                        <input type="date" id="tim" name="tim1" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="tim2">تاريخ التعديل</label>
                        <input type="date" id="tim2" name="tim2" class="form-control">
                    </div>
                </div>

                <input type="submit" name="add" class="submit-btn" value="إضافة">
                </input>
                <div class="ll ">
                    <a href="department.php" class=" yu"> إلغاء </a>
                </div>
            </form>
    </body>
    <footer class="footer">
        <p>© 2026 كلية الحاسبات وتكنولوجيا المعلومات</p>
    </footer>

</html>