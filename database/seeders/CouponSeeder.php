<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Coupon;
use Carbon\Carbon;

class CouponSeeder extends Seeder
{
    public function run(): void
    {
        $cupones = [
            [
                'code' => 'BIENVENIDO10',
                'discount' => 10.00,
                'min_amount' => 20.00,
                'valid_from' => Carbon::now()->subDays(5),
                'valid_until' => Carbon::now()->addDays(30),
                'max_uses' => 100,
            ],
            [
                'code' => 'DESCUENTO20',
                'discount' => 20.00,
                'min_amount' => 50.00,
                'valid_from' => Carbon::now()->subDays(2),
                'valid_until' => Carbon::now()->addDays(15),
                'max_uses' => 50,
            ],
            [
                'code' => 'ENVIOGRATIS',
                'discount' => 5.00,
                'min_amount' => 30.00,
                'valid_from' => Carbon::now(),
                'valid_until' => Carbon::now()->addDays(60),
                'max_uses' => 200,
            ],
        ];

        foreach($cupones as $cupon){
            Coupon::create([
                'code' => $cupon['code'],
                'discount' => $cupon['discount'],
                'min_amount' => $cupon['min_amount'],
                'valid_from' => $cupon['valid_from'],
                'valid_until' => $cupon['valid_until'],
                'max_uses' => $cupon['max_uses'],
                'uses' => 0,
                'active' => true,
            ]);

        }
    }
}
