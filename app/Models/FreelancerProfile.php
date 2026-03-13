<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FreelancerProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'title', 'bio', 'skills', 'hourly_rate',
        'availability', 'portfolio_url', 'github_url', 'linkedin_url',
        'experience_years', 'category', 'rating', 'total_reviews'
    ];

    protected $casts = [
        'skills' => 'array',
        'hourly_rate' => 'decimal:2',
        'rating' => 'decimal:1',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}