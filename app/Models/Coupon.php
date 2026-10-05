<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'discount',
        'min_amount',
        'valid_from',
        'valid_until',
        'max_uses',
        'uses',
        'active',
    ];

    protected $casts = [
        'discount' => 'decimal:2',
        'min_amount' => 'decimal:2',
        'valid_from' => 'date',
        'valid_until' => 'date',
        'uses' => 'integer',
        'max_uses' => 'integer',
        'active' => 'boolean',
    ];

    public function inValid()
    {
        if(!$this->active){

            return false;

        }

        if($this->valid_from && Carbon::now()->lt($this->valid_from)){

            return false;

        }

        if($this->max_uses && $this->uses >= $this->max_uses){

            return false;

        }

        return true;
    }

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public function scopeValid($query)
    {
        $now = Carbon::now();

        return $query->where('active', true)
            ->where('valid_form', '<=', $now)
            ->where('valid_form', '>=', $now)
            ->where(function ($q){
                $q->whereNull('max_uses')
                  ->orWhereColumn('uses', '<', 'max_uses');

            });
    }
}
