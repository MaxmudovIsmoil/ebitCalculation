<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderFile extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime:d.m.Y H:i',
            'updated_at' => 'datetime:d.m.Y H:i',
        ];
    }

    public function created_at(): Attribute
    {
        return Attribute::make(
            get: fn($value) => date('d.m.Y H:i', strtotime($value))
        );
    }
}
