<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobseekerController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\FreelancerController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\FreelanceJobController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminJobController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminFreelanceController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [HomeController::class, 'sendContact'])->name('contact.send');

// Public Job Listings
Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
Route::get('/jobs/{id}', [JobController::class, 'show'])->name('jobs.show');
Route::get('/jobs/category/{category}', [JobController::class, 'byCategory'])->name('jobs.category');

// Public Freelance Listings
Route::get('/freelance', [FreelanceJobController::class, 'index'])->name('freelance.index');
Route::get('/freelance/{id}', [FreelanceJobController::class, 'show'])->name('freelance.show');

// Public Freelancer Profiles
Route::get('/freelancers', [FreelancerController::class, 'publicIndex'])->name('freelancers.index');
Route::get('/freelancers/{id}', [FreelancerController::class, 'publicShow'])->name('freelancers.show');

// Public Company Profiles
Route::get('/companies', [EmployerController::class, 'publicIndex'])->name('companies.index');
Route::get('/companies/{id}', [EmployerController::class, 'publicShow'])->name('companies.show');

// Auth Routes
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Jobseeker Routes
Route::get('/jobseeker/dashboard', [JobseekerController::class, 'dashboard'])->name('jobseeker.dashboard');
Route::get('/jobseeker/profile', [JobseekerController::class, 'profile'])->name('jobseeker.profile');
Route::post('/jobseeker/profile', [JobseekerController::class, 'updateProfile'])->name('jobseeker.profile.update');
Route::get('/jobseeker/applications', [JobseekerController::class, 'applications'])->name('jobseeker.applications');
Route::get('/jobseeker/saved-jobs', [JobseekerController::class, 'savedJobs'])->name('jobseeker.saved-jobs');
Route::post('/jobseeker/save-job/{id}', [JobseekerController::class, 'saveJob'])->name('jobseeker.save-job');

// Resume Routes
Route::get('/jobseeker/resume', [ResumeController::class, 'index'])->name('resume.index');
Route::get('/jobseeker/resume/create', [ResumeController::class, 'create'])->name('resume.create');
Route::post('/jobseeker/resume', [ResumeController::class, 'store'])->name('resume.store');
Route::get('/jobseeker/resume/{id}/edit', [ResumeController::class, 'edit'])->name('resume.edit');
Route::put('/jobseeker/resume/{id}', [ResumeController::class, 'update'])->name('resume.update');
Route::delete('/jobseeker/resume/{id}', [ResumeController::class, 'destroy'])->name('resume.destroy');
Route::get('/resume/{id}/view', [ResumeController::class, 'publicView'])->name('resume.view');

// Job Application Routes
Route::get('/jobs/{id}/apply', [ApplicationController::class, 'create'])->name('jobs.apply');
Route::post('/jobs/{id}/apply', [ApplicationController::class, 'store'])->name('jobs.apply.store');

// Employer Routes
Route::get('/employer/dashboard', [EmployerController::class, 'dashboard'])->name('employer.dashboard');
Route::get('/employer/profile', [EmployerController::class, 'profile'])->name('employer.profile');
Route::post('/employer/profile', [EmployerController::class, 'updateProfile'])->name('employer.profile.update');
Route::get('/employer/jobs', [EmployerController::class, 'jobs'])->name('employer.jobs');
Route::get('/employer/jobs/create', [EmployerController::class, 'createJob'])->name('employer.jobs.create');
Route::post('/employer/jobs', [EmployerController::class, 'storeJob'])->name('employer.jobs.store');
Route::get('/employer/jobs/{id}/edit', [EmployerController::class, 'editJob'])->name('employer.jobs.edit');
Route::put('/employer/jobs/{id}', [EmployerController::class, 'updateJob'])->name('employer.jobs.update');
Route::delete('/employer/jobs/{id}', [EmployerController::class, 'destroyJob'])->name('employer.jobs.destroy');
Route::get('/employer/jobs/{id}/applications', [EmployerController::class, 'jobApplications'])->name('employer.jobs.applications');
Route::put('/employer/applications/{id}/status', [EmployerController::class, 'updateApplicationStatus'])->name('employer.applications.status');

// Freelancer Routes
Route::get('/freelancer/dashboard', [FreelancerController::class, 'dashboard'])->name('freelancer.dashboard');
Route::get('/freelancer/profile', [FreelancerController::class, 'profile'])->name('freelancer.profile');
Route::post('/freelancer/profile', [FreelancerController::class, 'updateProfile'])->name('freelancer.profile.update');
Route::get('/freelancer/proposals', [FreelancerController::class, 'proposals'])->name('freelancer.proposals');
Route::get('/freelance/{id}/apply', [FreelancerController::class, 'applyForm'])->name('freelance.apply');
Route::post('/freelance/{id}/apply', [FreelancerController::class, 'submitProposal'])->name('freelance.apply.store');

// Freelance Job Posting (by Employers)
Route::get('/employer/freelance-jobs', [FreelanceJobController::class, 'employerIndex'])->name('employer.freelance.index');
Route::get('/employer/freelance-jobs/create', [FreelanceJobController::class, 'create'])->name('employer.freelance.create');
Route::post('/employer/freelance-jobs', [FreelanceJobController::class, 'store'])->name('employer.freelance.store');
Route::get('/employer/freelance-jobs/{id}/edit', [FreelanceJobController::class, 'edit'])->name('employer.freelance.edit');
Route::put('/employer/freelance-jobs/{id}', [FreelanceJobController::class, 'update'])->name('employer.freelance.update');
Route::delete('/employer/freelance-jobs/{id}', [FreelanceJobController::class, 'destroy'])->name('employer.freelance.destroy');
Route::get('/employer/freelance-jobs/{id}/proposals', [FreelanceJobController::class, 'proposals'])->name('employer.freelance.proposals');

// Admin Auth
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Admin Routes
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin.users.index');
Route::get('/admin/users/{id}', [AdminUserController::class, 'show'])->name('admin.users.show');
Route::put('/admin/users/{id}/status', [AdminUserController::class, 'updateStatus'])->name('admin.users.status');
Route::delete('/admin/users/{id}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');
Route::get('/admin/jobs', [AdminJobController::class, 'index'])->name('admin.jobs.index');
Route::put('/admin/jobs/{id}/status', [AdminJobController::class, 'updateStatus'])->name('admin.jobs.status');
Route::delete('/admin/jobs/{id}', [AdminJobController::class, 'destroy'])->name('admin.jobs.destroy');
Route::get('/admin/freelance', [AdminFreelanceController::class, 'index'])->name('admin.freelance.index');
Route::put('/admin/freelance/{id}/status', [AdminFreelanceController::class, 'updateStatus'])->name('admin.freelance.status');
Route::delete('/admin/freelance/{id}', [AdminFreelanceController::class, 'destroy'])->name('admin.freelance.destroy');