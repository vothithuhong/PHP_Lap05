<?php

class EnrollmentController
{
    private function repository(): EnrollmentRepository
    {
        $config = require __DIR__ . '/../../config/database.php';
        $pdo = (new Database($config))->getConnection();

        return new EnrollmentRepository($pdo);
    }

    public function index(): void
    {
        $q = trim($_GET['q'] ?? '');
        $page = max(1, (int)($_GET['page'] ?? 1));
        $perPage = 10;
        $sort = $_GET['sort'] ?? 'id';
        $direction = $_GET['direction'] ?? 'desc';
        $offset = ($page - 1) * $perPage;

        $repo = $this->repository();

        $total = $repo->countAll($q);
        $totalPages = max(1, (int)ceil($total / $perPage));

        $enrollments = $repo->getPaginated(
            $q,
            $perPage,
            $offset,
            $sort,
            $direction
        );

        view('Enrollments/index', compact(
            'enrollments',
            'q',
            'page',
            'perPage',
            'total',
            'totalPages',
            'sort',
            'direction'
        ));
    }

    public function create(): void
    {
        $errors = [];
        $old = [
            'student_id' => '',
            'course_id' => '',
            'enroll_date' => date('Y-m-d'),
            'status' => 'pending'
        ];

        view('Enrollments/create', compact('errors', 'old'));
    }

    public function store(): void
    {
        $values = [
            'student_id' => trim($_POST['student_id'] ?? ''),
            'course_id' => trim($_POST['course_id'] ?? ''),
            'enroll_date' => trim($_POST['enroll_date'] ?? ''),
            'status' => trim($_POST['status'] ?? 'pending'),
        ];

        $errors = [];

        if ($values['student_id'] === '') {
            $errors['student_id'] = 'Student ID is required.';
        }

        if ($values['course_id'] === '') {
            $errors['course_id'] = 'Course ID is required.';
        }

        if ($values['enroll_date'] === '') {
            $errors['enroll_date'] = 'Enroll Date is required.';
        }

        if (!empty($errors)) {
            $old = $values;
            view('Enrollments/create', compact('errors', 'old'));
            return;
        }

        try {
            $this->repository()->create($values);

            flash_set('success', 'Enrollment created successfully.');
            redirect('/enrollments');
        } catch (Exception $e) {
            error_log($e->getMessage());

            $errors['general'] = $e->getMessage();
            $old = $values;

            view('Enrollments/create', compact('errors', 'old'));
        }
    }

    public function edit(): void
    {
        $id = (int)($_GET['id'] ?? 0);

        $enrollment = $this->repository()->findById($id);

        if (!$enrollment) {
            redirect('/enrollments');
        }

        $errors = [];
        $old = $enrollment;

        view('Enrollments/edit', compact('errors', 'old'));
    }

    public function update(): void
    {
        $id = (int)($_POST['id'] ?? 0);

        $values = [
            'student_id' => trim($_POST['student_id'] ?? ''),
            'course_id' => trim($_POST['course_id'] ?? ''),
            'enroll_date' => trim($_POST['enroll_date'] ?? ''),
            'status' => trim($_POST['status'] ?? 'pending'),
        ];

        $this->repository()->update($id, $values);

        redirect('/enrollments');
    }

    public function delete(): void
    {
        $id = (int)($_POST['id'] ?? 0);

        if ($id > 0) {
            $this->repository()->delete($id);
        }

        redirect('/enrollments');
    }
}