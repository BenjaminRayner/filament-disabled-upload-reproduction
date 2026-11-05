<?php

namespace Database\Seeders;

use App\Models\Example;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Seeder;

class ExampleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Storage::disk('local')->put('example.txt', 'Example document for the disabled upload reproduction.');
        Example::factory()->create();
    }
}
