<?php

namespace Database\Seeders;

use App\Models\AcademicSession;
use Illuminate\Database\Seeder;

class AcademicSessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sessions = [
            // Past sessions
            ['start_year' => 2020, 'end_year' => 2021],
            ['start_year' => 2021, 'end_year' => 2022],
            ['start_year' => 2022, 'end_year' => 2023],
            ['start_year' => 2023, 'end_year' => 2024],
            ['start_year' => 2024, 'end_year' => 2025],

             // Current session (as of December 25, 2025)
            ['start_year' => 2025, 'end_year' => 2026, 'is_current' => true],

            // Future sessions (for planning)
            ['start_year' => 2026, 'end_year' => 2027],
            ['start_year' => 2027, 'end_year' => 2028],
            ['start_year' => 2028, 'end_year' => 2029],
            ['start_year' => 2029, 'end_year' => 2030],
            ['start_year' => 2030, 'end_year' => 2031],
            ['start_year' => 2031, 'end_year' => 2032],
            ['start_year' => 2032, 'end_year' => 2033],
        ];

        foreach ($sessions as $sessionData) {
            AcademicSession::firstOrCreate(
                ['start_year' => $sessionData['start_year'], 'end_year' => $sessionData['end_year']],
                $sessionData + ['name' => $sessionData['start_year'] . '/' . $sessionData['end_year']]
            );
        }

        // Optional: Set realistic dates for the current session
        $current = AcademicSession::where('is_current', true)->first();
        if ($current) {
            $current->update([
                'start_date' => '2025-09-01',
                'end_date' => '2026-07-31',
            ]);
        }
    }
}