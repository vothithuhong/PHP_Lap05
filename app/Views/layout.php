<!doctype html>
<html lang="vi">

<head>

<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>
<?= e($title ?? 'Student Enrollment System') ?>
</title>


<link rel="preconnect" href="https://fonts.googleapis.com">

<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>


<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">


<style>


*{margin:0;padding:0;box-sizing:border-box;}
body{font-family:'Inter',sans-serif;background:linear-gradient(135deg, #eef2ff, #f8fafc, #ecfeff);min-height:100vh;color:#1e293b;}
.navbar{
    background:white;
    box-shadow:
    0 4px 20px rgba(0,0,0,.08);
    position:sticky;

    top:0;

    z-index:100;

}



.nav-container{

    max-width:1400px;

    margin:auto;

    height:70px;

    padding:0 25px;

    display:flex;

    align-items:center;

    justify-content:space-between;

}



.nav-brand{


    font-size:24px;

    font-weight:700;

    color:#6366f1;

}



.nav-links{

    display:flex;

    align-items:center;

    gap:10px;

}



.nav-links a{


    text-decoration:none;

    color:#475569;

    padding:10px 15px;

    border-radius:10px;

    font-weight:500;

    transition:.2s;

}



.nav-links a:hover{

    background:#eef2ff;

    color:#6366f1;

}



.nav-links a.active{

    background:#6366f1;

    color:white;

}

/* BUTTON CREATE */
.create-btn{

    background:#10b981!important;

    color:white!important;

}



.create-btn:hover{

    background:#059669!important;

}




/* USER */


.user-box{

    display:flex;

    align-items:center;

    gap:12px;

    margin-left:15px;

    color:#475569;

    font-weight:600;

}



.logout-btn{


    border:none;

    background:#ef4444;

    color:white;

    padding:9px 15px;

    border-radius:10px;

    cursor:pointer;

    font-weight:600;

}



.logout-btn:hover{

    background:#dc2626;

}



/* MAIN */


.container{

    max-width:1400px;

    margin:auto;

    padding:35px 25px;

}



.content-wrapper{


    background:white;

    border-radius:20px;

    padding:30px;

    box-shadow:

    0 10px 30px rgba(0,0,0,.08);

}



/* ALERT */


.alert{

    padding:15px 20px;

    border-radius:12px;

    margin-bottom:20px;

}



.alert.success{

    background:#dcfce7;

    color:#166534;

}



.alert.error{

    background:#fee2e2;

    color:#991b1b;

}




@media(max-width:900px){


.nav-container{

    flex-direction:column;

    height:auto;

    padding:20px;

    gap:15px;

}



.nav-links{

    flex-wrap:wrap;

    justify-content:center;

}


}


</style>


<link rel="stylesheet" href="/assets/style.css">


</head>


<body>


<?php require __DIR__.'/partials/flash.php'; ?>



<nav class="navbar">


<div class="nav-container">



<div class="nav-brand">

📚 Student Enrollment

</div>



<div class="nav-links">


<a href="/"
class="<?= ($current ?? '') === 'dashboard' ? 'active':'' ?>">

🏠 Trang chủ

</a>



<a href="/students"
class="<?= ($current ?? '') === 'Students' ? 'active':'' ?>">

👥 Sinh viên

</a>



<a href="/enrollments"
class="<?= ($current ?? '') === 'Enrollments' ? 'active':'' ?>">

📝 Đăng ký khóa học

</a>



<a href="/health"
class="<?= ($current ?? '') === 'health' ? 'active':'' ?>">

💚 Hệ thống

</a>



<a href="/students/create"
class="create-btn">

➕ Thêm sinh viên

</a>





<?php if(isset($_SESSION['user'])): ?>


<div class="user-box">


<span>

👤 <?= e($_SESSION['user']['username']) ?>

</span>



<form method="post" action="/logout">


<button class="logout-btn">

🚪 Đăng xuất

</button>


</form>


</div>



<?php endif; ?>
</div>
</div>
</nav>
<main class="container">
<?php if($success = flash_get('success')): ?>
<div class="alert success">

✅ <?= e($success) ?>

</div>


<?php endif; ?>

<?php if($error = flash_get('error')): ?>


<div class="alert error">

❌ <?= e($error) ?>

</div>

<?php endif; ?>

<div class="content-wrapper">

<?= $content ?? '' ?>

</div>

</main>
</body>
</html>