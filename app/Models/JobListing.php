<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobListing extends Model
{
    use HasFactory;

    protected $fillable = [
        'employer_id', 'title', 'description', 'responsibilities', 'requirements',
        'skills_required', 'skills_preferred', 'benefits',
        'category', 'type', 'work_arrangement', 'location', 'country', 'province',
        'salary_min', 'salary_max', 'salary_currency',
        'experience_level', 'years_of_experience', 'education_level',
        'deadline', 'status', 'is_featured', 'views_count',
        'num_vacancies', 'gender_preference',
    ];

    protected $casts = [
        'deadline' => 'date',
        'is_featured' => 'boolean',
        'salary_min' => 'decimal:2',
        'salary_max' => 'decimal:2',
        'views_count' => 'integer',
        'num_vacancies' => 'integer',
        'skills_required' => 'array',
        'skills_preferred' => 'array',
    ];

    public function employer()
    {
        return $this->belongsTo(User::class, 'employer_id');
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function savedByUsers()
    {
        return $this->belongsToMany(User::class, 'saved_jobs')->withTimestamps();
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}