<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\EmployerProfile;
use App\Models\FreelancerProfile;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@jobs.af',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'status' => 'active',
        ]);

        // Employers
        $employers = [
            ['name' => 'Ahmad Karimi', 'email' => 'ahmad@techcorp.af', 'company' => 'TechCorp Afghanistan', 'industry' => 'Information Technology', 'city' => 'Kabul'],
            ['name' => 'Sara Mohammadi', 'email' => 'sara@buildco.af', 'company' => 'BuildCo Construction', 'industry' => 'Construction', 'city' => 'Mazar-i-Sharif'],
            ['name' => 'Reza Ahmadi', 'email' => 'reza@healthplus.af', 'company' => 'HealthPlus Clinic', 'industry' => 'Healthcare', 'city' => 'Herat'],
            ['name' => 'Fatima Noori', 'email' => 'fatima@eduafghan.af', 'company' => 'EduAfghan Institute', 'industry' => 'Education', 'city' => 'Kabul'],
            ['name' => 'Omar Wardak', 'email' => 'omar@financeaf.af', 'company' => 'FinanceAF Banking', 'industry' => 'Finance', 'city' => 'Kandahar'],
        ];

        foreach ($employers as $emp) {
            $user = User::create([
                'name' => $emp['name'],
                'email' => $emp['email'],
                'password' => Hash::make('password'),
                'role' => 'employer',
                'location' => $emp['city'] . ', Afghanistan',
                'status' => 'active',
            ]);
            EmployerProfile::create([
                'user_id' => $user->id,
                'company_name' => $emp['company'],
                'industry' => $emp['industry'],
                'company_size' => ['1-10', '11-50', '51-200', '201-500'][array_rand(['1-10', '11-50', '51-200', '201-500'])],
                'city' => $emp['city'],
                'country' => 'Afghanistan',
                'company_description' => 'A leading company in ' . $emp['industry'] . ' sector based in Afghanistan, committed to excellence and growth.',
            ]);
        }

        // Jobseekers
        $jobseekers = [
            ['name' => 'Khalid Rahimi', 'email' => 'khalid@gmail.com', 'location' => 'Kabul'],
            ['name' => 'Mariam Sultani', 'email' => 'mariam@gmail.com', 'location' => 'Herat'],
            ['name' => 'Dawoud Barakzai', 'email' => 'dawoud@gmail.com', 'location' => 'Kandahar'],
            ['name' => 'Freshta Azizi', 'email' => 'freshta@gmail.com', 'location' => 'Kabul'],
            ['name' => 'Najib Hussain', 'email' => 'najib@gmail.com', 'location' => 'Mazar-i-Sharif'],
        ];

        foreach ($jobseekers as $js) {
            User::create([
                'name' => $js['name'],
                'email' => $js['email'],
                'password' => Hash::make('password'),
                'role' => 'jobseeker',
                'location' => $js['location'] . ', Afghanistan',
                'status' => 'active',
            ]);
        }

        // Freelancers
        $freelancers = [
            ['name' => 'Bilal Yusufzai', 'email' => 'bilal@gmail.com', 'title' => 'Full Stack Web Developer', 'skills' => ['PHP', 'Laravel', 'Vue.js', 'MySQL'], 'rate' => 25, 'exp' => 5, 'cat' => 'Web Development'],
            ['name' => 'Layla Hashimi', 'email' => 'layla@gmail.com', 'title' => 'UI/UX Designer', 'skills' => ['Figma', 'Adobe XD', 'Photoshop', 'CSS'], 'rate' => 20, 'exp' => 3, 'cat' => 'Design'],
            ['name' => 'Zabi Safi', 'email' => 'zabi@gmail.com', 'title' => 'Digital Marketing Specialist', 'skills' => ['SEO', 'Google Ads', 'Social Media', 'Content Writing'], 'rate' => 15, 'exp' => 4, 'cat' => 'Marketing'],
            ['name' => 'Hana Rahmani', 'email' => 'hana@gmail.com', 'title' => 'Mobile App Developer', 'skills' => ['Flutter', 'React Native', 'Firebase', 'Dart'], 'rate' => 30, 'exp' => 6, 'cat' => 'Mobile Development'],
            ['name' => 'Sayed Karim', 'email' => 'sayed@gmail.com', 'title' => 'Data Analyst', 'skills' => ['Python', 'Excel', 'Tableau', 'SQL'], 'rate' => 22, 'exp' => 4, 'cat' => 'Data Science'],
        ];

        foreach ($freelancers as $fl) {
            $user = User::create([
                'name' => $fl['name'],
                'email' => $fl['email'],
                'password' => Hash::make('password'),
                'role' => 'freelancer',
                'location' => 'Kabul, Afghanistan',
                'status' => 'active',
            ]);
            FreelancerProfile::create([
                'user_id' => $user->id,
                'title' => $fl['title'],
                'bio' => 'Experienced ' . $fl['title'] . ' with ' . $fl['exp'] . ' years of professional experience. Passionate about delivering high-quality results for clients.',
                'skills' => $fl['skills'],
                'hourly_rate' => $fl['rate'],
                'availability' => 'available',
                'experience_years' => $fl['exp'],
                'category' => $fl['cat'],
                'rating' => round(rand(35, 50) / 10, 1),
                'total_reviews' => rand(5, 50),
            ]);
        }
    }
}