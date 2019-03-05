<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Route;
use Kaishiyoku\Menu\Config\Config;
use Kaishiyoku\Menu\Facades\Menu;

class Menus
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        Menu::setConfig(Config::forBootstrap4());

        Menu::registerDefault([
            Menu::linkRoute('home', __('common.nav.home')),
            Menu::linkRoute('cards.index', __('common.nav.cards'), [], [], [], $this->auth->check()),
        ], ['class' => 'nav navbar-nav']);

        Menu::register('guest', [
            Menu::linkRoute('login', __('common.nav.login'), [], [], [], $this->auth->guest()),
            Menu::linkRoute('register', __('common.nav.register'), [], [], [], $this->auth->guest() && Route::has('register')),
        ], ['class' => 'nav navbar-nav ml-auto']);

        return $next($request);
    }
}