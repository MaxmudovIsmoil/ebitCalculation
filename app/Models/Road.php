<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Road extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


//    public function roadMaps()
//    {
//        return $this->hasMany(RoadMap::class, 'roadId', 'id')->orderBy('stage');
//    }

    public function roadMaps()
    {
        return $this->hasMany(RoadMap::class, 'roadId');
    }
}
