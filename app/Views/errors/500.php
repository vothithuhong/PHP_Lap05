<?php ob_start(); ?>
<div class="glass-card" style="text-align:center">
    <div style="font-size:50px;"></div>
    <h1>500 - Server Error</h1>
    <p style="color:#64748b; margin:10px 0 20px;">
        Something went wrong on our side. Please try again later.
    </p>
    <a class="btn btn-primary" href="/">
        Back to Dashboard
    </a>
</div>
<?php
$content = ob_get_clean();
$title = 'Server Error';
$current = '';
require __DIR__ . '/../layout.php';