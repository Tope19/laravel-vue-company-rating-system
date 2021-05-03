<?php

namespace App\Models;

use App\Traits\Rateable;
use App\Traits\uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory, Rateable, uuids;

    public $appends = ['is_rated', 'formatted_date', 'has_rating'];

    protected $fillable = [
        'name',
        'email',
        'phone',
        'website',
        'avg_rating',
    ];

    public function ratings(){
        return $this->morphToMany(User::class, 'rating')->withTimestamps();
    }

    public function getFormattedDateAttribute(){
        return $this->created_at->format('F ds, Y');
    }
}
