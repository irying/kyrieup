<?php
/**
 * @link http://www.kyrieup.com/
 * @package EloquentDiary.php
 * @author kyrie
 * @date: 2017/3/19 上午10:58
 */

namespace Impl\Repo\Diary;

use App\Diary;
use App\Tag;

class EloquentDiary implements DiaryInterface
{
    /**
     * @var Diary
     */
    protected $diary;
    /**
     * @var Tag
     */
    protected $tag;

    public function __construct(Diary $diary, Tag $tag)
    {
        $this->diary = $diary;
        $this->tag = $tag;
    }

    /**
     * @param $id
     * @return stdObject object of diary information
     */
    public function byId($id)
    {
        return $this->diary->find($id);
    }

    /**
     * @param $id
     * @return stdObject object of diary information
     */
    public function byIdWithTags($id)
    {
        return $this->diary->where('id', $id)->with('tags')->first();
    }

    /**
     * @param int $page
     * @param int $limit
     * @param bool $all
     * @return stdObject object with $items and $totalItems for pagination
     */
    public function byPage($page = 1, $limit = 10, $all = false)
    {
        $result = new \stdClass();
        $result->page = $page;
        $result->limit = $limit;
        $result->totalItems = 0;
        $result->items = array();

        $query = $this->diary->orderBy('created_at', 'desc');
        if (!$all) {
            $query->where('status', 'enabled');
        }

        $diaries = $query->skip($limit * ($page - 1))
            ->take($limit)
            ->get();
        $result->totalItems = $this->totalDiaries($all);
        $result->items = $diaries;

        return $result;
    }

    /**
     * @param $tag
     * @param int $page
     * @param int $limit
     * @return stdObject object with $items and $totalItems for pagination
     */
    public function byTag($tag, $page = 1, $limit = 10)
    {
        // TODO: Implement byTag() method.
    }

    /**
     * @param array $data
     * @return Diary|bool
     */
    public function create(array $data)
    {
        return $this->diary->create($data);
    }

    /**
     * @param array $data
     * @return boolean
     */
    public function update(array $data)
    {
        // TODO: Implement update() method.
    }

    /**
     * @param $all
     * @return int
     */
    protected function totalDiaries($all)
    {
        if (!$all) {
            return $this->diary->where('status', 'enabled')->count();
        }

        return $this->diary->count();
    }


    /**
     * @param array $tags
     * @return array
     */
    public function normalizeTag(array $tags)
    {
        return collect($tags)->map(function ($tag) {
            if (is_numeric($tag)) {
                $this->tag->find($tag)->increment('slug');
                return (int)$tag;
            }
            $newTag = $this->tag->create(['name' => $tag]);
            return $newTag->id;
        })->toArray();
    }

    /**
     * @return Diary
     */
    public function getLatest()
    {
        return $this->diary->enabled()->latest('updated_at')->with('user')->get();
    }

    /**
     * @param Diary $diary
     * @return bool|null
     */
    public function delete(Diary $diary)
    {
        return $diary->delete();
    }
}