<?php ob_start(); ?>

<h1>Edit Lead</h1>

<form method="post" action="/students/update" class="card form-card">
    <input type="hidden" name="id" value="<?= e($old['id'] ?? '') ?>">

    <label>Name</label>
    <input type="text" name="name" value="<?= e($old['name'] ?? '') ?>">
    <?php if (!empty($errors['name'])): ?><p class="error"><?= e($errors['name']) ?></p><?php endif; ?>

    <label>Email</label>
    <input type="email" name="email" value="<?= e($old['email'] ?? '') ?>">
    <?php if (!empty($errors['email'])): ?><p class="error"><?= e($errors['email']) ?></p><?php endif; ?>

    <label>Phone</label>
    <input type="text" name="phone" value="<?= e($old['phone'] ?? '') ?>">

    <label>Status</label>
    <select name="status">
        <?php foreach (['new','contacted','qualified','lost'] as $status): ?>
            <option value="<?= e($status) ?>" <?= ($old['status'] ?? 'new') === $status ? 'selected' : '' ?>>
                <?= e($status) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label>Note</label>
    <textarea name="note"><?= e($old['note'] ?? '') ?></textarea>

    <button class="btn primary" type="submit">Update Lead</button>
    <a class="btn" href="/students">Back</a>
</form>

<?php
$content = ob_get_clean();
$title = 'Edit Lead';
require __DIR__ . '/../layout.php';