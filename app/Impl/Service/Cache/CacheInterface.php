<?php
/**
 * @link http://www.kyrieup.com/
 * @package CacheInterface.php
 * @author kyrie
 * @date: 2017/3/19 下午12:38
 */

namespace Impl\Service\Cache;

interface CacheInterface
{
    /**
     * @param string $key
     * @return mixed
     */
    public function get($key);

    /**
     * @param string $key
     * @param mix $value
     * @param int $minute
     * @return mixed
     */
    public function put($key, $value, $minute = null);

    /**
     * @param string $key
     * @return bool
     */
    public function has($key);
}