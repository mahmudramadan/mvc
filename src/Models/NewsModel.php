<?php

namespace App\Models;

use Illuminate\Database\Capsule\Manager as DB;

class NewsModel
{
    /**
     * @return array
     */
    public function getAllNews(): array
    {
        return DB::select("SELECT news.*,authors.name as author_name 
                           FROM news 
                           JOIN authors on authors.id = news.author_id");
    }

    /**
     * @return array
     */
    public function getActiveNews(): array
    {
        return DB::select("SELECT news.*,authors.name as author_name 
                           FROM news 
                           JOIN authors on authors.id = news.author_id
                           WHERE news.active = 1 
                           ORDER BY news.id DESC
                           LIMIT 10");
    }

    /**
     * @param $id
     */
    public function delete($id)
    {
        DB::statement("delete from news where id = ?", [$id]);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return DB::select('select * from news where id = ?', [$id]);
    }

    /**
     * @param array $data
     * @return int
     */
    public function createNewsItem(array $data): int
    {
        DB::statement("INSERT INTO news (title, author_id, active, description,created_by, created_at) 
                        value (?,?,?,?,?,?)",
            [$data['title'], $data['author_id'], $data['active'], $data['description'], $data['created_by'], $data['created_at']]);
        return (int)DB::getPdo()->lastInsertId();
    }

    public function UpdateNewsItem(array $data)
    {
        DB::statement("UPDATE news SET title = ?, author_id = ?, active = ?, description = ?,updated_by = ?, updated_at = ?",
            [$data['title'], $data['author_id'], $data['active'], $data['description'], $_SESSION['userLoggedId'], $data['updated_at']]);
    }
}
