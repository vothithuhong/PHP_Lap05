<?php ob_start(); ?>

<h1>📊 Lab05 Dashboard</h1>

<p class="subtitle">
    Hệ thống quản lý Lead & Order - Demo MVC + PDO + Repository Pattern
</p>

<div class="grid">

    <a href="/health" class="card">
        <h2>🗄️ Database</h2>
        <p>Kiểm tra kết nối database, migration và trạng thái hệ thống</p>
    </a>

    <a href="/students" class="card">
        <h2>👥 Lead CRUD</h2>
        <p>Quản lý khách hàng tiềm năng: Create, Read, Update, Delete</p>
    </a>

    <a href="/enrollments" class="card">
        <h2>📦 Order CRUD</h2>
        <p>Quản lý đơn hàng với search, pagination và validation</p>
    </a>

    <a href="/students?debug=performance" class="card">
        <h2>⚡ Performance</h2>
        <p>Test query, tốc độ load và tối ưu truy vấn SQL</p>
    </a>

</div>

<style>
.subtitle {
    margin: 10px 0 30px;
    color: #64748b;
}

.grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 20px;
}

.card {
    display: block;
    padding: 20px;
    border-radius: 16px;
    background: white;
    text-decoration: none;
    color: #0f172a;
    box-shadow: 0 6px 20px rgba(0,0,0,0.08);
    transition: 0.2s ease;
    border: 1px solid #e2e8f0;
}

.card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.12);
    border-color: #6366f1;
}

.card h2 {
    margin-bottom: 8px;
    font-size: 18px;
}

.card p {
    font-size: 14px;
    color: #475569;
}
</style>

<?php
$content = ob_get_clean();
$title = 'Dashboard';
$current = 'dashboard';
require __DIR__ . '/../layout.php';