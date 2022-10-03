<?php
namespace Database\Seeders;

use Database\Seeders\CampaignSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;
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
        $this->call(RoleSeeder::class);
         $this->call(UserSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(CampaignSeeder::class);
        $this->call(PostSeeder::class);
        $this->call(DadosSeeder::class);
    }
}
