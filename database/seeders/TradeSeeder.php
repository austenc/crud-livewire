<?php

namespace Database\Seeders;

use App\Models\Trade;
use Illuminate\Database\Seeder;

class TradeSeeder extends Seeder
{
    protected $total = 10;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Trade::factory()->count($this->total / 2)->create();
        Trade::factory()->exited()->count($this->total)->create();
        Trade::factory()->short()->exited()->count($this->total)->create();
    }
}
