<?php

$flash = flash_get();

if ($flash):
?>

<div class="alert <?= e($flash['type']) ?>">
    <?= e($flash['message']) ?>
</div>

<?php endif; ?>