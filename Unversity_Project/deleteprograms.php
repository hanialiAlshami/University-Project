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
     <title>حذف برنامج</title>
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
     <section class="page-title">
         <h1> حذف برنامج</h1>
     </section>

     <body>
         <?php
            include('contact.php');

            if (isset($_GET['id']) && isset($_GET['del'])) {
                $id = (int)$_GET['id'];
                $sql = "DELETE FROM program WHERE id_program = $id LIMIT 1";
                $r = mysqli_query($con, $sql);
                if ($r) {
                    echo "<script>alert('تم الحذف بنجاح'); window.location='programesA.php';</script>";
                } else {
                    echo "<script>alert('فشل الحذف'); window.location='programesA.php';</script>";
                }
                exit;
            }

            $name1 = $details1 = $date1 = "";
            $id1 = 0;

            if (isset($_GET['id'])) {
                $id = (int)$_GET['id'];
                $sql = "select * from program where id_program=" . $id;
                $r = mysqli_query($con, $sql);

                if (!$r) {
                    die("Error");
                }

                if ($row = mysqli_fetch_assoc($r)) {
                    $id1      = $row['id_program'];
                    $name1    = $row["name_program"];
                    $details1 = $row["text_program"];
                    $vision1  = $row["son"];
                    $goal1    = $row["goal"];
                    $phone1   = $row["phone"];
                    $date1    = $row["date_add"];
                }
            }

            if (isset($_POST['del'])) {
                $number  = (int)$_POST["id"];

                $sql = "delete from program where id_program=" . $number . " LIMIT 1";

                $r = mysqli_query($con, $sql);

                if ($r) {
                    echo "<script>alert('تم الحذف بنجاح'); window.location='programesA.php';</script>";
                } else {
                    echo "<script>alert('فشل الحذف ');</script>";
                }
            }
            ?>
         <div class="form-container">
             <form action="deleteprograms.php" method="post" autocomplete="off">
                 <input type="hidden" name="id" value="<?php echo htmlspecialchars($id1); ?>">

                 <div class="form-row">
                     <div class="form-group">
                         <label for="name" class="required">اسم البرنامج</label>
                         <input type="text" id="name" name="name" class="form-control"
                             value="<?php echo htmlspecialchars($name1); ?>" required readonly>
                     </div>
                 </div>

                 <div class="form-row">
                     <div class="form-group">
                         <label for="son" class="required">الرؤية</label>
                         <input type="text" id="son" name="son" class="form-control"
                             value="<?php echo htmlspecialchars($vision1); ?>" required readonly>
                     </div>

                     <div class="form-group">
                         <label for="goal" class="required">الهدف</label>
                         <input type="text" id="goal" name="goal" class="form-control"
                             value="<?php echo htmlspecialchars($goal1); ?>" required readonly>
                     </div>
                 </div>

                 <div class="form-group">
                     <label for="phone" class="required">رقم التواصل</label>
                     <input type="text" id="phone" name="phone" class="form-control"
                         value="<?php echo htmlspecialchars($phone1); ?>" required readonly>
                 </div>

                 <div class="form-group">
                     <label for="details" class="required">تفاصيل البرنامج</label>
                     <textarea id="details" name="details" rows="7" class="form-control" required readonly><?php echo htmlspecialchars($details1); ?></textarea>
                 </div>

                 <div class="form-row">
                     <div class="form-group">
                         <label for="date_add" class="required">تاريخ الإضافة</label>
                         <input type="date" id="date_add" name="date_add" class="form-control" readonly
                             value="<?php echo htmlspecialchars($date1); ?>" required>
                     </div>
                 </div>

                 <input type="submit" name="del" class="submit-btn" value="حذف">
                 </input>
                 <div class="ll ">
                     <a href="programesA.php" class=" yu"> التراجع عن الحذف</a>
                 </div>
             </form>
     </body>
     <footer class="footer">
         <p>© 2026 كلية الحاسبات وتكنولوجيا المعلومات</p>
     </footer>

 </html>