<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Resume;
use App\Models\User;

class ResumeSeeder extends Seeder
{
    public function run()
    {
        $jobseekers = User::where('role', 'jobseeker')->get();

        foreach ($jobseekers as $user) {
            Resume::create([
                'user_id' => $user->id,
                'title' => 'Professional Resume - ' . $user->name,
                'summary' => 'Dedicated and results-driven professional with experience in my field. Seeking opportunities to contribute to a growing organization while developing my skills and advancing my career in Afghanistan.',
                'skills' => ['Microsoft Office', 'Communication', 'Team Work', 'Problem Solving', 'Time Management'],
                'languages' => [
                    ['language' => 'Dari', 'level' => 'Native'],
                    ['language' => 'Pashto', 'level' => 'Fluent'],
                    ['language' => 'English', 'level' => 'Intermediate'],
                ],
                'experience' => [
                    [
                        'title' => 'Junior Officer',
                        'company' => 'Previous Company',
                        'location' => 'Kabul, Afghanistan',
                        'start_date' => '2020-01',
                        'end_date' => '2022-12',
                        'current' => false,
                        'description' => 'Handled daily operations and administrative tasks. Collaborated with team members to achieve organizational goals.',
                    ],
                ],
                'education' => [
                    [
                        'degree' => 'Bachelor of Science',
                        'field' => 'Computer Science',
                        'institution' => 'Kabul University',
                        'location' => 'Kabul, Afghanistan',
                        'start_year' => '2016',
                        'end_year' => '2020',
                        'gpa' => '3.5',
                    ],
                ],
                'certifications' => [
                    ['name' => 'English Language Certificate', 'issuer' => 'British Council', 'year' => '2019'],
                ],
                'is_public' => true,
            ]);
        }
    }
}