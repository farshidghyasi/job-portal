<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_listing_id', 'jobseeker_id', 'resume_id',
        'cover_letter', 'status', 'notes'
    ];

    public function job()
    {
        return $this->belongsTo(JobListing::class, 'job_listing_id');
    }

    public function jobseeker()
    {
        return $this->belongsTo(User::class, 'jobseeker_id');
    }

    public function resume()
    {
        return $this->belongsTo(Resume::class);
    }
}