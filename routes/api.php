<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/todos', function () {
//    return response()->json([
//        ['id' => 1, 'title' => 'cool job', 'completed' => false],
//        ['id' => 2, 'title' => 'good job', 'completed' => false],
//    ]);
    $todos = App\Todo::all();

    return $todos;
})->middleware('api', 'cors');

Route::post('/todo/create', function (Request $request){
    $data = ['title' => $request->get('title'), 'completed' => '0'];
    $todo = App\Todo::create($data);

    return $data;
})->middleware('api', 'cors');

Route::patch('/todo/{id}/completed', function ($id){
    $todo = App\Todo::find($id);
    $todo->completed = !$todo->completed;
    $todo->save();

    return $todo;
})->middleware('api', 'cors');


Route::delete('/todo/{id}/delete', function ($id){
    $todo = App\Todo::find($id);
    $todo->delete();

    return response()->json(['deleted']);
})->middleware('api', 'cors');

Route::get('/todos/{id}', function ($id){
    $todo = App\Todo::find($id);

    return response()->json($todo);
})->middleware('api', 'cors');

Route::get('/tags', function (Request $request) {
    $tags = \App\Tag::select(['id','name'])
        ->where('name', 'like', '%'.$request->query('q').'%')
        ->get();
    return $tags;
})->middleware('api');

//Route::get('/diary/follower', function (Request $request){
////    return $request->user;
//    return response()->json(['followd' => false]);
//})->middleware('api', 'cors');

Route::post('/diary/follower', function (Request $request){
    $user = Auth::guard('api')->user();
    $followed = $user->followed($request->get('diary'));
    if ($followed) {
        return response()->json(['followed' => true]);
    } else {
        return response()->json(['followed' => false]);
    }
})->middleware('api', 'cors');

Route::post('/diary/follow', function (Request $request){
    $user = Auth::guard('api')->user();
    $diary = \App\Diary::find($request->get('diary'));
    $followed = $user->followThis($diary->id);
    if (count($followed['attached']) > 0) {
        $diary->increment('followers_count');
        return response()->json(['followed' => true]);
    } else {
        $diary->decrement('followers_count');
        return response()->json(['followed' => false]);
    }
})->middleware('auth:api');

Route::get('/user/followers/{id}', 'FollowersController@index');
Route::post('/user/follow', 'FollowersController@follow');