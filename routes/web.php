<?php

use App\Http\Controllers\AccessTokenController;
use App\Http\Controllers\CandidatesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubVoteController;
use App\Http\Controllers\VotingController;
use App\Models\AccessToken;
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
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

ROute::controller(DashboardController::class)->group(function () {
    Route::get('/dashboard', 'index')->name('dashboard');
    Route::get('/dashboard/votes/{votes}', 'show')->name('dashboard.vote.show');
});

Route::controller(HomeController::class)->group(function () {
    Route::get('/home', 'index')->name('home');
    Route::get('/home/votes/{votes}', 'voteCandidate')->name('home.vote');

    Route::post('/home/token-check', 'tokenCheck')->name('home.token-check');
});

Route::controller(VotingController::class)->group(function () {
    Route::get('/votes', 'index')->name('votes');
    Route::get('/vote/{votes}', 'show')->name('votes.show');
    Route::post('/votes/store', 'store')->name('votes.store');
});

Route::controller(SubVoteController::class)->group(function () {
    Route::post('/subvote/store/{votes}', 'store')->name('subvote.store');
    Route::post('/subvote/vote/{votes}', 'vote')->name('subvote.vote');
});

Route::controller(CandidatesController::class)->group(function () {
    Route::get('/candidates/getall', 'getAllCandidates')->name('candidates.getall');

    Route::get('/candidates', 'index')->name('candidates');
    Route::get('/candidates/add', 'create')->name('candidates.add');
    Route::get('/candidates/delete/{candidates}', 'delete')->name('candidates.delete');

    Route::get('/candidate/{candidates}', 'getCandidate')->name('candidates.getOne');

    Route::post('/candidates/store', 'store')->name('candidates.store');
});

Route::controller(AccessTokenController::class)->group(function () {
    Route::get('/access-token', 'index')->name('access-token');

    Route::post('/access-token/store', 'store')->name('access-token.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
