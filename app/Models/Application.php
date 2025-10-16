<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'position_id', 'motivation', 'duration','whatsapp_number','active_email','status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function selection()
    {
        return $this->hasOne(Selection::class);
    }

    public function interview()
    {
        return $this->hasOne(Interview::class);
    }
}

