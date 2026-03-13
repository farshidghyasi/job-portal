<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Proposal extends Model
{
    use HasFactory;

    protected $fillable = [
        'freelance_job_id', 'freelancer_id', 'cover_letter',
        'bid_amount', 'delivery_time', 'status'
    ];

    protected $casts = [
        'bid_amount' => 'decimal:2',
    ];

    public function freelanceJob()
    {
        return $this->belongsTo(FreelanceJob::class);
    }

    public function freelancer()
    {
        return $this->belongsTo(User::class, 'freelancer_id');
    }
}