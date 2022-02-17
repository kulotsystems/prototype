<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::controller(InstructorController::class)->group(
    function () {
        //Instructor
        Route::middleware(['auth:sanctum', 'verified'])->get('/room', function () {
            return view('instructor.roompage');
        })->name('room');

        Route::post('/room', 'roomCreate');
        Route::get('/roomlist', 'roomList');
    }
);

Route::controller(StudentController::class)->group(
    function () {
        Route::middleware(['auth:sanctum', 'verified'])->get('/members', function () {
            return view('student.memberspage');
        })->name('members');

        Route::post('/members', 'membersCreate');

        Route::middleware(['auth:sanctum', 'verified'])->get('/classroom', function () {
            return view('student.classroom');
        })->name('classroom');

        Route::post('/classroom', 'searchRoom');

        Route::middleware(['auth:sanctum', 'verified'])->get('/joinroom', function () {
            return view('student.joinroom');
        })->name('joinroom');

        Route::post('/joinroom', 'joinRoom');
    }
);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [StudentController::class, 'displayStudentDashboard'])->name('dashboard');

//Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [StudentController::class, 'displayFile'])->name('dashboard');
Route::post('/dashboard',[StudentController::class, 'fileUpload'])->name('fileUpload');
