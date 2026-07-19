<?php ob_start(); ?>

<div class="dashboard-header">

    <h1>
        📚 Student Enrollment Management System
    </h1>

    <p class="subtitle">
        Xin chào 
        <b><?= e($_SESSION['user']['username'] ?? 'User') ?></b>
        👋
    </p>

    <p class="description">
        Hệ thống quản lý sinh viên và đăng ký khóa học.
        Được xây dựng theo mô hình MVC, PDO và Repository Pattern.
    </p>

</div>


<div class="grid">


    <a href="/students" class="card">

        <div class="icon">
            👥
        </div>

        <h2>
            Quản lý sinh viên
        </h2>

        <p>
            Thêm, xem, chỉnh sửa và xóa thông tin sinh viên.
        </p>

    </a>



    <a href="/enrollments" class="card">

        <div class="icon">
            📝
        </div>

        <h2>
            Đăng ký khóa học
        </h2>

        <p>
            Quản lý danh sách đăng ký,
            trạng thái và ngày đăng ký.
        </p>

    </a>




    <a href="/health" class="card">

        <div class="icon">
            💚
        </div>

        <h2>
            Kiểm tra hệ thống
        </h2>

        <p>
            Kiểm tra database,
            kết nối và trạng thái ứng dụng.
        </p>

    </a>




    <a href="/students/create" class="card">

        <div class="icon">
            ➕
        </div>

        <h2>
            Tạo mới
        </h2>

        <p>
            Thêm sinh viên mới vào hệ thống.
        </p>

    </a>


</div>



<style>


.dashboard-header{
    margin-bottom:30px;
}


.dashboard-header h1{

    font-size:32px;
    color:#1e293b;

}



.subtitle{

    margin-top:10px;
    font-size:18px;
    color:#475569;

}



.description{

    margin-top:10px;
    color:#64748b;

}



.grid{

    display:grid;
    grid-template-columns:
    repeat(auto-fit,minmax(250px,1fr));

    gap:25px;

}



.card{

    background:white;

    padding:25px;

    border-radius:18px;

    text-decoration:none;

    color:#0f172a;

    border:1px solid #e2e8f0;

    box-shadow:
    0 8px 20px rgba(0,0,0,.08);

    transition:.25s;

}



.card:hover{

    transform:translateY(-5px);

    border-color:#6366f1;

}



.icon{

    font-size:40px;

    margin-bottom:15px;

}



.card h2{

    margin-bottom:10px;

}



.card p{

    color:#64748b;

    font-size:14px;

}


</style>


<?php

$content = ob_get_clean();

$title = "Dashboard";

$current = "dashboard";

require __DIR__ . '/../layout.php';

?>