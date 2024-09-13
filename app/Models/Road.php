<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Road extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];
    public function roadMaps()
    {
        return $this->hasMany(RoadMap::class, 'roadId');
    }

}
