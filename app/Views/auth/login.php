<?php
$title = $title ?? 'Login';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($title) ?></title>
    <link rel="stylesheet" href="/assets/style.css">
</head>
<body>
    <header class="topbar">
        <strong>PHP Mini Product Router</strong>
        <nav>
            <a href="/">Home</a>
            <a href="/products">Products</a>
            <a href="/products/create">Create Product</a>
            <a href="/health">Health</a>
            <a href="/login">Login</a>
        </nav>
    </header>

    <main class="container">
        <h1>Login Demo</h1>
        <p>This page demonstrates controller organization and redirect response.</p>

        <form class="form-card" method="POST" action="/login">
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="student@example.com">
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="123456">
            </div>

            <button class="button" type="submit">Login</button>
        </form>
    </main>
</body>
</html>
