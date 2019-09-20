<?php

use App\Services\UserService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run( UserService $userService )
    {
        $user = $userService->getUserByEmail('admin@admin.com');
        if($user->count() == 0){
            $new_user = [
                'name' => "JobLeads Admin",
                'email' => 'admin@admin.com',
                'password' => "admin8766",
                'email_verified_at' => date('Y-m-d H:i:s')
            ];

            $userService->create($new_user);
        }
    }
}
