<?php ob_start(); ?>

<h1>Create Enrollment</h1>

<form method="post" action="/enrollments/store" class="form-card">

    <div class="form-group">
        <label>Student ID</label>
        <input
            type="number"
            name="student_id"
            value="<?= e($old['student_id'] ?? '') ?>"
        >

        <?php if (!empty($errors['student_id'])): ?>
            <small class="error"><?= e($errors['student_id']) ?></small>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label>Course ID</label>
        <input
            type="number"
            name="course_id"
            value="<?= e($old['course_id'] ?? '') ?>"
        >

        <?php if (!empty($errors['course_id'])): ?>
            <small class="error"><?= e($errors['course_id']) ?></small>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label>Enroll Date</label>
        <input
            type="date"
            name="enroll_date"
            value="<?= e($old['enroll_date'] ?? date('Y-m-d')) ?>"
        >

        <?php if (!empty($errors['enroll_date'])): ?>
            <small class="error"><?= e($errors['enroll_date']) ?></small>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label>Status</label>
        <select name="status">
            <?php
            $statuses = ['pending', 'approved', 'cancelled'];
            $current = $old['status'] ?? 'pending';
            foreach ($statuses as $s):
            ?>
                <option value="<?= e($s) ?>" <?= $current === $s ? 'selected' : '' ?>>
                    <?= e(ucfirst($s)) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="actions">
        <button class="btn btn-primary" type="submit">Save</button>
        <a class="btn btn-secondary" href="/enrollments">Back</a>
    </div>

</form>

<?php
$content = ob_get_clean();
$title = 'Create Enrollment';
require __DIR__ . '/../layout.php';