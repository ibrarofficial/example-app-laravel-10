<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\MessageController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
	return view('welcome');
});

Route::get('/dashboard', function () {
	return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/pusher', function () {
    return view('pusher');
})->middleware(['auth', 'verified'])->name('pusher');

Route::get('/pusher2', function () {
    return view('pusher2');
})->middleware(['auth', 'verified'])->name('pusher2');

Route::get('message/index', [MessageController::class, 'index'])->name('message/index');
Route::get('message/send', [MessageController::class, 'send'])->name('message/send');

Route::get('/sendpusher', [ChatController::class, 'sendpusher'])->name('sendpusher');


Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');


Route::middleware('auth')->group(function () {
	Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
	Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
	Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

	//student route
	Route::prefix('student')->controller(StudentController::class)->name('student.')->group(function () {
		Route::get('/list', 'index')->name('list');
		Route::get('/create', 'create')->name('create');
		Route::post('/create', 'store')->name('create');
		Route::post('/update/{id}', 'update')->name('update');
		Route::get('/edit/{id}', 'edit')->name('edit');
		Route::post('delete','delete')->name('delete');
	});

	//stripe demo route
	Route::get('stripe', function () {return view('stripe');})->name('stripe');
	Route::post('stripe', [StripeController::class, 'stripe'])->name('stripe');
	Route::get('success', [StripeController::class, 'success'])->name('success');
	Route::get('cancel', [StripeController::class, 'cancel'])->name('cancel');

	//paypal demo route
	Route::get('paypal', function () {return view('paypal');})->name('paypal');
	Route::post('paypal', [PaypalController::class , 'paypal'])->name('paypal');
	Route::get('paypalsuccess', [PaypalController::class, 'paypalsuccess'])->name('paypalsuccess');
	Route::get('paypalcancel', [PaypalController::class, 'paypalcancel'])->name('paypalcancel');

});

require __DIR__.'/auth.php';
