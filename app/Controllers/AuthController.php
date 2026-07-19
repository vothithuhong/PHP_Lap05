<?php

class AuthController
{
    private function service(): AuthService
    {
        $config = require __DIR__ . '/../../config/database.php';

        $pdo = (new Database($config))->getConnection();

        return new AuthService(
            new UserRepository($pdo)
        );
    }


    public function login(): void
    {
        view('auth/login', [
            'error' => '',
            'old' => [
                'username' => ''
            ]
        ]);
    }


    public function handleLogin(): void
    {
        $username = trim($_POST['username'] ?? '');
        $password = trim($_POST['password'] ?? '');


        $old = [
            'username' => $username
        ];


        $result = $this->service()
            ->login($username, $password);


        if ($result) {

            redirect('/');
            return;

        }


        $error = flash_get('error');


        // Nếu flash trả về array
        if (is_array($error)) {

            $error = $error['message'] ?? 'Sai tài khoản hoặc mật khẩu.';

        }


        if (!$error) {

            $error = 'Sai tài khoản hoặc mật khẩu.';

        }


        view(
            'auth/login',
            compact(
                'error',
                'old'
            )
        );
    }


    public function logout(): void
    {
        Auth::logout();
    }
}