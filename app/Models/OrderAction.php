<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderAction extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
          'created_at' => "datetime:d.m.Y H:i:s",
          'updated_at' => "datetime:d.m.Y H:i:s"
        ];
    }
}
