<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'userId');
    }

    public function instance()
    {
        return $this->hasOne(Instance::class, 'id', 'instanceId');
    }

    public function currentInstance()
    {
        return $this->hasOne(Instance::class, 'id', 'currentInstanceId');
    }

    public function orderAction()
    {
        return $this->hasMany(OrderAction::class, 'id', 'orderId');
    }

    public function RoadMapRun()
    {
        return $this->hasMany(RoadMapRun::class, 'roadId', 'roadId');
    }

    protected function casts(): array
    {
        return [
            'status' => OrderStatus::class,
            'date' => 'date:d.m.Y',
            'created_at' => 'datetime:d.m.Y H:i:s',
            'updated_at' => 'datetime:d.m.Y H:i:s',
        ];
    }

    public function date(): Attribute
    {
        return Attribute::make(
            get: fn($value) => date('d.m.Y', strtotime($value))
        );
    }
}
