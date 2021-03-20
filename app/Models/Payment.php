<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Poor;

class Payment extends Model
{
    use HasFactory;

    public function poor()
    {
        return $this->belongsTo(Poor::class);
    }
}
