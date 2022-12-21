<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Models\SecurityModel;
use App\Models\UserModel;
use App\Validation\FormValidation;
use App\Traits\JsonResponse;

class AuthController extends Controller
{
    use JsonResponse;

    public FormValidation $formValidation;
    public UserModel $model;
    public SecurityModel $securityModel;

    public function __construct(SecurityModel $securityModel, UserModel $model, FormValidation $formValidation)
    {
        $this->securityModel = $securityModel;
        $this->model = $model;
        $this->formValidation = $formValidation;
    }

    public function index(array $params = [])
    {
        if (isset($_SESSION['isLogged'])) {
            header('Location: ');
        }
        $data = ['title' => "Login page", "js" => ["assets/js/login.js"]];
        $this->view("admin/login/index", $data);
    }

    public function loginUser()
    {
        $data = $this->securityModel->filterData($_POST);
        $this->formValidation->apply($this->getRules(), $data);
        if (!$this->formValidation->validate()) {
            return $this->errorResponse($this->formValidation->getErrors());
        }
        $email = filter_var($data['email'], FILTER_SANITIZE_STRING);
        $password = filter_var($data['password'], FILTER_SANITIZE_STRING);
        $userData = $this->model->getUserActiveData($email);
        if (count($userData) == 0) {
            return $this->errorResponse("email or password is incorrect1");
        } elseif (password_verify($password, $userData[0]->password)) {
            $this->model->setUserSession($userData[0]);
            return $this->successResponse("Login successful");
        } else {
            return $this->errorResponse("email or password is incorrect");
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
        header('Location: '.BASE_URL."home");
    }
}
