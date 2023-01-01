<?php
declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Models\AuthorModel;
use App\Models\NewsModel;
use App\Models\SecurityModel;
use App\Validation\CsrfToken;
use App\Validation\FormValidation;
use Throwable;

/**
 * NewsController
 *
 * @package App\Controllers\Admin\News
 * @author Mahmoud Ramadan <engmahmmoudramadan@gmail.com>
 */
class NewsController extends AdminController implements ResourcesInterface
{
    public FormValidation $formValidation;
    public SecurityModel $securityModel;
    public NewsModel $newsModel;
    public AuthorModel $authorModel;
    public CsrfToken $csrfToken;
    private array $formData;

    public function __construct(
        CsrfToken      $csrfToken,
        FormValidation $formValidation,
        SecurityModel  $securityModel,
        NewsModel      $newsModel,
        AuthorModel    $authorModel
    ) {
        parent::__construct();
        $this->csrfToken = $csrfToken;
        $this->formValidation = $formValidation;
        $this->securityModel = $securityModel;
        $this->newsModel = $newsModel;
        $this->authorModel = $authorModel;
    }

    /**
     * show all news
     */
    public function index(): void
    {
        $this->view->load("html", [
            'filePath' => "admin/news/index",
            'title' => "admin news page",
            "js" => ["assets/js/news.js"],
            "news" => $this->newsModel->getAllNews(),
            "authors" => $this->authorModel->getAllActiveAuthors()]);
    }

    /**
     * add new news item
     */
    public function add()
    {
        $this->csrfToken->checkCsrf();
        $this->checkFormValidation();
        try {
            $this->formData['created_at'] = date("Y-m-d H:i");
            $this->formData['created_by'] = $_SESSION['userLoggedId'];
            $this->formData["id"] = $this->newsModel->createNewsItem($this->formData);
            $this->view->load("json", $this->successMessage("data saved successfully", $this->formData));
        } catch (Throwable $throwable) {
            $this->view->load("json", $this->errorMessage($throwable->getMessage()));
        }
    }

    /**
     * get news item data
     * @param int $id
     */
    public function edit(int $id)
    {
        $newsItem = $this->newsModel->find($id);
        if (count($newsItem) > 0) {
            $this->view->load("json", $this->successMessage("data loaded successfully", $newsItem));
        } else {
            $this->view->load("json", $this->errorMessage("Item is not found"));
        }
    }

    /**
     * update news item data
     * @param int $id
     */
    public function update(int $id)
    {
        $this->csrfToken->checkCsrf();
        $this->checkFormValidation();
        try {
            $this->formData['updated_at'] = date("Y-m-d H:i");
            $this->newsModel->updateNewsItem($id, $this->formData);
            $this->view->load("json", [
                'success' => true,
                "data" => $this->formData,
                'message' => "data saved successfully",
            ]);
        } catch (Throwable $throwable) {
            $this->view->load("json", $this->errorMessage($throwable->getMessage()));
        }
    }

    /**
     * delete news item data
     * @param int $id
     */
    public function delete(int $id)
    {
        $this->csrfToken->checkCsrf();
        try {
            $this->newsModel->delete($id);
            $this->view->load("json", [
                'success' => true,
                'message' => "item deleted successfully",
            ]);
        } catch (Throwable $throwable) {
            $this->view->load("json", $this->errorMessage($throwable->getMessage()));
        }
    }

    /**
     * get news rules
     */
    private function getRules(): array
    {
        return [
            "title" => ["required", "min:10", "max:30"],
            "description" => ["required", "min:30"],
            "active" => ["required"],
            "author_id" => ["required", "gte:1"]
        ];
    }

    /**
     * check Form Validation
     */
    private function checkFormValidation()
    {
        $this->formData = $this->securityModel->filterData($_POST);
        if (!$this->formValidation->validate($this->getRules(), $this->formData)) {
            $this->view->load("json", $this->errorMessage($this->formValidation->getErrors()));
        }
    }
}
