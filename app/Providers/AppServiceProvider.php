<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Appointment;
use App\Models\Task;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()

    {
        $appointmentsCount = Appointment::all()->count();
        $tasksCount = Task::all()->count();
        View::share('appointmentsCount',$appointmentsCount);
        View::share('tasksCount',$tasksCount);

    }
}
