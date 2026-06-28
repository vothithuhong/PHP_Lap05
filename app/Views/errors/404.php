<?php ob_start(); ?>

<div class="glass-card" style="text-align:center">
    <div style="font-size:50px;"></div>
    <h1>404 - Page Not Found</h1>
    <p style="color:#64748b; margin:10px 0 20px;">
        The page you are looking for does not exist or has been moved.
    </p>
    <a class="btn btn-primary" href="/">
        Back to Dashboard
    </a>
</div>
<?php
$content = ob_get_clean();
$title = '404 Not Found';
$current = '';
require __DIR__ . '/../layout.php';