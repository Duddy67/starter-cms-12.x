<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'auth' => \App\Http\Middleware\Authenticate::class,
            'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
            'auth.session' => \Illuminate\Session\Middleware\AuthenticateSession::class,
            'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
            'can' => \Illuminate\Auth\Middleware\Authorize::class,
            'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
            'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
            'precognitive' => \Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests::class,
            'signed' => \App\Http\Middleware\ValidateSignature::class,
            'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
            'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
            // Backend
            'admin' => \App\Http\Middleware\Admin::class,
            'admin.users' => \App\Http\Middleware\AdminUsers::class,
            'admin.users.groups' => \App\Http\Middleware\AdminUserGroups::class,
            'admin.users.roles' => \App\Http\Middleware\AdminUserRoles::class,
            'admin.users.permissions' => \App\Http\Middleware\AdminUserPermissions::class,
            'admin.cms.settings' => \App\Http\Middleware\AdminSettings::class,
            'admin.cms.emails' => \App\Http\Middleware\AdminEmails::class,
            'admin.posts' => \App\Http\Middleware\AdminPosts::class,
            'admin.posts.categories' => \App\Http\Middleware\AdminPostCategories::class,
            'admin.posts.settings' => \App\Http\Middleware\AdminPostSettings::class,
            'admin.menus' => \App\Http\Middleware\AdminMenus::class,
            'admin.menus.items' => \App\Http\Middleware\AdminMenuItems::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
