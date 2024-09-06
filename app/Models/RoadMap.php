<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoadMap extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function instanceUsers()
    {
        return $this->hasOne(InstanceUser::class, 'instanceId', 'instanceId');
    }
    public function instance()
    {
        return $this->belongsTo(Instance::class, 'instanceId');
    }
}
