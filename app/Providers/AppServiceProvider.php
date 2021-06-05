<?php

namespace App\Providers;

use App\Mixins\ArrayMixin;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\ServiceProvider;
use App\Repository\Doctor\DoctorInterface;
use App\Repository\Doctor\DoctorRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(DoctorInterface::class, DoctorRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Arr::macro('test', function (string $p) {
            return 'hi test boot' . $p;
        });
        Arr::macro('multiplyWith', function ($arr, $n) {
            return collect($arr)->map(function ($a) use ($n) {
                return $a * $n;
            });
        });

        Arr::mixin(new ArrayMixin);
        Str::macro('readDuration', function (...$text) {
            return  $totalWords = str_word_count(implode(" ", $text));
            $minutesToRead = round($totalWords / 200);

            return (int)max(2, $minutesToRead);
        });
    }
}
