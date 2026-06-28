<?php ob_start(); ?>

<h1>Enrollment Management</h1>

<a class="btn primary" href="/enrollments/create">+ Create enrollment</a>

<form method="get" action="/enrollments" class="toolbar">
    <input type="hidden" name="page" value="1">

    <input 
        type="text" 
        name="q" 
        value="<?= e($q ?? '') ?>" 
        placeholder="Search enrollment code / customer name / email"
    >

    <button type="submit">Search</button>
</form>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Student ID</th>
            <th>Course ID</th>
            <th>Enroll Date</th>
            <th>Status</th>
            <th>Actions</th>
    </thead>

    <tbody>
        <?php foreach ($enrollments as $enrollment): ?>
        <tr>
            <td><?= e($enrollment['id']) ?></td>
            <td><?= e($enrollment['student_id']) ?></td>
            <td><?= e($enrollment['course_id']) ?></td>
            <td><?= e($enrollment['enroll_date']) ?></td>
            <td><?= e($enrollment['status']) ?></td>

            <td>
                <a href="/enrollments/edit?id=<?= $enrollment['id'] ?>">
                    Edit
                </a>

                <form
                    action="/enrollments/delete"
                    method="post"
                    style="display:inline"
                >
                    <input
                        type="hidden"
                        name="id"
                        value="<?= $enrollment['id'] ?>"
                    >

                    <button type="submit">
                        Delete
                    </button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="pagination">
    <?php if (($page ?? 1) > 1): ?>
        <a href="/enrollments?<?= e(query_string(['page' => $page - 1])) ?>">Prev</a>
    <?php endif; ?>

    <span>Page <?= e($page ?? 1) ?> / <?= e($totalPages ?? 1) ?></span>

    <?php if (($page ?? 1) < ($totalPages ?? 1)): ?>
        <a href="/enrollments?<?= e(query_string(['page' => $page + 1])) ?>">Next</a>
    <?php endif; ?>
</div>

<?php
$content = ob_get_clean();
$title = 'Enrollment Management';
require __DIR__ . '/../layout.php';