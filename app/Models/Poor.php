<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\NonCashHelp;
use App\Models\Payment;

class Poor extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function nonCashHelps()
    {
        return $this->hasMany(NonCashHelp::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function getFullNameAttribute()
    {
        if (empty($this->first_name) && empty($this->last_name)) {
            return 'نامشخص';
        }
        return $this->first_name . ' ' . $this->last_name;
    }

    public function setHasProblemSolvedAttribute($value)
    {
        $this->attributes['has_problem_solved'] = $value === 'on' ? 1 : 0;
    }

    public function setMonthlyNeedAmountAttribute($value)
    {
        $this->attributes['monthly_need_amount'] = $this->removeCommaFromMoneyAmounts($value);
    }

    public function setMonthlyRentAmountAttribute($value)
    {
        $this->attributes['monthly_rent_amount'] = $this->removeCommaFromMoneyAmounts($value);
    }

    public function setHomeRentAmountAttribute($value)
    {
        $this->attributes['home_rent_amount'] = $this->removeCommaFromMoneyAmounts($value);
    }

    public function setHomeDepositAmountAttribute($value)
    {
        $this->attributes['home_deposit_amount'] = $this->removeCommaFromMoneyAmounts($value);
    }

    public function removeCommaFromMoneyAmounts($amount)
    {
        return empty($amount) ? null : str_replace(',', '', $amount);
    }
}
