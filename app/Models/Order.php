<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function road()
    {
        return $this->hasOne(Road::class, 'id', 'roadId');
    }

    public function instance()
    {
        return $this->hasOne(Instance::class, 'id', 'currentInstanceId');
    }

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime:d.m.Y H:i:s',
            'updated_at' => 'datetime:d.m.Y H:i:s',
        ];
    }
}
