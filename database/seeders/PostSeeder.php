<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use JeroenZwart\CsvSeeder\CsvSeeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->file = '/database/seeds/csvs/post.csv';
        // $this->mapping = ['id', 'cidade_id', 'desc_bairro'];
        // $this->header = false;
        $this->delimiter = ',';
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Recommended when importing larger CSVs
        DB::disableQueryLog();
        parent::run();
    }
}

