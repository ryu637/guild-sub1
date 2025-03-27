<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'address',
        'website',
        'total_spent',
        'representative',
        'employee',
        'capital',
        'annualsales',
        'description'
    ];

    public function user(){
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function projects(){
        return $this->hasMany(Project::class);
    }

    public function ListOffavoriteFreelancers(){
        return $this->hasMany(FavoriteFreelancer::class);
    }

    public function favoriteFreelancers()
    {
        return $this->belongsToMany(Freelancer::class, 'favorite_freelancers', 'company_id', 'freelancer_id')->withTimestamps();
    }
}
