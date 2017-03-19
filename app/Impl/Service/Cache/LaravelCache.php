<?php
/**
 * @link http://www.kyrieup.com/
 * @package LaravelCache.php
 * @author kyrie
 * @date: 2017/3/19 下午12:41
 */

namespace Impl\Service\Cache;


use Illuminate\Cache\CacheManager;

class LaravelCache implements CacheInterface
{
    protected $cache;
    protected $cacheKey;
    protected $minute;

    public function __construct(CacheManager $cache, $cacheKey, $minute = null)
    {
        $this->cache = $this->cache;
        $this->cacheKey = $cacheKey;
        $this->minute = $minute;
    }


    /**
     * @param string $key
     * @return mixed
     */
    public function get($key)
    {
        return $this->cache->tags($this->cacheKey)->get($key);
    }

    /**
     * @param string $key
     * @param mix $value
     * @param int $minute
     * @return mixed
     */
    public function put($key, $value, $minute = null)
    {
        if (is_null($minute)) {
            $minute = $this->minute;
        }

        return $this->cache->tags($this->cacheKey)->put($key, $value, $minute);
    }

    /**
     * @param string $key
     * @return bool
     */
    public function has($key)
    {
        return $this->cache->tags($this->cacheKey)->has($key);
    }
}