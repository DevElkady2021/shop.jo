<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profile;
use App\Models\Catagory;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name'=>'Admin',
            'trade_name'=>'Admin',
            'email'=>'admin@admin.com',
            'status'=>1,
            'password'=>bcrypt(123456),
        ]);

        Profile::create([
        'user_id'=>$user->id,
        'name'=>$user->name,
        'email'=>$user->email,
        'trade_name'=>$user->trade_name,
        'phone'=>'01000000000',
        'img'=>'http://localhost/shop.jo/public/man1.png',
     // 'img'=>'http://shop.shop-jo.com/shop/public/man1.png', // serve
        'address'=>'Cairo',
        ]);
     
    }
}
