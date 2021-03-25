<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Poor;

class NonCashHelp extends Model
{
    use HasFactory;

    protected $dateFormat = 'U';

    public function poor()
    {
        return $this->belongsTo(Poor::class);
    }
}
