<?php


namespace Impl\Repo\Diary;


interface DiaryInterface
{
    /**
     * @param $id
     * @return stdObject object of diary information
     */
    public function byId($id);

    /**
     * @param int $page
     * @param int $limit
     * @param bool $all
     * @return stdObject object with $items and $totalItems for pagination
     */
    public function byPage($page = 1, $limit = 10, $all = false);

    /**
     * @param $tag
     * @param int $page
     * @param int $limit
     * @return stdObject object with $items and $totalItems for pagination
     */
    public function byTag($tag, $page = 1, $limit = 10);

    /**
     * @param array $data
     * @return boolean
     */
    public function create(array $data);

    /**
     * @param array $data
     * @return boolean
     */
    public function update(array $data);
}