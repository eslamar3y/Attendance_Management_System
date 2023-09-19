<?php

use App\Http\Controllers\HeadController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
})->name('home');

Route::get('/login', function () {
    return view('Auth.login');
})->name('login');

// Route::post('/login', 'UserController@login'); // Use the correct controller and method for login
Route::post('/login', [UserController::class, 'login']);

// logout
Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');


Route::post('/register', [UserController::class, 'register']); // Use the correct controller and method for register

Route::get('/register', function () {
    return view('Auth.register');
})->name('register');




// admin

Route::get('/admin/dashboard', [UserController::class, 'dashboard'])->name('admin.dashboard');
// get department by name
Route::get('/admin/{name}', [UserController::class, 'getDepartment'])->name('admin.department');

// delete user
Route::get('/admin/delete/{id}', [UserController::class, 'deleteUser'])->name('deleteUser');

// add user
Route::post('/admin/add', [UserController::class, 'addUser'])->name('add_user');

// edit user
Route::get('/admin/edit/{id}', [UserController::class, 'editUser']);

// update user
Route::post('/admin/edit/{id}', [UserController::class, 'updateUser'])->name('update_user');

// profile
Route::get('/admin/profile/{id}', [UserController::class, 'profile'])->name('profile');

// approve_request
Route::get('/admin/approve/{id}', [UserController::class, 'approveRequest'])->name('approve_request');

// reject_request
Route::get('/admin/reject/{id}', [UserController::class, 'rejectRequest'])->name('reject_request');

// available_user
Route::get('/admin/users/available', [UserController::class, 'availableUsers'])->name('available_user');

// attendance
Route::get('/admin/users/attendance', [UserController::class, 'usersAttendence'])->name('users_attendance');

// admin/users/leaving
Route::get('/admin/users/leaving', [UserController::class, 'usersLeaving'])->name('users_leaving');

// admin/users/register
Route::get('/admin/users/register', [UserController::class, 'usersRegister'])->name('users_register');

// approve_request
Route::get('/admin/approve/register/{id}', [UserController::class, 'approveREGRequest'])->name('approve_register_request');

// reject_request
Route::get('/admin/reject/register/{id}', [UserController::class, 'rejectREGRequest'])->name('reject_register_request');


// head


Route::get('/head/dashboard', [HeadController::class, 'dashboard'])->name('head.dashboard');

// get department by name

Route::get('/head/{name}', [HeadController::class, 'getDepartment'])->name('head.department');

// edit user
Route::get('/head/edit/{id}', [HeadController::class, 'editUser']);

// update user
Route::post('/head/edit/{id}', [HeadController::class, 'updateUser'])->name('update_user');

// profile
Route::get('/head/profile/{id}', [HeadController::class, 'profile'])->name('profilehead');

// approve_request
Route::get('/head/approve/{id}', [HeadController::class, 'approveRequest'])->name('approve_requesthead');

// reject_request
Route::get('/head/reject/{id}', [HeadController::class, 'rejectRequest'])->name('reject_requesthead');

// available_user
Route::get('/head/users/available', [HeadController::class, 'availableUsers'])->name('available_userhead');

// attendance
Route::get('/head/users/attendance', [HeadController::class, 'usersAttendence'])->name('users_attendancehead');

// admin/users/leaving
Route::get('/head/users/leaving', [HeadController::class, 'usersLeaving'])->name('users_leavinghead');

// user

// dashboard
Route::get('/user/dashboard', [UserController::class, 'userDashboard'])->name('user.dashboard');

// profile
Route::get('/user/profile', [UserController::class, 'userProfile'])->name('user.profile');

// edit profile
Route::get('/user/edit', [UserController::class, 'editProfile']);

// update profile
Route::post('/user/edit', [UserController::class, 'updateUserProfile'])->name('update_current_user');

// check answer
Route::post('/user/check', [UserController::class, 'checkAnswer'])->name('check_answer');

// leave
Route::get('/user/leave', [UserController::class, 'leave'])->name('leave');

// request_leave
Route::post('/user/leave', [UserController::class, 'requestLeave'])->name('request_leave');
