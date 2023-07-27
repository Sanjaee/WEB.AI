<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OpenAIController;



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
    return view('chatbot');
});

Route::get('/chat', [OpenAIController::class, 'showChatBot']);
Route::post('/chat', [OpenAIController::class, 'sendMessage']);
