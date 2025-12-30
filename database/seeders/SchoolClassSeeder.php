<?php

namespace Database\Seeders;

use App\Models\SchoolClass;
use Illuminate\Database\Seeder;

class SchoolClassSeeder extends Seeder
{
    public function run(): void
    {
        // Manual version (since JS not allowed in seeder)
        $classes = [
            // Nursery
            ['section' => 'Nursery', 'name' => 'Nursery 1', 'group' => 'A', 'order' => 10],
            ['section' => 'Nursery', 'name' => 'Nursery 1', 'group' => 'B', 'order' => 20],
            ['section' => 'Nursery', 'name' => 'Nursery 2', 'group' => 'A', 'order' => 30],
            ['section' => 'Nursery', 'name' => 'Nursery 2', 'group' => 'B', 'order' => 40],

            // Primary 1–6 A & B
            ['section' => 'Primary', 'name' => 'Primary 1', 'group' => 'A', 'order' => 10],
            ['section' => 'Primary', 'name' => 'Primary 1', 'group' => 'B', 'order' => 15],
            ['section' => 'Primary', 'name' => 'Primary 2', 'group' => 'A', 'order' => 20],
            ['section' => 'Primary', 'name' => 'Primary 2', 'group' => 'B', 'order' => 25],
            ['section' => 'Primary', 'name' => 'Primary 3', 'group' => 'A', 'order' => 30],
            ['section' => 'Primary', 'name' => 'Primary 3', 'group' => 'B', 'order' => 35],
            ['section' => 'Primary', 'name' => 'Primary 4', 'group' => 'A', 'order' => 40],
            ['section' => 'Primary', 'name' => 'Primary 4', 'group' => 'B', 'order' => 45],
            ['section' => 'Primary', 'name' => 'Primary 5', 'group' => 'A', 'order' => 50],
            ['section' => 'Primary', 'name' => 'Primary 5', 'group' => 'B', 'order' => 55],
            ['section' => 'Primary', 'name' => 'Primary 6', 'group' => 'A', 'order' => 60],
            ['section' => 'Primary', 'name' => 'Primary 6', 'group' => 'B', 'order' => 65],

            // JSS 1–3 (with and without group)
            ['section' => 'Secondary', 'name' => 'JSS 1', 'group' => 'A', 'order' => 100],
            ['section' => 'Secondary', 'name' => 'JSS 1', 'group' => 'B', 'order' => 105],
            ['section' => 'Secondary', 'name' => 'JSS 2', 'group' => 'A', 'order' => 200],
            ['section' => 'Secondary', 'name' => 'JSS 2', 'group' => 'B', 'order' => 205],
            ['section' => 'Secondary', 'name' => 'JSS 3', 'group' => 'A', 'order' => 300],
            ['section' => 'Secondary', 'name' => 'JSS 3', 'group' => 'B', 'order' => 305],

            // SSS 1–3 A & B
            ['section' => 'Secondary', 'name' => 'SSS 1', 'group' => 'A', 'order' => 400],
            ['section' => 'Secondary', 'name' => 'SSS 1', 'group' => 'B', 'order' => 405],
            ['section' => 'Secondary', 'name' => 'SSS 2', 'group' => 'A', 'order' => 500],
            ['section' => 'Secondary', 'name' => 'SSS 2', 'group' => 'B', 'order' => 505],
            ['section' => 'Secondary', 'name' => 'SSS 3', 'group' => 'A', 'order' => 600],
            ['section' => 'Secondary', 'name' => 'SSS 3', 'group' => 'B', 'order' => 605],
        ];

        foreach ($classes as $class) {
            SchoolClass::create($class);
        }
    }
}