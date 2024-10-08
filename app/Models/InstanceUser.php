<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstanceUser extends Model
{
    use HasFactory;

     protected $guarded = ['id'];
//    public $incrementing = false;
//    protected $primaryKey = null;

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'userId');
    }

    public $timestamps = false;
}
