<?php

namespace App\Mixins;

use Illuminate\Support\Arr;

class ArrayMixin
{

    public function test()
    {
        return function (string $p) {
            return 'hi test' . $p;
        };
    }

    public function multiplyWithN()
    {
        return function ($arr, $n) {
            return collect($arr)->map(function ($a) use ($n) {
                return $a * $n;
            });
        };
    }
}
