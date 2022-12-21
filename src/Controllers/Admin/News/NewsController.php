<?php
declare(strict_types=1);

namespace App\Controllers\Admin\News;

use App\Controllers\Admin\AdminController;
use App\Interfaces\ResourcesInterface;
use App\Models\AuthorModel;
use App\Models\NewsModel;
use App\Models\SecurityModel;
use App\Traits\JsonResponse;
use App\Validation\FormValidation;

class NewsController extends AdminController implements ResourcesInterface
{

    use JsonResponse;

    public FormValidation $formValidation;
    public SecurityModel $securityModel;
    public NewsModel $newsModel;
    public AuthorModel $authorModel;

    public function __construct(FormValidation $formValidation, SecurityModel $securityModel, NewsModel $newsModel, AuthorModel $authorModel)
    {
        parent::__construct();
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
        $data = $this->securityModel->filterData($_POST);
        $this->formValidation->apply($this->getRules(), $data);
        if (!$this->formValidation->validate()) {
            return $this->errorResponse($this->formValidation->getErrors());
        }
        try {
            $data['created_at'] = date("Y-m-d H:i");
            $data['created_by'] = $_SESSION['userLoggedId'];
            $data["id"] = $this->newsModel->createNewsItem($data);
            return $this->successResponse("data saved successfully", $data);
        } catch (\Exception $exception) {
            return $this->errorResponse($exception->getMessage());
        }
    }

    public function edit($id)
    {
        $newsItem = $this->newsModel->find($id);
        if (count($newsItem) > 0) {
            return $this->successResponse("item deleted successfully", $newsItem);
        } else {
            return $this->errorResponse("Item not exist");
        }
    }

    public function update($id)
    {
        $updatedData = $this->securityModel->filterData($_POST);
        $this->formValidation->apply($this->getRules(), $updatedData);
        if (!$this->formValidation->validate()) {
            return $this->errorResponse($this->formValidation->getErrors());
        }
        try {
            $updatedData['updated_at'] = date("Y-m-d H:i");
            $this->newsModel->UpdateNewsItem($updatedData);
            return $this->successResponse("data saved successfully",$updatedData);
        } catch (\Exception $exception) {
            return $this->errorResponse($exception->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $this->newsModel->delete($id);
            return $this->successResponse("item deleted successfully");
        } catch (\Exception $exception) {
            return $this->successResponse($exception->getMessage());
        }
    }

    public function getRules(): array
    {
        return [
            "title" => ["required", "min:10", "max:30"],
            "description" => ["required", "min:30"],
            "active" => ["required"],
            "author_id" => ["required", "gte:1"]
        ];
    }

}
