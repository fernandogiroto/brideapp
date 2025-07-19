<?php

use App\Http\Controllers\AdminVideoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\VoteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|---------------------- ----------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Routes to login and register
Route::post('/register', [AuthController::class, 'register'])
    ->name('register');
Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1')
    ->name('login');

// Routes to recovery password.
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])
    ->name('forgot.password');
Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])
    ->name('reset.password');
Route::get('/reset-password/{token}', function ($token) {
    return response()->json(['token' => $token]);
})->name('password.reset');

// Access for logged-in users only.
Route::prefix('v1')->middleware('jwt.auth')->group( function () {
<<<<<<< HEAD
    Route::post('/me', [AuthController::class, 'me'])->name('me');
    Route::post('/refresh', [AuthController::class, 'refresh'])->name('refresh');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::put('/user-update', [AuthController::class, 'update'])->name('user.update');

    // Test
=======
    // User routes.
    Route::post('/me', [AuthController::class, 'me'])
        ->name('me');
    Route::post('/refresh', [AuthController::class, 'refresh'])
        ->name('refresh');
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
    Route::put('/user-update', [AuthController::class, 'update'])
        ->name('user.update');

    // Video routes.
    Route::get('/videos', [VideoController::class, 'index'])
        ->name('videos.index');
    Route::post('/video/upload', [VideoController::class, 'upload'])
        ->name('video.upload');
    Route::get('/videos/category/{categoryId}', [VideoController::class, 'videosByCategory'])
        ->name('videos.category');
    Route::get('/my-videos', [VideoController::class, 'myVideos'])
        ->name('my-videos.index');
    Route::delete('/video/{id}/delete', [VideoController::class, 'destroy'])
        ->name('video.destroy');

    // Vote route.
    Route::post('/video/{videoId}/vote', [VoteController::class, 'vote'])
        ->name('video.vote');

    // Test routes.
>>>>>>> 35d91532053fad25885f5a73c17ecd73aa797c2e
    Route::get('/test', function (Request $request) {
        return response()->json(['message' => 'API is working']);
    })->name('test');
});

// Admin routes.
Route::prefix('admin')->middleware(['jwt.auth', 'only.admin'])->group( function () {
    Route::get('/videos', [AdminVideoController::class, 'index'])
        ->name('admin.videos');
    Route::post('/video/upload', [AdminVideoController::class, 'upload'])
        ->name('admin.video.upload');
    Route::delete('/video/{id}/delete', [AdminVideoController::class, 'destroy'])
        ->name('admin.video.destroy');
    Route::put('/video/{video_id}/status/{status_id}',[AdminVideoController::class, 'updateStatus'])
        ->name('admin.update.status')
        ->where('video_id', '[0-9]+')
        ->where('status_id', '[0-9]+');
});
