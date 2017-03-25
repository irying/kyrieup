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
    $followed = \App\Follow::where('diary_id', $request->get('diary'))
        ->where('user_id',$request->get('user'))
        ->count();
    if ($followed) {
        return response()->json(['followed' => true]);
    } else {
        return response()->json(['followed' => false]);
    }
})->middleware('api', 'cors');

Route::post('/diary/follow', function (Request $request){
    $followed = \App\Follow::where('diary_id', $request->get('diary'))
        ->where('user_id',$request->get('user'))
        ->first();
    if (is_null($followed)) {
        \App\Follow::create([
            'diary_id' => $request->get('diary'),
            'user_id' => $request->get('user'),
        ]);
        return response()->json(['followed' => true]);
    } else {
        $followed->delete();
        return response()->json(['followed' => false]);
    }
})->middleware('api', 'cors');