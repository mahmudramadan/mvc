<?php

namespace App\Models;

use Illuminate\Database\Capsule\Manager as DB;

class AuthorModel
{
    public function getAllActiveAuthors(): array
    {
        return DB::select("SELECT id,name FROM authors where active = 1 ");
    }
    /**
     * @param array $data
     * @return int
     */
    public function createAuthor(array $data): int
    {
        DB::statement("INSERT INTO authors (name, active, created_at) 
                        value (?,?,?)",
            [$data['name'], $data['active'], $data['created_at']]);
        return (int)DB::getPdo()->lastInsertId();
    }

}
