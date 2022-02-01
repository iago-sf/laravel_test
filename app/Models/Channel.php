<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'color'
    ];

    public function communitylinks()
    {
        return $this->hasMany(CommunityLink::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
