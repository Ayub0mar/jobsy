<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    // Mass assignable fields (fillables)
    protected $fillable = [
        'employer_id',
        'title',
        'description',
        'location',
        'requirements',
        'salary',
        'company_name'
    ];

    /**
     * The employer (user) who posted the job.
     */
    public function employer()
    {
        return $this->belongsTo(User::class, 'employer_id');
    }

    /**
     * (Optional) Relationship with applications if you implement that.
     */
    public function applications()
    {
        return $this->hasMany(Application::class);
    }

}
