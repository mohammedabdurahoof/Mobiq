<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $permissions = [
           // 'page-settings-wishlist-page',
        ];

        foreach ($permissions as $permission) {
             \Spatie\Permission\Models\Permission::where(['name' => $permission])->delete();
             \Spatie\Permission\Models\Permission::create(['name' => $permission, 'guard_name' => 'admin']);
        }
    }
}
