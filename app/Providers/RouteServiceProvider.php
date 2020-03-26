<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        $this->mapAdminRoutes();

        $this->mapTeacherRoutes();

        $this->mapQuestionRoutes();

        $this->mapStudentRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }

    protected function mapAdminRoutes()
    {
        Route::prefix('admin')
            ->namespace($this->namespace)
            ->middleware('web')
            ->group(base_path('routes/admin.php'));
    }

    protected function mapTeacherRoutes()
    {
        Route::prefix('teacher')
            ->namespace($this->namespace)
            ->middleware('web')
            ->group(base_path('routes/teacher.php'));
    }

    protected function mapQuestionRoutes()
    {
        Route::prefix('teachers/questions/')
            ->as('teachers.')
            ->namespace($this->namespace)
            ->middleware(['web', 'auth:teacher', 'teacher.profile'])
            ->group(base_path('routes/question.php'));
    }
    protected function mapStudentRoutes()
    {
        Route::prefix('student')
            ->namespace($this->namespace)
            ->middleware(['web'])
            ->group(base_path('routes/student.php'));
    }
}
