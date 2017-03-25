<?php
/**
 * @link http://www.kyrieup.com/
 * @package EloquentTag.php
 * @author kyrie
 * @date: 2017/3/25 上午10:36
 */

namespace Impl\Repo\Tag;

use App\Tag;

class EloquentTag implements TagInterface
{
    /**
     * @var Tag
     */
    protected $tag;

    public function __construct(Tag $tag)
    {
        $this->tag = $tag;
    }

    /**
     * @param array $data
     * @return Tag
     */
    public function create(array $data)
    {
        return $this->tag->create($data);
    }
}