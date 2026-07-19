<?php ob_start(); ?>

<h1>📚 Student Enrollment Management System</h1>

<p class="subtitle">
    Hệ thống quản lý sinh viên và đăng ký khóa học
    - Demo MVC + PDO + Repository Pattern
</p>


<div class="grid">


    <a href="/health" class="card">

        <h2>💚 System Health</h2>

        <p>
            Kiểm tra kết nối database,
            trạng thái hệ thống và cấu hình ứng dụng.
        </p>

    </a>



    <a href="/students" class="card">

        <h2>👥 Student Management</h2>

        <p>
            Quản lý thông tin sinh viên:
            thêm, xem, cập nhật và xóa dữ liệu.
        </p>

    </a>



    <a href="/enrollments" class="card">

        <h2>📝 Enrollment Management</h2>

        <p>
            Quản lý đăng ký khóa học,
            trạng thái và lịch sử đăng ký.
        </p>

    </a>



    <a href="/students?debug=performance" class="card">

        <h2>⚡ Database Performance</h2>

        <p>
            Kiểm tra truy vấn SQL,
            phân trang và tối ưu hiệu suất.
        </p>

    </a>


</div>



<style>

.subtitle{

    margin:10px 0 30px;

    color:#64748b;

}


.grid{

    display:grid;

    grid-template-columns:
    repeat(auto-fit,minmax(250px,1fr));

    gap:20px;

}



.card{

    display:block;

    padding:25px;

    border-radius:16px;

    background:white;

    text-decoration:none;

    color:#0f172a;

    box-shadow:
    0 6px 20px rgba(0,0,0,.08);

    border:1px solid #e2e8f0;

    transition:.2s;

}



.card:hover{

    transform:translateY(-5px);

    border-color:#6366f1;

}



.card h2{

    margin-bottom:10px;

    font-size:20px;

}



.card p{

    color:#475569;

    font-size:14px;

}


</style>


<?php

$content = ob_get_clean();

$title = "Dashboard";

$current = "dashboard";

require __DIR__ . '/../layout.php';