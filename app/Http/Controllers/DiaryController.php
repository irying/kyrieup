<?php

namespace App\Http\Controllers;

use App\Diary;
use App\Http\Requests\StoreDiaryRequest;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
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
        return 'index';
        $page = Input::get('page', 1);
        $perPage = 10;
        $pageData = $this->diary->byPage($page, $perPage);
        $diaries = new LengthAwarePaginator($pageData->items, $pageData->totalItems, $perPage);

        return view('home', $diaries);
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
        $tags = $this->normalizeTag($request->get('tags'));
        $data = [
            'title' => $request->get('title'),
            'content' => $request->get('content'),
            'user_id' => Auth::id(),
        ];
        $diary = Diary::create($data);
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
//        var_dump($diary);die;
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

    /**
     * @param array $tags
     * @return array
     */
    protected function normalizeTag(array $tags)
    {
        return collect($tags)->map(function ($tag) {
            if (is_numeric($tag)) {
                Tag::find($tag)->increment('slug');
                return (int)$tag;
            }
            $newTag = Tag::create(['name' => $tag]);
            return $newTag->id;
        })->toArray();
    }
}
