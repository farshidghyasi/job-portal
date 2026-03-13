<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FreelanceJob;
use App\Models\User;

class FreelanceJobSeeder extends Seeder
{
    public function run()
    {
        $employers = User::where('role', 'employer')->get();

        $jobs = [
            ['title' => 'Build a Company Website with Laravel', 'category' => 'Web Development', 'skills' => ['Laravel', 'PHP', 'MySQL', 'Blade'], 'min' => 500, 'max' => 1200, 'type' => 'fixed', 'duration' => '1 month'],
            ['title' => 'Design a Mobile App UI in Figma', 'category' => 'Design', 'skills' => ['Figma', 'UI/UX', 'Prototyping'], 'min' => 200, 'max' => 600, 'type' => 'fixed', 'duration' => '2 weeks'],
            ['title' => 'SEO Optimization for E-commerce Site', 'category' => 'Marketing', 'skills' => ['SEO', 'Google Analytics', 'Keyword Research'], 'min' => 15, 'max' => 25, 'type' => 'hourly', 'duration' => '3 months'],
            ['title' => 'React Native Mobile App Development', 'category' => 'Mobile Development', 'skills' => ['React Native', 'JavaScript', 'Firebase'], 'min' => 800, 'max' => 2000, 'type' => 'fixed', 'duration' => '2 months'],
            ['title' => 'Data Analysis and Reporting Dashboard', 'category' => 'Data Science', 'skills' => ['Python', 'Pandas', 'Tableau', 'SQL'], 'min' => 300, 'max' => 800, 'type' => 'fixed', 'duration' => '3 weeks'],
            ['title' => 'Logo and Brand Identity Design', 'category' => 'Design', 'skills' => ['Adobe Illustrator', 'Photoshop', 'Branding'], 'min' => 100, 'max' => 400, 'type' => 'fixed', 'duration' => '1 week'],
            ['title' => 'WordPress Website Setup and Customization', 'category' => 'Web Development', 'skills' => ['WordPress', 'CSS', 'PHP', 'WooCommerce'], 'min' => 200, 'max' => 600, 'type' => 'fixed', 'duration' => '2 weeks'],
            ['title' => 'Social Media Content Creation', 'category' => 'Marketing', 'skills' => ['Content Writing', 'Canva', 'Social Media'], 'min' => 10, 'max' => 20, 'type' => 'hourly', 'duration' => 'Ongoing'],
            ['title' => 'Translate Documents Dari to English', 'category' => 'Translation', 'skills' => ['Dari', 'English', 'Translation'], 'min' => 50, 'max' => 200, 'type' => 'fixed', 'duration' => '1 week'],
            ['title' => 'Flutter Mobile App for Delivery Service', 'category' => 'Mobile Development', 'skills' => ['Flutter', 'Dart', 'Firebase', 'Google Maps'], 'min' => 1000, 'max' => 2500, 'type' => 'fixed', 'duration' => '3 months'],
            ['title' => 'Video Editing for YouTube Channel', 'category' => 'Video Production', 'skills' => ['Premiere Pro', 'After Effects', 'Video Editing'], 'min' => 15, 'max' => 30, 'type' => 'hourly', 'duration' => 'Ongoing'],
            ['title' => 'Write Business Plan for Startup', 'category' => 'Writing', 'skills' => ['Business Writing', 'Research', 'Strategy'], 'min' => 150, 'max' => 500, 'type' => 'fixed', 'duration' => '2 weeks'],
        ];

        foreach ($jobs as $index => $job) {
            $employer = $employers[$index % count($employers)];
            FreelanceJob::create([
                'employer_id' => $employer->id,
                'title' => $job['title'],
                'description' => 'We need a skilled professional for: ' . $job['title'] . '. This is an exciting project for a reputable Afghan company. We are looking for someone who is reliable, communicates well, and can deliver quality work on time. Please submit your proposal with your portfolio and relevant experience.',
                'category' => $job['category'],
                'skills_required' => $job['skills'],
                'budget_min' => $job['min'],
                'budget_max' => $job['max'],
                'budget_type' => $job['type'],
                'duration' => $job['duration'],
                'location_type' => 'remote',
                'deadline' => now()->addDays(rand(7, 30)),
                'status' => 'active',
                'is_featured' => rand(0, 1) === 1,
            ]);
        }
    }
}