<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = ['job_id', 'jobseeker_id', 'resume_path', 'status',];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function jobseeker()
    {
        return $this->belongsTo(User::class, 'jobseeker_id');
    }
}
