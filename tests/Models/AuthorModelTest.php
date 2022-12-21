<?php

namespace Models;

require __DIR__ . "/../../src/config/database.php";

use App\Models\AuthorModel;
use Faker\Factory as Faker;
use PHPUnit\Framework\TestCase;

class AuthorModelTest extends TestCase
{
    private AuthorModel $model;

    protected function setUp(): void
    {
        $this->model = new AuthorModel();
    }

    /**
     *
     * @dataProvider authorsProvider
     * @param string $name
     * @param bool $active
     * @return void
     */

    public function testData(string $name, bool $active): void
    {
        $id = $this->model->createAuthor([
            "name" => $name,
            "active" => $active,
            "created_at" => date("Y-m-d H:i:s"),
        ]);
        self::assertIsInt($id);
    }

    /**
     * @return array
     * @throws Exception
     */
    public function authorsProvider(): array
    {
        $faker = Faker::create();
        $data = [];
        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'name' => $faker->name,
                'active' => $faker->boolean
            ];
        }
        return $data;
    }
}
