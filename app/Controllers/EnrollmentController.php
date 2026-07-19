<?php

class EnrollmentController
{

    private function service(): EnrollmentService
    {
        Auth::check();

        $config = require __DIR__ . '/../../config/database.php';

        $pdo = (new Database($config))->getConnection();

        return new EnrollmentService(
            new EnrollmentRepository($pdo)
        );
    }


    public function index(): void
    {
        Auth::check();

        $q = trim($_GET['q'] ?? '');

        $page = max(
            1,
            (int)($_GET['page'] ?? 1)
        );

        $perPage = 10;

        $sort = $_GET['sort'] ?? 'id';

        $direction = $_GET['direction'] ?? 'desc';

        $offset = ($page - 1) * $perPage;


        $service = $this->service();


        $total = $service->countAll(
            $q,
            $_SESSION['user']['id']
        );


        $totalPages = max(
            1,
            ceil($total / $perPage)
        );


        $enrollments = $service->getPaginated(
            $q,
            $perPage,
            $offset,
            $sort,
            $direction,
            $_SESSION['user']['id']
        );


        view(
            'Enrollments/index',
            compact(
                'enrollments',
                'q',
                'page',
                'perPage',
                'total',
                'totalPages',
                'sort',
                'direction'
            )
        );
    }



    public function create(): void
    {
        Auth::check();

        $errors = [];

        $old = [
            'student_id'=>'',
            'course_id'=>'',
            'enroll_date'=>date('Y-m-d'),
            'status'=>'pending'
        ];


        view(
            'Enrollments/create',
            compact(
                'errors',
                'old'
            )
        );
    }




    public function store(): void
    {
        Auth::check();


        // Honeypot chống spam
        if (!empty($_POST['website'])) {

            die('Spam detected');

        }



        // Rate limit 5 giây

        if (
            isset($_SESSION['last_submit']) &&
            time() - $_SESSION['last_submit'] < 5
        ) {

            flash_set(
                'error',
                'Bạn thao tác quá nhanh.'
            );

            redirect('/enrollments/create');

        }


        $_SESSION['last_submit'] = time();




        $values = [

            'student_id'=>trim(
                $_POST['student_id'] ?? ''
            ),

            'course_id'=>trim(
                $_POST['course_id'] ?? ''
            ),

            'enroll_date'=>trim(
                $_POST['enroll_date'] ?? ''
            ),

            'status'=>trim(
                $_POST['status'] ?? 'pending'
            ),


            // lấy user đang login
            'user_id'=>$_SESSION['user']['id']

        ];



        $errors=[];



        if($values['student_id']===''){

            $errors['student_id']
                ='Student ID is required.';

        }



        if($values['course_id']===''){

            $errors['course_id']
                ='Course ID is required.';

        }



        if($values['enroll_date']===''){

            $errors['enroll_date']
                ='Enroll date is required.';

        }




        if(!in_array(
            $values['status'],
            [
                'pending',
                'approved',
                'cancelled'
            ],
            true
        )){

            $errors['status']
                ='Status không hợp lệ.';

        }



        if(!empty($errors)){


            $old=$values;


            view(
                'Enrollments/create',
                compact(
                    'errors',
                    'old'
                )
            );


            return;

        }




        try{


            $this->service()->create($values);



            flash_set(
                'success',
                'Enrollment created successfully.'
            );


            redirect('/enrollments');



        }
        catch(DuplicateRecordException $e){


            $errors['general']
                ='Enrollment đã tồn tại.';


            $old=$values;


            view(
                'Enrollments/create',
                compact(
                    'errors',
                    'old'
                )
            );


        }
        catch(Exception $e){


            error_log(
                $e->getMessage()
            );


            http_response_code(500);


            view(
                'errors/500'
            );

        }

    }





    public function delete(): void
    {
        Auth::check();

        $id = (int)($_POST['id'] ?? 0);

        if ($id > 0) {

            $this->service()->delete(
                $id,
                $_SESSION['user']['id']
            );
        }

        flash_set(
            'success',
            'Deleted successfully.'
        );

        redirect('/enrollments');
    }

    public function edit(): void
    {
        Auth::check();

        $id = (int)($_GET['id'] ?? 0);

        $enrollment = $this->service()->findById(
            $id,
            $_SESSION['user']['id']
        );

        if (!$enrollment) {

            http_response_code(404);

            view('errors/404');

            return;
        }

        $errors = [];

        $old = $enrollment;

        view(
            'Enrollments/edit',
            compact(
                'errors',
                'old'
            )
        );
    }

    public function update(): void
    {
        Auth::check();

        $id = (int)($_POST['id'] ?? 0);

        $values = [

            'student_id' => trim($_POST['student_id'] ?? ''),
            'course_id' => trim($_POST['course_id'] ?? ''),
            'enroll_date' => trim($_POST['enroll_date'] ?? ''),
            'status' => trim($_POST['status'] ?? 'pending')

        ];

        $this->service()->update(
            $id,
            $values,
            $_SESSION['user']['id']
        );

        flash_set(
            'success',
            'Updated successfully.'
        );

        redirect('/enrollments');
    }

}