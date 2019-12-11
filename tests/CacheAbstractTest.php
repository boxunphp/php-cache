<?php
/**
 * Created by PhpStorm.
 * User: Jordy
 * Date: 2019/12/10
 * Time: 4:15 PM
 */

namespace TestCache;

use Ali\InstanceTrait;
use All\Cache\Cache;
use All\Cache\CacheAbstract;
use PHPUnit\Framework\TestCase;

class CacheAbstractTest extends TestCase
{
    public function testCacheConfig()
    {
        $cache = CacheConfig::getInstance();

        $k1 = 'a';
        $k2 = 'b';
        $v1 = 1;
        $v2 = 2;
        $this->assertTrue($cache->set($k1, $v1));
        $this->assertEquals($v1, $cache->get($k1));
        $this->assertTrue($cache->delete($k1));
        $data = [$k1 => $v1, $k2 => $v2];
        $this->assertTrue($cache->setMulti($data));
        $this->assertEquals($data, $cache->getMulti([$k1, $k2]));
        $this->assertTrue($cache->deleteMulti([$k1, $k2]));
    }

    public function testCacheFile()
    {
        $cache = CacheFile::getInstance();

        $k1 = 'a';
        $k2 = 'b';
        $v1 = 1;
        $v2 = 2;
        $this->assertTrue($cache->set($k1, $v1));
        $this->assertEquals($v1, $cache->get($k1));
        $this->assertTrue($cache->delete($k1));
        $data = [$k1 => $v1, $k2 => $v2];
        $this->assertTrue($cache->setMulti($data));
        $this->assertEquals($data, $cache->getMulti([$k1, $k2]));
        $this->assertTrue($cache->deleteMulti([$k1, $k2]));
    }
}

class CacheConfig extends CacheAbstract
{
    protected $cacheType = Cache::TYPE_MEMCACHED;
    protected $cacheConfig = [
        'servers' => [
            ['host' => 'memcached-11211', 'port' => 11211]
        ],
        'connect_timeout' => 1000
    ];
    protected $cachePrefixKey = 'testc';
    protected $cacheTTL = 10;
}

class CacheFile extends CacheAbstract
{
    protected $cacheType = Cache::TYPE_MEMCACHED;
    protected $cacheConfigPath = __DIR__ . '/config';
    protected $cacheConfigKey = 'memcache';
    protected $cachePrefixKey = 'testb';
    protected $cacheTTL = 20;
}