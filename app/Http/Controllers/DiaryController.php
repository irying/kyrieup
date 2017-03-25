<?php

namespace App\Http\Controllers;

use App\Diary;
use App\Http\Requests\StoreDiaryRequest;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Impl\Repo\Diary\EloquentDiary;

class DiaryController extends Controller
{
    protected $diary;

    public function __construct(EloquentDiary $diary)
    {
        $this->diary = $diary;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $diaries = $this->diary->getLatest();
//        $page = Input::get('page', 1);
//        $perPage = 10;
//        $pageData = $this->diary->byPage($page, $perPage);
//        $diaries = new LengthAwarePaginator($pageData->items, $pageData->totalItems, $perPage);
//        $this->layout->content = View::make('diaries.index')->with('diaries', $diaries);
//        return view('diaries.index', ['diaries' => $diaries]);
        return view('diaries.index', compact('diaries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('diaries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreDiaryRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDiaryRequest $request)
    {
        $tags = $this->diary->normalizeTag($request->get('tags'));
        $data = [
            'title' => $request->get('title'),
            'content' => $request->get('content'),
            'user_id' => Auth::id(),
        ];
        $diary = $this->diary->create($data);
        $diary->tags()->attach($tags);

        return redirect()->route('diary.show', [$diary->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $diary = $this->diary->byIdWithTags($id);
        return view('diaries.show', compact('diary'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $diary = $this->diary->byId($id);
        if (Auth::user()->owns($diary)) {
            return view('diaries.edit', compact('diary'));
        }

        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreDiaryRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @internal param $StoreDiaryRequest
     */
    public function update(StoreDiaryRequest $request, $id)
    {
        $diary = $this->diary->byId($id);
        $tags = $this->diary->normalizeTag($request->get('tags'));
        $diary->update([
            'title' => $request->get('title'),
            'content' => $request->get('content'),
        ]);
        $diary->tags()->sync($tags);
        return redirect()->route('diary.show', [$diary->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
