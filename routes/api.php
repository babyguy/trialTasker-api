<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EmailVerificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TypePersonController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\CasoController;
use App\Http\Controllers\TypeStageController;
use App\Http\Controllers\StageController;
use App\Http\Controllers\PersonStageController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


// ------------------------auth------------------------

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);


Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])
    ->name('verification.verify')
    ->middleware(['signed', 'throttle:6,1']);

Route::post('/email/verification-notification', [EmailVerificationController::class, 'resend'])
    ->middleware(['auth:sanctum', 'throttle:6,1'])
    ->name('verification.send');

// Route::get('register/verifty/{code}', [AuthController::class, 'verifyuser']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('user-profile', [AuthController::class, 'userprofile']);
    Route::post('verify-email', [AuthController::class, 'verifyemail']);
    
    Route::get('/casesActive', [CasoController::class, 'casesActive']);
    Route::get('/casesInactive', [CasoController::class, 'casesInactive']);
    Route::get('/infoCase/{id}', [StageController::class, 'infoCase']);
    
    Route::post('logout', [AuthController::class, 'logout']);
});

Route::post('allusers', [AuthController::class, 'allusers']);


// ------------------------dashboard----------------------------
Route::group([
    'prefix' => 'dashboard',
    'controller' => DashboardController::class,
    'middleware' => ['auth:sanctum',]
], function () {
    Route::get('/users-week', 'getUsersForWeek');
    Route::get('/sessions', 'getSessions');
});


//----------------------------typePerson----------------------------
Route::group([
    'prefix' => 'type-persons',
    'controller' => TypePersonController::class,
    'middleware' => ['auth:sanctum'],
], function () {
    Route::get('/', 'index');
    Route::get('/all', 'all');
    Route::post('/', 'store');
    Route::get('/{id}', 'show');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'destroy');
});

//----------------------------users----------------------------
route::group([
    'prefix' => 'users',
    'controller' => UserController::class,
    'middleware' => ['auth:sanctum'],
], function () {
    Route::get('/', 'index');
    Route::get('/all', 'all');
    Route::post('/', 'store');
    Route::get('/{id}', 'show');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'destroy');
});

//----------------------------person----------------------------
route::group([
    'prefix' => 'persons',
    'controller' => PersonController::class,
    'middleware' => ['auth:sanctum'],
], function () {
    Route::get('/', 'index');
    Route::get('/all', 'all');
    Route::post('/', 'store');
    Route::get('/{id}', 'show');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'destroy');
});

//----------------------------caso----------------------------
route::group([
    'prefix' => 'cases',
    'controller' => CasoController::class,
    'middleware' => ['auth:sanctum'],
], function () {
    Route::get('/', 'index');
    Route::get('/all', 'all');
    Route::post('/', 'store');
    Route::get('/{id}', 'show');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'destroy');
});

//----------------------------type_stage----------------------------
route::group([
    'prefix' => 'typeStages',
    'controller' => TypeStageController::class,
    'middleware' => ['auth:sanctum'],
], function () {
    Route::get('/', 'index');
    Route::get('/all', 'all');
    Route::post('/', 'store');
    Route::get('/{id}', 'show');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'destroy');
});


//----------------------------stages----------------------------
route::group([
    'prefix' => 'stages',
    'controller' => StageController::class,
    'middleware' => ['auth:sanctum'],
], function () {
    Route::get('/', 'index');
    Route::get('/all', 'all');
    Route::post('/', 'store');
    Route::get('/{id}', 'show');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'destroy');
});

//----------------------------personStage----------------------------
route::group([
    'prefix' => 'personStages',
    'controller' => PersonStageController::class,
    'middleware' => ['auth:sanctum'],
], function () {
    Route::get('/', 'index');
    Route::get('/all', 'all');
    Route::post('/', 'store');
    Route::get('/{id}', 'show');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'destroy');
});

//----------------------------files----------------------------
route::group([
    'prefix' => 'files',
    'controller' => FileController::class,
    'middleware' => ['auth:sanctum'],
], function () {
    Route::get('/', 'index');
    Route::get('/all', 'all');
    Route::post('/', 'store');
    Route::get('/{id}', 'show');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'destroy');
});


// ----------------------------casesUser----------------------------

