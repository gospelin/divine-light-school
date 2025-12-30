<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\SchoolClass;
use App\Models\AcademicSession;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        // Get all classes and current session
        $classes = SchoolClass::all();
        $currentSession = AcademicSession::current();

        // If no current session, use the latest one
        if (!$currentSession) {
            $currentSession = AcademicSession::latest('start_year')->first();
        }

        // Realistic first names (boy/girl mix)
        $firstNamesBoys = ['Ahmed', 'Chukwuemeka', 'David', 'Emmanuel', 'Fatima', 'Grace', 'Hassan', 'Ibrahim', 'Joseph', 'Kemi'];
        $firstNamesGirls = ['Aisha', 'Blessing', 'Chioma', 'Damilola', 'Esther', 'Fatima', 'Halima', 'Ijeoma', 'Joy', 'Khadija'];
        $lastNames = ['Adebayo', 'Okonkwo', 'Mohammed', 'Okafor', 'Abdullahi', 'Nwosu', 'Yusuf', 'Eze', 'Ibrahim', 'Obi'];
        $otherNames = ['Chukwudi', 'Amina', 'Oluchi', 'Yakubu', 'Nkechi', 'Sani', 'Chidinma', 'Zainab', 'Emeka', 'Halima'];

        // Seed at least 5 students per class
        foreach ($classes as $class) {
            $studentCount = rand(5, 10); // At least 5, up to 10 per class

            for ($i = 1; $i <= $studentCount; $i++) {
                $isBoy = rand(0, 1);
                $firstName = $isBoy ? $firstNamesBoys[array_rand($firstNamesBoys)] : $firstNamesGirls[array_rand($firstNamesGirls)];
                $lastName = $lastNames[array_rand($lastNames)];
                $otherName = $otherNames[array_rand($otherNames)];

                // Auto-generate admission number: DLISS/year/0001 etc.
                $year = $currentSession->start_year;
                $lastStudent = Student::where('admission_session_id', $currentSession->id)
                    ->orderByDesc('id')
                    ->first();

                $nextNumber = $lastStudent ? ((int) substr($lastStudent->admission_number, -4)) + 1 : 1;
                $admissionNumber = sprintf('DLISS/%d/%04d', $year, $nextNumber);

                // Create student
                $student = Student::create([
                    'admission_number' => $admissionNumber,
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'other_names' => $otherName,
                    'date_of_birth' => now()->subYears(rand(5, 18))->format('Y-m-d'),
                    'gender' => $isBoy ? 'Male' : 'Female',
                    'parent_phone' => '080' . rand(10000000, 99999999),
                    'address' => 'No. ' . rand(1, 100) . ', ' . ['Lagos', 'Abuja', 'Port Harcourt', 'Kano', 'Enugu'][rand(0, 4)] . ' Street',
                    'father_name' => 'Mr. ' . $lastNames[array_rand($lastNames)],
                    'father_occupation' => ['Engineer', 'Doctor', 'Teacher', 'Businessman', 'Farmer'][rand(0, 4)],
                    'father_office_phone' => '081' . rand(10000000, 99999999),
                    'father_place_of_employment' => ['Private Firm', 'Government', 'Bank', 'Hospital'][rand(0, 3)],
                    'mother_name' => 'Mrs. ' . $lastNames[array_rand($lastNames)],
                    'mother_occupation' => ['Nurse', 'Teacher', 'Trader', 'Housewife'][rand(0, 3)],
                    'mother_office_phone' => '081' . rand(10000000, 99999999),
                    'mother_place_of_employment' => ['Private Firm', 'Government', 'Market'][rand(0, 2)],
                    'guardian_name' => 'Guardian ' . $lastNames[array_rand($lastNames)],
                    'guardian_occupation' => ['Retired', 'Business Owner'][rand(0, 1)],
                    'guardian_office_phone' => '081' . rand(10000000, 99999999),
                    'guardian_place_of_employment' => ['Retired', 'Self-employed'][rand(0, 1)],
                    'childhood_history' => 'Healthy childhood, no major illnesses.',
                    'last_school_attended' => 'Bright Future Nursery/Primary School',
                    'languages_spoken_at_home' => ['English', 'Yoruba', 'Igbo', 'Hausa'][rand(0, 3)],
                    'medical_history' => 'No known chronic illness.',
                    'admission_session_id' => $currentSession->id,
                ]);

                // Enroll in this class for current session
                $student->classes()->attach($class->id, [
                    'academic_session_id' => $currentSession->id,
                    'enrolled_at' => now(),
                ]);
            }
        }
    }
}