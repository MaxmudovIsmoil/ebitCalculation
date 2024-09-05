<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\AsArrayObject

class RoadOrderRun extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
//            'road' => 'array'
            'road' => AsArrayObject
//            'vaqt' => 'date' date qo'yilsa carbon abyetidan foydalanish mumkin
//            'created_at' => 'date:d.m.Y'
//            'created_at' => 'datetime:d.m.Y H:i:s'
        ];
    }

}
