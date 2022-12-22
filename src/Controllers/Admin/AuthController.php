<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Models\SecurityModel;
use App\Models\UserModel;
use App\Validation\CsrfToken;
use App\Validation\FormValidation;

class AuthController extends Controller
{
    public FormValidation $formValidation;
    public UserModel $model;
    public SecurityModel $securityModel;
    public CsrfToken $csrfToken;

    public function __construct(CsrfToken $csrfToken, SecurityModel $securityModel, UserModel $model, FormValidation $formValidation)
    {
        $this->csrfToken = $csrfToken;
        $this->securityModel = $securityModel;
        $this->model = $model;
        $this->formValidation = $formValidation;
    }

    public function index()
    {
        if (isset($_SESSION['isLogged'])) {
            header('Location: ' . BASE_URL . "admin-page");
        }
        $data = ['title' => "Login page", "js" => ["assets/js/login.js"]];
        $this->view("admin/login/index", $data);
    }

    public function loginUser()
    {
        $this->csrfToken->checkCsrf();
        $data = $this->securityModel->filterData($_POST);
        $this->formValidation->apply($this->getRules(), $data);
        $email = $data['email'];
        $password = $data['password'];
        $userData = $this->model->getUserActiveData($email);
        if (count($userData) == 0) {
            echo $this->errorResponse("email or password is incorrect1");
        } elseif (password_verify($password, $userData[0]->password)) {
            $this->model->setUserSession($userData[0]);
            echo $this->successResponse("Login successful");
        } else {
            echo $this->errorResponse("email or password is incorrect");
        }
    }

    public function getRules(): array
    {
        return [
            "email" => ["required", "email"],
            "password" => ["required", "min:5"]
        ];
    }

    public function logoutUser()
    {
        session_destroy();
        header('Location: ' . BASE_URL . "home");
    }
}
