<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    protected $fillable = [
        'background',
        'title',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function question()
    {
        return $this->hasMany(Question::class);
    }
    public function questionnaire()
    {
        return $this->hasMany(Questionnaire::class);
    }
}
