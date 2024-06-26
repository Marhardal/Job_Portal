<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $with = ['role', 'organisation', 'bookmarks'];


    /**
     * Get the Role that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Get the Apply that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Applicant()
    {
        return $this->belongsTo(Applicant::class);
    }

    /**
     * Get the Organisation that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Organisation()
    {
        return $this->belongsTo(Organisation::class);
    }

    /**
     * Get the Resume associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function Resume()
    {
        return $this->hasOne(Resume::class);
    }

    /**
     * The Post that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function Posts()
    {
        return $this->belongsToMany(Post::class, 'applicants', 'user_id', 'post_id')->withPivot(['document', 'message', 'post_id', 'user_id']);
    }

    /**
     * The Interviews that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function Interviews()
    {
        return $this->belongsToMany(Interview::class, 'applicants');
    }

    /**
     * Get all of the Bookmarks for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

}
