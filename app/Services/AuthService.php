<?php

class AuthService
{

    public function __construct(
        private UserRepository $userRepository
    ) {}


    public function login(
        string $username,
        string $password
    ): bool
    {

        if ($username === '' || $password === '') {

            flash_set(
                'error',
                'Vui lòng nhập đầy đủ thông tin.'
            );

            return false;
        }


        $user = $this->userRepository
            ->findByUsername($username);


        if (!$user) {

            flash_set(
                'error',
                'Sai tài khoản hoặc mật khẩu.'
            );

            return false;
        }


        if (!password_verify(
            $password,
            $user['password']
        )) {

            flash_set(
                'error',
                'Sai tài khoản hoặc mật khẩu.'
            );

            return false;
        }


        Auth::login($user);


        return true;
    }
}