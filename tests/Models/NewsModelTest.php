<?php
declare(strict_types=1);

namespace Models;

require __DIR__ . "/../../src/config/database.php";

use App\Models\NewsModel;
use Exception;
use PHPUnit\Framework\TestCase;
use Faker\Factory as Faker;

/**
 * UsersEntityTest
 * test setter and getter of News data
 */
final class NewsModelTest extends TestCase
{

    private NewsModel $newsModel;

    protected function setUp(): void
    {
        $this->newsModel = new NewsModel();
    }

    /**
     *
     * @dataProvider newsProvider
     * @param string $title
     * @param string $description
     * @param int $author
     * @param bool $active
     * @return void
     */
    public function testData(string $title, string $description, int $author, bool $active): void
    {
        $id = $this->newsModel->createNewsItem([
            "title" => $title,
            "description" => $description,
            "author_id" => $author,
            "active" => $active,
            "created_by" => 1,
            "created_at" => date("Y-m-d H:i:s"),
        ]);
        self::assertIsInt($id);
    }

    /**
     * @return array
     * @throws Exception
     */
    public function newsProvider(): array
    {
        $faker = Faker::create();
        $data = [];
        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'title' => $faker->words(5, true),
                'description' => $faker->paragraph(50),
                'author_id' => $faker->randomNumber(),
                'active' => $faker->boolean
            ];
        }
        return $data;
    }
}
