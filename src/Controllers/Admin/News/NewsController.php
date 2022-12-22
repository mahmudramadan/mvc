<?php

namespace App\Controllers\Admin\News;

use App\Controllers\Admin\AdminController;
use App\Interfaces\ResourcesInterface;
use App\Models\AuthorModel;
use App\Models\NewsModel;
use App\Models\SecurityModel;
use App\Traits\JsonResponse;
use App\Validation\CsrfToken;
use App\Validation\FormValidation;
use Exception;

class NewsController extends AdminController implements ResourcesInterface
{

    use JsonResponse;

    public FormValidation $formValidation;
    public SecurityModel $securityModel;
    public NewsModel $newsModel;
    public AuthorModel $authorModel;
    public CsrfToken $csrfToken;
    private array $formData;

    public function __construct(CsrfToken $csrfToken, FormValidation $formValidation, SecurityModel $securityModel, NewsModel $newsModel, AuthorModel $authorModel)
    {
        parent::__construct();
        $this->csrfToken = $csrfToken;
        $this->csrfToken->generate();
        $this->formValidation = $formValidation;
        $this->securityModel = $securityModel;
        $this->newsModel = $newsModel;
        $this->authorModel = $authorModel;
    }

    public function index()
    {
        $this->view("admin/news/index", [
            'title' => "admin news page",
            "js" => ["assets/js/news.js"],
            "news" => $this->newsModel->getAllNews(),
            "authors" => $this->authorModel->getAllActiveAuthors()]);
    }

    public function add()
    {
        $this->checkCsrf();
        $this->checkFormValidation();
        try {
            $this->formData['created_at'] = date("Y-m-d H:i");
            $this->formData['created_by'] = $_SESSION['userLoggedId'];
            $this->formData["id"] = $this->newsModel->createNewsItem($this->formData);
            echo $this->successResponse("data saved successfully", $this->formData);
        } catch (Exception $exception) {
            echo $this->errorResponse($exception->getMessage());
        }
    }

    public function edit($id)
    {
        $newsItem = $this->newsModel->find($id);
        if (count($newsItem) > 0) {
            echo $this->successResponse("item deleted successfully", $newsItem);
        } else {
            echo $this->errorResponse("Item not exist");
        }
    }

    public function update($id)
    {
        $this->checkCsrf();
        $this->checkFormValidation();
        try {
            $this->formData['updated_at'] = date("Y-m-d H:i");
            $this->newsModel->UpdateNewsItem($this->formData);
            echo $this->successResponse("data saved successfully", $this->formData);
        } catch (Exception $exception) {
            echo $this->errorResponse($exception->getMessage());
        }
    }

    /**
     * @param $id
     */
    public function delete($id)
    {
        $this->checkCsrf();
        try {
            $this->newsModel->delete($id);
            echo $this->successResponse("item deleted successfully");
        } catch (Exception $exception) {
            echo $this->errorResponse($exception->getMessage());
        }
    }

    private function checkCsrf()
    {
        $correctCsrf = $this->csrfToken->check();
        if (!$correctCsrf) {
            echo $this->errorResponse($this->csrfToken->getErrorMessage());
            die;
        }
    }

    private function getRules(): array
    {
        return [
            "title" => ["required", "min:10", "max:30"],
            "description" => ["required", "min:30"],
            "active" => ["required"],
            "author_id" => ["required", "gte:1"]
        ];
    }

    private function checkFormValidation()
    {
        $this->formData = $this->securityModel->filterData($_POST);
        $this->formValidation->apply($this->getRules(), $this->formData);
        if (!$this->formValidation->validate()) {
            echo $this->errorResponse($this->formValidation->getErrors());
            die;
        }
    }

}
