<?php
/**
 * @link http://www.kyrieup.com/
 * @package CacheDecorator.php
 * @author kyrie
 * @date: 2017/3/19 下午12:15
 */

namespace Impl\Repo\Diary;


use Impl\Service\Cache\CacheInterface;

class CacheDecorator extends AbstractDiaryDecorator
{
    protected $cache;

    public function __construct(DiaryInterface $nextDiary, CacheInterface $cache)
    {
        parent::__construct($nextDiary);
        $this->cache = $cache;
    }

    /**
     * @param $id
     * @return stdObject|mixed
     */
    public function byId($id)
    {
        $key = md5('id.' . $id);
        if ($this->cache->has($key)) {
            return $this->cache->get($key);
        }

        $diary = $this->nextDiary->byId($id);
        $this->cache->put($key, $diary);

        return $diary;
    }

    /**
     * @param int $page
     * @param int $limit
     * @param bool $all
     * @return stdObject|mixed
     */
    public function byPage($page = 1, $limit = 10, $all = false)
    {
        $allKey = ($all) ? '.all' : '';
        $key = md5('page.' . $page .'.'. $limit.$allKey);
        if ($this->cache->has(($key))) {
            return $this->cache->get($key);
        }

        $paginated = $this->nextDiary->byPage($page, $limit);
        $this->cache->put($key, $paginated);

        return $paginated;
    }
}