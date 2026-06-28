<?php ob_start(); ?>
<h1>Create Student</h1>

<form method="post" action="/students/store" class="card form-card">

    <label>Full Name</label>
    <input type="text" name="full_name" value="<?= e($old['full_name'] ?? '') ?>">
    <?php if (!empty($errors['full_name'])): ?>
        <p class="error"><?= e($errors['full_name']) ?></p>
    <?php endif; ?>

    <label>Email</label>
    <input type="email" name="email" value="<?= e($old['email'] ?? '') ?>">
    <?php if (!empty($errors['email'])): ?>
        <p class="error"><?= e($errors['email']) ?></p>
    <?php endif; ?>

    <label>Phone</label>
    <input type="text" name="phone" value="<?= e($old['phone'] ?? '') ?>">

    <button class="btn primary" type="submit">Save Student</button>
    <a class="btn" href="/students">Back</a>

</form>

<?php
$content = ob_get_clean();
$title = 'Create Student';
require __DIR__ . '/../layout.php';