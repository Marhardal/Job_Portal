<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Js;

class Resume extends Model
{
    use HasFactory;

    protected $with = ['user', 'skills', 'duties', 'certificates', 'referrals', 'jobs',];
    /**
     * Get the user that owns the Resume
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The Skills that belong to the Resume
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function Skills()
    {
        return $this->belongsToMany(Skill::class, 'resume_skills',);
    }

    /**
     * The Certificate that belong to the Resume
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function Certificates()
    {
        return $this->belongsToMany(Certificate::class, 'qualifications');
    }

    /**
     * Get the Referals that owns the Resume
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Referrals()
    {
        return $this->belongsTo(Referrals::class);
    }

    /**
     * The Duties that belong to the Resume
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function Duties()
    {
        return $this->belongsToMany(Duty::class, 'experiences');
    }

    /**
     * The Jobs that belong to the Resume
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function Jobs()
    {
        return $this->belongsToMany(Job::class, 'experiences');
    }

}
