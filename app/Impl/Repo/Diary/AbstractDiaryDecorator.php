<?php
/**
 * @link http://www.kyrieup.com/
 * @package AbstractDiaryDecorator.php
 * @author kyrie
 * @date: 2017/3/19 上午11:56
 */

namespace Impl\Repo\Diary;


class AbstractDiaryDecorator implements DiaryInterface
{

    protected $nextDiary;

    public function __construct(DiaryInterface $nextDiary)
    {
        $this->nextDiary = $nextDiary;
    }
    /**
     * @param $id
     * @return stdObject object of diary information
     */
    public function byId($id)
    {
        $this->nextDiary->byId($id);
    }

    /**
     * @param int $page
     * @param int $limit
     * @param bool $all
     * @return stdObject object with $items and $totalItems for pagination
     */
    public function byPage($page = 1, $limit = 10, $all = false)
    {
        $this->nextDiary->byPage($page, $limit, $all);
    }

    /**
     * @param $tag
     * @param int $page
     * @param int $limit
     * @return stdObject object with $items and $totalItems for pagination
     */
    public function byTag($tag, $page = 1, $limit = 10)
    {
        $this->nextDiary->byTag($tag, $page, $limit);
    }

    /**
     * @param array $data
     * @return boolean
     */
    public function create(array $data)
    {
        $this->nextDiary->create($data);
    }

    /**
     * @param array $data
     * @return boolean
     */
    public function update(array $data)
    {
        $this->nextDiary->update($data);
    }
}