<?php

class HomeController
{
    public function index(): void
    {
        Auth::check();

        view('home/index');
    }
}