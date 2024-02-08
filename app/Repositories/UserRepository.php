<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function searchByEmail(string $email)
    {
        return User::where('email', $email)->first('id');
    }
}
