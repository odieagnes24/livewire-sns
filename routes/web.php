<?php

use App\Http\Livewire\Home;
use App\Http\Livewire\Notifications;
use App\Http\Livewire\Post;
use App\Http\Livewire\Posts;
use App\Http\Livewire\Profile;
use App\Http\Livewire\SavedPosts;
use App\Http\Livewire\SearchPage;
use App\Http\Livewire\UserLogin;
use App\Http\Livewire\UserRegister;
use App\Http\Livewire\UserSettings;
use App\Http\Livewire\UserView;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', Posts::class)->middleware('check.auth')->name('feed');
Route::get('/', Home::class)->middleware('check.auth')->name('feed');
Route::get('/top', Home::class)->middleware('check.auth')->name('top');
Route::get('/fresh', Home::class)->middleware('check.auth')->name('fresh');
Route::get('/random', Home::class)->middleware('check.auth')->name('random');

Route::get('/user/{user:uname}', UserView::class)->middleware('check.auth')->name('view.user');

Route::get('/search', SearchPage::class)->middleware('check.auth')->name('search.view');

Route::get('/settings', UserSettings::class)->middleware('check.auth')->name('user.settings');

Route::get('/post/{post:id}', Post::class)->middleware('check.auth')->name('view.post');

Route::get('/notifications', Notifications::class)->middleware('check.auth')->name('notifications');

Route::get('/profile', Profile::class)->middleware('check.auth')->name('profile');
Route::get('/saved-posts', SavedPosts::class)->middleware('check.auth')->name('saved.posts');

Route::get('/login', UserLogin::class)->middleware('check.guest')->name('login');
Route::get('/register', UserRegister::class)->middleware('check.guest')->name('register');

Route::get('/php-info', function(){
    phpinfo();
});
