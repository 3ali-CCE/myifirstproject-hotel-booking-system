<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\mainController;
use Illuminate\Support\Facades\Route;

/*mainController*/

Route::get('/', [mainController::class, 'home'])->name('home');
Route::get('/city/hotel/{id}', [mainController::class, 'cityHotels'])->name('cityHotels');
Route::get('/hotel/rooms/{id}', [mainController::class, 'hotelRooms'])->name('hotelRooms');
Route::get('/services', [mainController::class, 'services'])->name('services');
Route::get('/booking/{roomId}/create', [mainController::class, 'createBooking'])->name('booking.create');
Route::post('/booking/store', [mainController::class, 'storeBooking'])->name('booking.store');


/*AuthController*/
Route::get('/pagelogin', [AuthController::class, 'login'])->name('loginPage')->middleware('guest');
Route::get('/pagesignup', [AuthController::class, 'signup'])->name('signupPage')->middleware('guest');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::POST('/registeraction', [AuthController::class, 'registeraction'])->name('registeraction')->middleware('guest');
Route::POST('/loginaction', [AuthController::class, 'loginaction'])->name('loginaction')->middleware('guest');


/*AdminController*/
Route::get('/admin/HomePage', [AdminController::class, 'home'])->name('adminHome')->middleware(['auth', 'admin']);

Route::get('/admin/UsersPage', [AdminController::class, 'user'])->name('adminUsers')->middleware(['auth', 'admin']);
Route::post('/admin/users/{id}/update', [AdminController::class, 'updateUser'])->name('user.update');
Route::post('/admin/users/{id}/delete', [AdminController::class, 'deleteUser'])->name('user.delete');


Route::get('/admin/hotels', [AdminController::class, 'hotels'])->name('admin.hotels');
Route::post('/admin/hotels/{id}/update', [AdminController::class, 'updateHotel'])->name('hotel.update');
Route::post('/admin/hotels/{id}/delete', [AdminController::class, 'deleteHotel'])->name('hotel.delete');


Route::get('/admin/addHotel/Page', [AdminController::class, 'addhotelPage'])->name('admin.addHotel')->middleware(['auth', 'admin']);
Route::get('/admin/addRoom/Page', [AdminController::class, 'addroomPage'])->name('admin.addRoom')->middleware(['auth', 'admin']);


Route::post('/admin/city/add', [AdminController::class, 'addcity'])->name('addCity')->middleware(['auth', 'admin']);
Route::post('/admin/hotel/add', [AdminController::class, 'addhotel'])->name('addHotel')->middleware(['auth', 'admin']);
Route::post('/admin/room/add', [AdminController::class, 'addroom'])->name('addRoom')->middleware(['auth', 'admin']);
Route::post('/admin/room/add/Images', [AdminController::class, 'addRoomImages'])->name('addRoomImages');


Route::get('/admin/bookings', [AdminController::class, 'bookings'])->name('admin.bookings');
Route::post('/admin/bookings/{id}/status', [AdminController::class, 'updateStatus'])->name('booking.updateStatus');
Route::post('/admin/bookings/{id}/delete', [AdminController::class, 'deleteBooking'])->name('booking.delete');
