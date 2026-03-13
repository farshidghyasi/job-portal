<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FreelanceJob extends Model
{
    use HasFactory;

    protected $fillable = [
        'employer_id', 'title', 'description', 'category', 'skills_required',
        'budget_min', 'budget_max', 'budget_type', 'duration', 'location_type',
        'deadline', 'status', 'is_featured'
    ];

    protected $casts = [
        'skills_required' => 'array',
        'deadline' => 'date',
        'is_featured' => 'boolean',
        'budget_min' => 'decimal:2',
        'budget_max' => 'decimal:2',
    ];

    public function employer()
    {
        return $this->belongsTo(User::class, 'employer_id');
    }

    public function proposals()
    {
        return $this->hasMany(Proposal::class);
    }
}