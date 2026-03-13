<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JobListing;
use App\Models\User;

class JobListingSeeder extends Seeder
{
    public function run()
    {
        $employers = User::where('role', 'employer')->get();

        $jobs = [
            ['title' => 'Senior Software Engineer', 'category' => 'Information Technology', 'type' => 'full-time', 'location' => 'Kabul, Afghanistan', 'salary_min' => 1500, 'salary_max' => 2500, 'exp' => 'senior', 'featured' => true],
            ['title' => 'PHP Laravel Developer', 'category' => 'Information Technology', 'type' => 'full-time', 'location' => 'Kabul, Afghanistan', 'salary_min' => 800, 'salary_max' => 1500, 'exp' => 'mid', 'featured' => false],
            ['title' => 'Project Manager', 'category' => 'Management', 'type' => 'full-time', 'location' => 'Mazar-i-Sharif, Afghanistan', 'salary_min' => 1200, 'salary_max' => 2000, 'exp' => 'senior', 'featured' => true],
            ['title' => 'Civil Engineer', 'category' => 'Engineering', 'type' => 'full-time', 'location' => 'Herat, Afghanistan', 'salary_min' => 1000, 'salary_max' => 1800, 'exp' => 'mid', 'featured' => false],
            ['title' => 'Medical Doctor', 'category' => 'Healthcare', 'type' => 'full-time', 'location' => 'Herat, Afghanistan', 'salary_min' => 1500, 'salary_max' => 3000, 'exp' => 'senior', 'featured' => true],
            ['title' => 'English Teacher', 'category' => 'Education', 'type' => 'full-time', 'location' => 'Kabul, Afghanistan', 'salary_min' => 600, 'salary_max' => 1000, 'exp' => 'entry', 'featured' => false],
            ['title' => 'Financial Analyst', 'category' => 'Finance', 'type' => 'full-time', 'location' => 'Kandahar, Afghanistan', 'salary_min' => 1000, 'salary_max' => 1800, 'exp' => 'mid', 'featured' => false],
            ['title' => 'Graphic Designer', 'category' => 'Design', 'type' => 'full-time', 'location' => 'Kabul, Afghanistan', 'salary_min' => 500, 'salary_max' => 900, 'exp' => 'entry', 'featured' => false],
            ['title' => 'Network Administrator', 'category' => 'Information Technology', 'type' => 'full-time', 'location' => 'Kabul, Afghanistan', 'salary_min' => 700, 'salary_max' => 1200, 'exp' => 'mid', 'featured' => false],
            ['title' => 'HR Manager', 'category' => 'Human Resources', 'type' => 'full-time', 'location' => 'Kabul, Afghanistan', 'salary_min' => 900, 'salary_max' => 1500, 'exp' => 'senior', 'featured' => false],
            ['title' => 'Marketing Coordinator', 'category' => 'Marketing', 'type' => 'part-time', 'location' => 'Kabul, Afghanistan', 'salary_min' => 400, 'salary_max' => 700, 'exp' => 'entry', 'featured' => false],
            ['title' => 'Accountant', 'category' => 'Finance', 'type' => 'full-time', 'location' => 'Mazar-i-Sharif, Afghanistan', 'salary_min' => 600, 'salary_max' => 1100, 'exp' => 'mid', 'featured' => false],
            ['title' => 'Web Designer', 'category' => 'Design', 'type' => 'contract', 'location' => 'Remote / Kabul', 'salary_min' => 500, 'salary_max' => 900, 'exp' => 'entry', 'featured' => false],
            ['title' => 'Operations Manager', 'category' => 'Management', 'type' => 'full-time', 'location' => 'Kandahar, Afghanistan', 'salary_min' => 1300, 'salary_max' => 2200, 'exp' => 'senior', 'featured' => false],
            ['title' => 'Data Entry Specialist', 'category' => 'Administration', 'type' => 'part-time', 'location' => 'Kabul, Afghanistan', 'salary_min' => 300, 'salary_max' => 500, 'exp' => 'entry', 'featured' => false],
            ['title' => 'Business Development Manager', 'category' => 'Management', 'type' => 'full-time', 'location' => 'Kabul, Afghanistan', 'salary_min' => 1500, 'salary_max' => 2800, 'exp' => 'senior', 'featured' => true],
            ['title' => 'Nurse', 'category' => 'Healthcare', 'type' => 'full-time', 'location' => 'Herat, Afghanistan', 'salary_min' => 500, 'salary_max' => 900, 'exp' => 'entry', 'featured' => false],
            ['title' => 'Electrical Engineer', 'category' => 'Engineering', 'type' => 'full-time', 'location' => 'Kabul, Afghanistan', 'salary_min' => 900, 'salary_max' => 1600, 'exp' => 'mid', 'featured' => false],
            ['title' => 'Customer Support Representative', 'category' => 'Customer Service', 'type' => 'full-time', 'location' => 'Kabul, Afghanistan', 'salary_min' => 400, 'salary_max' => 700, 'exp' => 'entry', 'featured' => false],
            ['title' => 'Supply Chain Officer', 'category' => 'Logistics', 'type' => 'full-time', 'location' => 'Mazar-i-Sharif, Afghanistan', 'salary_min' => 700, 'salary_max' => 1300, 'exp' => 'mid', 'featured' => false],
        ];

        foreach ($jobs as $index => $job) {
            $employer = $employers[$index % count($employers)];
            JobListing::create([
                'employer_id' => $employer->id,
                'title' => $job['title'],
                'description' => 'We are looking for a talented ' . $job['title'] . ' to join our growing team. The ideal candidate will have strong experience in their field and be passionate about making a difference in Afghanistan. This is an excellent opportunity to work with a leading organization and advance your career.',
                'requirements' => "- Bachelor's degree in relevant field\n- " . $job['exp'] . " level experience required\n- Strong communication skills in Dari/Pashto and English\n- Ability to work in a fast-paced environment\n- Team player with strong problem-solving skills",
                'benefits' => "- Competitive salary\n- Health insurance\n- Annual leave\n- Professional development opportunities\n- Friendly work environment",
                'category' => $job['category'],
                'type' => $job['type'],
                'location' => $job['location'],
                'salary_min' => $job['salary_min'],
                'salary_max' => $job['salary_max'],
                'salary_currency' => 'USD',
                'experience_level' => $job['exp'],
                'deadline' => now()->addDays(rand(14, 60)),
                'status' => 'active',
                'is_featured' => $job['featured'],
                'views_count' => rand(10, 500),
            ]);
        }
    }
}