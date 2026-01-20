<?php

namespace App\Providers;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Queue\Events\JobProcessing;
use App\maillog;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    Schema::defaultStringLength(191);
	
		    Queue::after(function (JobProcessed $event) {
            $q = new maillog;
			$q->connName =  $event->connectionName;
           // $q->job = var_dump($event->job);
            $q->payload =  serialize($event->job->payload());
			$q->save();
        });
	}

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
