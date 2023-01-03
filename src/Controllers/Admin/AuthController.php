<?php
declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Models\SecurityModel;
use App\Models\UserModel;
use App\Validation\CsrfToken;
use App\Validation\FormValidation;

/**
 * AuthController
 *
 * @package App\Controllers\Admin
 * @author Mahmoud Ramadan <engmahmmoudramadan@gmail.com>
 */
class AuthController extends Controller
{
    public FormValidation $formValidation;
    public UserModel $userModel;
    public SecurityModel $securityModel;
    public CsrfToken $csrfToken;

    public function __construct(CsrfToken      $csrfToken,
                                SecurityModel  $securityModel,
                                UserModel      $model,
                                FormValidation $formValidation)
    {
        parent::__construct();
        $this->csrfToken = $csrfToken;
        $this->securityModel = $securityModel;
        $this->userModel = $model;
        $this->formValidation = $formValidation;
    }

    /**
     * show login page
     */
    public function index()
    {
        if (isset($_SESSION['isLogged'])) {
            header('Location: ' . BASE_URL . "admin-page");
        }
        $this->view("html", [
            'filePath' => "admin/login/index",
            'title' => "Login page",
            "js" => ["assets/js/login.js"]
        ]);
    }

    /**
     * login user with email and password
     */
    public function loginUser()
    {
        $this->csrfToken->checkCsrf();
        $data = $this->securityModel->filterData($_POST);
        if (!$this->formValidation->validate($this->getRules(), $data)) {
            $this->view("json", $this->errorMessage($this->formValidation->getErrors()));
        }
        $email = $data['email'];
        $password = $data['password'];
        $userData = $this->userModel->getUserActiveData($email);
        if (count($userData) == 0) {
            $this->view("json", $this->errorMessage("email or password is incorrect1"));
        } elseif (password_verify($password, $userData[0]->password)) {
            $this->userModel->setUserSession($userData[0]);
            $this->view("json", $this->successMessage("Login successful"));
        } else {
            $this->view("json", $this->errorMessage("email or password is incorrect"));
        }
    }

    /**
     * get login rules
     */
    public function getRules(): array
    {
        return [
            "email" => ["required", "email"],
            "password" => ["required", "min:5"]
        ];
    }

    /**
     * logout user
     */
    public function logoutUser(): void
    {
        session_destroy();
        header('Location: ' . BASE_URL . "home");
    }
}
