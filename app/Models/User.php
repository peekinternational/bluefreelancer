<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'companyname',
        'business_reg_num',
        'usertype',
        'email',
        'password',
        'address',
        'city',
        'zipcode',
        'state',
        'country',
        'timezone',
        'location',
        'hourly_rate',
        'cover_img',
        'img',
        'prof_headline',
        'description',
        'skills',
        'certs',
        'bids',
        'notify_all_freelancers',
        'notify_all_projects',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }
    public function education()
    {
        return $this->hasMany(Education::class);
    }
    public function certifications()
    {
        return $this->hasMany(Certification::class);
    }
    public function publications()
    {
        return $this->hasMany(Publication::class);
    }
    public function portfolios()
    {
        return $this->hasMany(Portfolio::class);
    }
    public function projects()
    {
        return $this->hasMany(Project::class);
    }
    public function bids()
    {
        return $this->hasMany(Bid::class);
    }
    public static function skillTitle($id)
    {
        return Skill::find($id);
    }
    public static function certTitle($id)
    {
        return ProfCertification::find($id);
    }
}
