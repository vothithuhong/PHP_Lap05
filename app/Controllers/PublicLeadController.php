<?php

class PublicLeadController
{

    private function service(): LeadService
    {
        $config = require __DIR__ . '/../../config/database.php';

        $pdo = (new Database($config))
            ->getConnection();


        return new LeadService(
            new LeadRepository($pdo)
        );
    }



    public function create(): void
    {
        $errors = $_SESSION['errors'] ?? [];

        $old = $_SESSION['old'] ?? [
            'name'=>'',
            'email'=>'',
            'phone'=>'',
            'message'=>''
        ];


        unset($_SESSION['errors']);
        unset($_SESSION['old']);


        view(
            'public-leads/create',
            compact('errors','old')
        );
    }



    public function store(): void
    {

        // Honeypot
        if (!empty($_POST['website'])) {

            http_response_code(400);

            exit("Spam detected");
        }



        // Rate limit 30 giây

        if(
            isset($_SESSION['lead_time']) &&
            time() - $_SESSION['lead_time'] < 30
        ){

            $_SESSION['flash']
                = "Bạn gửi quá nhanh.";

            redirect('/public-leads/create');
        }



        $_SESSION['lead_time']=time();



        $data=[

            'name'=>trim($_POST['name'] ?? ''),

            'email'=>trim($_POST['email'] ?? ''),

            'phone'=>trim($_POST['phone'] ?? ''),

            'message'=>trim($_POST['message'] ?? '')

        ];



        $errors=[];



        if($data['name']===''){

            $errors['name']
                ="Vui lòng nhập tên.";

        }


        if(
            !filter_var(
                $data['email'],
                FILTER_VALIDATE_EMAIL
            )
        ){

            $errors['email']
                ="Email không hợp lệ.";

        }



        if(!empty($errors)){


            $_SESSION['errors']=$errors;

            $_SESSION['old']=$data;


            redirect('/public-leads/create');

        }



        try{


            $this->service()
                ->create($data);



            $_SESSION['flash']
                ="Gửi thông tin thành công.";



            // PRG

            redirect('/public-leads/create');



        }catch(DuplicateRecordException $e){


            $_SESSION['errors']
                =[
                    'email'
                    =>
                    'Email đã tồn tại.'
                ];


            $_SESSION['old']=$data;


            redirect('/public-leads/create');

        }

    }

}