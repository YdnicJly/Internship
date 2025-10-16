<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
       use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
        'role', 'school_name', 'major', 'education_level',
        'phone', 'address', 'profile_photo'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    // 🔗 Relasi
    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function journals()
    {
        return $this->hasMany(Journal::class);
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }

    public function certificate()
    {
        return $this->hasOne(Certificate::class);
    }

    public function finalReport()
    {
        return $this->hasOne(FinalReport::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    // 🔐 Helper role
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isStudent()
    {
        return $this->role === 'student';
    }
}
