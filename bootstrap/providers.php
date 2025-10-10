<?php

return [
    /*
     * Package Service Providers...
     */
    Spatie\Permission\PermissionServiceProvider::class,
    Spatie\EloquentSortable\EloquentSortableServiceProvider::class,

    /*
     * Application Service Providers...
     */
    App\Providers\AppServiceProvider::class,
    App\Providers\AuthServiceProvider::class,
    // App\Providers\BroadcastServiceProvider::class,
    App\Providers\EventServiceProvider::class,
    App\Providers\RouteServiceProvider::class,
    App\Providers\BladeServiceProvider::class,
];
