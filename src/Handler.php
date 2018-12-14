<?php
/**
 * Handler.php
 *
 * This file is part of the Xpressengine package.
 *
 * PHP version 7
 *
 * @category    NewsClient
 * @package     Xpressengine\Plugins\NewsClient
 * @author      XE Developers <developers@xpressengine.com>
 * @copyright   2015 Copyright (C) NAVER <http://www.navercorp.com>
 * @license     http://www.gnu.org/licenses/old-licenses/lgpl-2.1.html LGPL-2.1
 * @link        http://www.xpressengine.com
 */

namespace Xpressengine\Plugins\NewsClient;

use Illuminate\Contracts\Cache\Repository as CacheContract;
use Illuminate\Database\DatabaseManager;
use Illuminate\Http\Request;
use PDO;
use Xpressengine\Config\ConfigManager;
use Xpressengine\Plugin\PluginEntity;
use Xpressengine\Plugin\PluginHandler;
use GuzzleHttp\Client;

/**
 * Handler
 *
 * @category    NewsClient
 * @package     Xpressengine\Plugins\NewsClient
 * @author      XE Developers <developers@xpressengine.com>
 * @copyright   2015 Copyright (C) NAVER <http://www.navercorp.com>
 * @license     http://www.gnu.org/licenses/old-licenses/lgpl-2.1.html LGPL-2.1
 * @link        http://www.xpressengine.com
 */
class Handler
{
    protected $cache;

    protected $configs;

    protected $plugins;

    protected $db;

    protected $request;

    protected $domain = 'http://news.xpressengine.io';

    protected $cacheKey = 'news_client::report';
    protected $configKey = 'news_client';

    protected $interval = 60;   // minute

    /**
     * Handler constructor.
     *
     * @param CacheContract   $cache   cache contract
     * @param ConfigManager   $configs config manager
     * @param PluginHandler   $plugins plugin handler
     * @param DatabaseManager $db      db manager
     * @param Request         $request request
     */
    public function __construct(
        CacheContract $cache,
        ConfigManager $configs,
        PluginHandler $plugins,
        DatabaseManager $db,
        Request $request
    ) {
        $this->cache = $cache;
        $this->configs = $configs;
        $this->plugins = $plugins;
        $this->db = $db;
        $this->request = $request;
    }

    /**
     * get data
     *
     * @return mixed
     * @throws \Exception
     */
    public function getData()
    {
        if (!$this->cache->has($this->cacheKey)) {
            $this->cache->put($this->cacheKey, true, $this->interval);
            $this->sendCoreVersion();

            if ($this->isAgree()) {
                $this->sendInformation();
            }
        }

        return $this->getNewsData();
    }

    /**
     * send core version
     *
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function sendCoreVersion()
    {
        $client = $this->makeClient();

        $response = $client->request('post', $this->url('news'), [
            'headers' => [
                'REQUESTURL' => $this->request->root()
            ],
            'form_params' => [
                'package' => 'XE',
                'version' => __XE_VERSION__,
//                'location' => 'ko'
            ]
        ]);

        if ($response->getStatusCode() != 200) {
            throw new \Exception;
        }
    }

    /**
     * get news data
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function getNewsData()
    {
        $client = $this->makeClient();
        $response = $client->request('get', $this->url('news'));

        return json_decode($response->getBody());
    }

    /**
     * url
     *
     * @param string $page page
     *
     * @return string
     */
    protected function url($page)
    {
        return rtrim($this->domain, '/') . '/' . $page;
    }

    /**
     * make client
     *
     * @return Client
     */
    protected function makeClient()
    {
        return new Client();
    }

    /**
     * get config
     *
     * @return \Xpressengine\Config\ConfigEntity
     */
    public function getConfig()
    {
        return $this->configs->get($this->configKey);
    }

    /**
     * check is agree
     *
     * @return mixed
     */
    public function isAgree()
    {
        return $this->configs->getVal($this->configKey . '.collectAgree');
    }

    /**
     * set agree
     *
     * @param bool $bool set agree value
     *
     * @return void
     */
    public function setAgree($bool = true)
    {
        $this->configs->setVal($this->configKey . '.collectAgree', $bool);
    }

    /**
     * send information
     *
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function sendInformation()
    {
        $os = $this->getOS();
        $php = $this->getPHP();
        $db = $this->getDB();

        $client = $this->makeClient();

        $response = $client->request('post', $this->url('envs'), [
            'headers' => [
                'REQUESTURL' => $this->request->root()
            ],
            'form_params' => [
                'os_name' => $os['name'],
                'os_release' => $os['release'],
                'os_version' => $os['version'],
                'http' => $this->getHttp(),
                'php_version' => $php['version'],
                'php_version_id' => $php['versionId'],
                'php_extensions' => $php['extensions'],
                'db_driver' => $db['driver'],
                'db_version' => $db['version'],
                'plugins' => $this->getPlugin()
            ]
        ]);

        if ($response->getStatusCode() != 200) {
            throw new \Exception;
        }
    }

    /**
     * get os
     *
     * @return array
     */
    protected function getOS()
    {
        return [
            'name' => php_uname('s'),
            'release' => php_uname('r'),
            'version' => php_uname('v')
        ];
    }

    /**
     * get http
     *
     * @return array|string
     */
    protected function getHttp()
    {
        return $this->request->server('SERVER_SOFTWARE');
    }

    /**
     * get php info
     *
     * @return array
     */
    protected function getPHP()
    {
        return [
            'version' => phpversion(),
            'versionId' => defined('PHP_VERSION_ID') ? constant('PHP_VERSION_ID') : call_user_func(function () {
                $version = explode('.', phpversion());

                return $version[0] * 10000 + $version[1] * 100 + $version[2];
            }),
            'extensions' => implode(',', array_map(function ($ext) {
                return strtolower($ext);
            }, get_loaded_extensions()))
        ];
    }

    /**
     * get db info
     *
     * @return array
     */
    protected function getDB()
    {
        /** @var PDO $pdo */
        $pdo = $this->db->getPdo();

        return [
            'driver' => $pdo->getAttribute(PDO::ATTR_DRIVER_NAME),
            'version' => $pdo->getAttribute(PDO::ATTR_SERVER_VERSION)
        ];
    }

    /**
     * get plugin
     *
     * @return array
     */
    protected function getPlugin()
    {
        $plugins = [];
        $collection = $this->plugins->getAllPlugins(true);
        /** @var PluginEntity $plugin */
        foreach ($collection as $plugin) {
            $plugins[$plugin->getId()] = [
                'version' => $plugin->getInstalledVersion(),
                'activated' => $plugin->isActivated()
            ];
        }

        return $plugins;
    }
}
