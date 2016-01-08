<?php
namespace Xpressengine\Plugins\NewsClient;

use Xpressengine\Config\ConfigManager;
use Xpressengine\Support\CacheInterface;
use GuzzleHttp\Client;

class Handler
{
    protected $cache;

    protected $configs;

    protected $url = 'http://newsxe.app/';

    protected $cacheKey = 'news_client::report';
    protected $configKey = 'news_client';

    protected $interval = 60;   // minute

    public function __construct(CacheInterface $cache, ConfigManager $configs)
    {
        $this->cache = $cache;
        $this->configs = $configs;
    }

    public function getData()
    {
        $agree = $this->configs->getVal($this->configKey . '.collectAgree');
        if ($agree && !$this->cache->has($this->cacheKey)) {
            $this->cache->put($this->cacheKey, true, $this->interval);
            $this->sendInformation();
        }

        return $this->getNewsData();
    }

    protected function sendInformation()
    {
        $client = $this->makeClient();

        $response = $client->request('post', $this->url, [
            'headers' => [
                'REQUESTURL' => app('request')->root()
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

    protected function getNewsData()
    {
        $client = $this->makeClient();
        $response = $client->request('get', $this->url);

        return json_decode($response->getBody());
    }

    protected function makeClient()
    {
        return new Client();
    }

}
