<?php

use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Haikus\ViewController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Haikus\IndexController;
use App\Http\Controllers\Haikus\CreateController;
use App\Http\Controllers\Haikus\UpdateController;
use App\Http\Controllers\Haikus\DeleteController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['middleware' => 'auth:sanctum', 'prefix' => 'haikus', 'name' => 'haikus'], static function (Router $router) {
    $router->post('/', CreateController::class);
    $router->get('/', IndexController::class);
    $router->get('/{id}', ViewController::class)->whereNumber('id');
    $router->put('/{id}', UpdateController::class)->whereNumber('id');
    $router->delete('/{id}', DeleteController::class)->whereNumber('id');
});

Route::post('/register', RegisterController::class);
Route::post('/login', LoginController::class);
