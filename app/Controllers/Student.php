<?php
namespace App\Controllers;
use CodeIgniter\Controller;

class User extends BaseController
{
    protected $helpers = ['url', 'form'];

    public function getHome()
    {
        $userModel = new \App\Models\UserModel();
        $data['users'] = $userModel->findAll();
        $data['content'] = view('user/home', $data);
        echo view("templates/header", $data);
        echo view('user/home', $data);
        echo view("templates/footer", $data);
    }

    public function getSearch()
    {
        $userModel = new \App\Models\UserModel();
        $data['users'] = $userModel->findAll();
        $data['content'] = view('user/search', $data);
        echo view("templates/header", $data);
        echo view('user/search', $data);
        echo view("templates/footer", $data);
    }

    public function getChat(){
        $userModel = new \App\Models\UserModel();
        $data['users'] = $userModel->findAll();
        $data['content'] = view('user/chat', $data);
        echo view("templates/header", $data);
        echo view('user/chat', $data);
        echo view("templates/footer", $data);
    }
}