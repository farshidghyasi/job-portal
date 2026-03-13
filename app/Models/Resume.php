<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Resume extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'title', 'summary', 'skills', 'languages',
        'experience', 'education', 'certifications', 'is_public'
    ];

    protected $casts = [
        'skills' => 'array',
        'languages' => 'array',
        'experience' => 'array',
        'education' => 'array',
        'certifications' => 'array',
        'is_public' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}