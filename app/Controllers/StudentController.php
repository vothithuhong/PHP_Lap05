<?php

class StudentController
{
    private function repository(): StudentRepository
    {
        $config = require __DIR__ . '/../../config/database.php';
        $pdo = (new Database($config))->getConnection();

        return new StudentRepository($pdo);
    }
 


    public function index(): void
    {
        $q = trim($_GET['q'] ?? '');
        $page = max(1, (int) ($_GET['page'] ?? 1));
        $perPage = 10;
        $sort = $_GET['sort'] ?? 'enroll_date';
        $direction = $_GET['direction'] ?? 'desc';
        $offset = ($page - 1) * $perPage;
 
        $repo = $this->repository();
        $total = $repo->countAll($q);
        $totalPages = max(1, (int) ceil($total / $perPage));
 
        if ($page > $totalPages) {
            $page = $totalPages;
            $offset = ($page - 1) * $perPage;
        }
 
        $students = $repo->getPaginated($q, $perPage, $offset, $sort, $direction);
 
        view('Students/index', compact('students', 'q', 'page', 'perPage', 'total', 'totalPages', 'sort', 'direction'));
    }
 
    public function create(): void
    {
        $errors = [];
        $old = ['name' => '', 'email' => '', 'phone' => '', 'status' => 'new', 'note' => ''];
        view('Students/create', compact('errors', 'old'));
    }
 
    public function store(): void
    {
        $data = $this->validate($_POST);
        $errors = $data['errors'];
        $old = $data['values'];
 
        if (!empty($errors)) {
            view('Students/create', compact('errors', 'old'));
            return;
        }
 
        try {
            $this->repository()->create($data['values']);
            flash_set('success', 'student created successfully.');
            redirect('/students');
        } catch (DuplicateRecordException $e) {
            $errors['email'] = 'Email này đã tồn tại trong hệ thống.';
            view('Students/create', compact('errors', 'old'));
        } catch (Exception $e) {
            error_log($e->getMessage());
            http_response_code(500);
            view('errors/500');
        }
    }
 
    private function validate(array $input): array
    {
        $values = [
            'full_name' => trim($input['full_name'] ?? ''),
            'email' => trim($input['email'] ?? ''),
            'phone' => trim($input['phone'] ?? ''),
        ];

        $errors = [];

        if ($values['full_name'] === '') {
            $errors['full_name'] = 'Vui lòng nhập họ tên.';
        }

        if ($values['email'] === '') {
            $errors['email'] = 'Vui lòng nhập email.';
        } elseif (!filter_var($values['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email không đúng định dạng.';
        }

        return [
            'values' => $values,
            'errors' => $errors
        ];
    }

    public function update(): void
    {
        $id = (int) ($_GET['id'] ?? 0);

        $student = $this->repository()->findById($id);

        if (!$student) {
            http_response_code(404);
            view('errors/404');
            return;
        }

        $data = $this->validate($_POST);

        $errors = $data['errors'];
        $old = $data['values'];

        if (!empty($errors)) {
            $old['id'] = $id;
            view('Students/edit', compact('errors', 'old'));
            return;
        }

        try {

            $this->repository()->update(
                $id,
                $data['values']
            );

            flash_set(
                'success',
                'student updated successfully.'
            );

            redirect('/students');

        } catch (DuplicateRecordException $e) {

            $errors['email']
                = 'Email này đã tồn tại trong hệ thống.';

            $old['id'] = $id;

            view(
                'Students/edit',
                compact('errors', 'old')
            );

        } catch (Exception $e) {

            error_log($e->getMessage());

            http_response_code(500);

            view('errors/500');
        }
    }

    public function delete(): void
    {
        $id = (int) ($_POST['id'] ?? 0);

        try {

            $this->repository()->delete($id);

            flash_set(
                'success',
                'student deleted successfully.'
            );

            redirect('/students');

        } catch (Exception $e) {

            error_log($e->getMessage());

            http_response_code(500);

            view('errors/500');
        }
    }
    
    public function edit(): void
    {
        $id = (int) ($_GET['id'] ?? 0);

        $student = $this->repository()->findById($id);

        if (!$student) {
            http_response_code(404);
            view('errors/404');
            return;
        }

        $errors = [];
        $old = $student;

        view('Students/edit', compact(
            'old',
            'errors'
        ));
    }



}
