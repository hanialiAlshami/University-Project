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

        /* Rest of CSS same as update.php or standardized */
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
    <title>تعديل برنامج</title>
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

    <body>
        <section class="page-title">
            <h1>تعديل البرنامج</h1>
        </section>
        <?php
        include('contact.php');

        $name1 = $details1 = $date1 = $date_up1 = "";
        $id1 = 0;

        if (isset($_GET['edit'])) {

            $id = (int)$_GET['id'];

            $sql = "select * from program where id_program=" . $id;
            $r = mysqli_query($con, $sql);

            if (!$r) {
                die("Error");
            }

            if ($row = mysqli_fetch_assoc($r)) {
                $id1      = $row['id_program'];
                $name1    = $row["name_program"];
                $details1_val = $row["text_program"];
                $vision1  = $row["son"];
                $goal1    = $row["goal"];
                $phone1   = $row["phone"];
                $date1    = $row["date_add"];
                $date_up1 = $row["date_up"];
                $dept_id1 = $row["department_id"];
                $image1   = $row["image"];
            }
        }

        if (isset($_POST['update'])) {

            $name    = $_POST["name"];
            $details = $_POST["details"];
            $vision  = $_POST["son"];
            $goal    = $_POST["goal"];
            $phone   = $_POST["phone"];
            $date    = $_POST["date_add"];
            $date_up = $_POST["date_up"];
            $dept_id = $_POST["department_id"];
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

            // Update Query
            $sql = "update program set 
               name_program='$name',
               text_program='$details',
               son='$vision',
               goal='$goal',
               phone='$phone',
               date_add='$date',
               date_up='$date_up',
               department_id='$dept_id'
               $image_sql
               where id_program='$number'";

            $r = mysqli_query($con, $sql);

            if ($r) {
                echo "<script>alert('تم التعديل بنجاح'); window.location='programesA.php';</script>";
            } else {
                echo "<script>alert('فشل التعديل: " . mysqli_error($con) . "');</script>";
            }
        }
        ?>
        <div class="form-container">
            <form action="updateprogrames.php" method="post" enctype="multipart/form-data" autocomplete="off">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($id1); ?>">

                <div class="form-group">
                    <label for="department_id" class="required">القسم الأكاديمي</label>
                    <select id="department_id" name="department_id" class="form-control" required>
                        <option value="">اختر القسم...</option>
                        <?php
                        // Fetch all departments
                        $dept_sql = "SELECT id_Academic, name FROM academic ORDER BY name ASC";
                        $dept_result = mysqli_query($con, $dept_sql);
                        while ($dept = mysqli_fetch_assoc($dept_result)) {
                            $selected = ($dept['id_Academic'] == $dept_id1) ? 'selected' : '';
                            echo "<option value='" . $dept['id_Academic'] . "' $selected>" . htmlspecialchars($dept['name']) . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="name" class="required">اسم البرنامج</label>
                        <input type="text" id="name" name="name" class="form-control"
                            value="<?php echo htmlspecialchars($name1); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="image">تحديث الشعار</label>
                        <input type="file" id="image" name="image" class="form-control" accept="image/*">
                        <?php if (!empty($image1)): ?>
                            <small>الشعار الحالي: <a href="uploads/<?php echo $image1; ?>" target="_blank"><?php echo $image1; ?></a></small>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="son" class="required">الرؤية</label>
                        <input type="text" id="son" name="son" class="form-control"
                            value="<?php echo htmlspecialchars($vision1); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="goal" class="required">الهدف</label>
                        <input type="text" id="goal" name="goal" class="form-control"
                            value="<?php echo htmlspecialchars($goal1); ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="phone" class="required">رقم التواصل</label>
                    <input type="text" id="phone" name="phone" class="form-control"
                        value="<?php echo htmlspecialchars($phone1); ?>" required>
                </div>

                <div class="form-group">
                    <label for="details" class="required">تفاصيل البرنامج</label>
                    <textarea id="details" name="details" rows="7" class="form-control" required><?php echo htmlspecialchars($details1_val ?? ''); ?></textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="date_add" class="required">تاريخ الإضافة</label>
                        <input type="date" id="date_add" name="date_add" class="form-control"
                            value="<?php echo htmlspecialchars($date1); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="date_up">تاريخ التعديل</label>
                        <input type="date" id="date_up" name="date_up" class="form-control"
                            value="<?php echo htmlspecialchars($date_up1); ?>">
                    </div>
                </div>

                <input type="submit" name="update" class="submit-btn" value="تعديل">
                </input>
                <div class="ll ">
                    <a href="programesA.php" class=" yu"> إلغاء </a>
                </div>
            </form>
    </body>
    <footer class="footer">
        <p>© 2026 كلية الحاسبات وتكنولوجيا المعلومات</p>
    </footer>

</html>