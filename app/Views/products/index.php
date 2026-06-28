<?php
$title = $title ?? 'Products';
$products = $products ?? [];
$created = $created ?? false;

function stockStatus(int $quantity): string
{
    if ($quantity <= 0) {
        return 'Out of stock';
    }

    if ($quantity <= 5) {
        return 'Low stock';
    }

    return 'Available';
}

function stockClass(int $quantity): string
{
    if ($quantity <= 0) {
        return 'danger';
    }

    if ($quantity <= 5) {
        return 'warning';
    }

    return 'success';
}
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
        <?php if ($created): ?>
            <div class="alert success">
                Product form submitted successfully. Redirect response worked.
            </div>
        <?php endif; ?>

        <div class="page-header">
            <div>
                <h1>Product List</h1>
                <p>This page is handled by ProductController@index.</p>
            </div>

            <a class="button" href="/products/create">Create Product</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>SKU</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?= htmlspecialchars($product['sku']) ?></td>
                        <td><?= htmlspecialchars($product['name']) ?></td>
                        <td><?= htmlspecialchars($product['category']) ?></td>
                        <td><?= number_format($product['price']) ?> VND</td>
                        <td><?= htmlspecialchars((string) $product['quantity']) ?></td>
                        <td>
                            <span class="badge <?= stockClass((int) $product['quantity']) ?>">
                                <?= stockStatus((int) $product['quantity']) ?>
                            </span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</body>
</html>
