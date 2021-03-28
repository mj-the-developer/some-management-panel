<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Poor;

class Payment extends Model
{
    use HasFactory;

    public function poor()
    {
        return $this->belongsTo(Poor::class);
    }

    public function setAmountAttribute($value)
    {
        $this->attributes['amount'] = $this->removeCommaFromMoneyAmounts($value);
    }

    public function removeCommaFromMoneyAmounts($val)
    {
        return empty($val) ? null : str_replace(',', '', $val);
    }
}
