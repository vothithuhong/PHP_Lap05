<?php
$title = $title ?? 'Create Product';
$error = $error ?? null;
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
        <h1>Create Product</h1>
        <p>This form submits to <code>POST /products</code>.</p>

        <?php if ($error): ?>
            <div class="alert danger">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form class="form-card" method="POST" action="/products">
            <div class="form-group">
                <label>Product name</label>
                <input type="text" name="name" placeholder="Wireless Mouse">
            </div>

            <div class="form-group">
                <label>Category</label>
                <input type="text" name="category" placeholder="Accessories">
            </div>

            <div class="form-group">
                <label>Price</label>
                <input type="number" name="price" placeholder="250000">
            </div>

            <div class="form-group">
                <label>Quantity</label>
                <input type="number" name="quantity" placeholder="10">
            </div>

            <button class="button" type="submit">Save Product</button>
            <a class="button secondary" href="/products">Back to Products</a>
        </form>
    </main>
</body>
</html>
