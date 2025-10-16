<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'department', 'description',
        'requirements', 'quota', 'deadline', 'status'
    ];

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}

