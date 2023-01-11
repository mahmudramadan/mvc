<?php

namespace App\Models;

use Illuminate\Database\Capsule\Manager as DB;

class UserModel
{
    public function getUserActiveData(string $email): array
    {
        return DB::select("select id, name, email, password 
                            FROM users 
                            where active = 1 AND email = ? LIMIT 1", [$email]);
    }

    public function setUserSession($userData): void
    {
        $_SESSION['isLogged'] = true;
        $_SESSION['userLoggedName'] = $userData->name;
        $_SESSION['userLoggedEmail'] = $userData->email;
        $_SESSION['userLoggedId'] = $userData->id;
    }
}
