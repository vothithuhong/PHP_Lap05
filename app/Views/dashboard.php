<h2>Dashboard</h2>

<p>
Xin chào

<strong>

<?= htmlspecialchars($_SESSION['user']['username']) ?>

</strong>

</p>

<form action="/logout" method="post">

<button>

Đăng xuất

</button>

</form>