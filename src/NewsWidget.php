<?php
namespace Xpressengine\Plugins\NewsClient;

use Xpressengine\Widget\AbstractWidget;
use View;
use XeFrontend;

class NewsWidget extends AbstractWidget
{
    protected static $id = 'widget/news_client@news';

    /**
     * @var Handler
     */
    protected $plugin;

    /**
     * init
     *
     * @return mixed
     */
    protected function init()
    {
        $this->plugin = app('xe.plugin.news_client');
    }

    /**
     * getCodeCreationForm
     *
     * @return mixed
     */
    public function getCodeCreationForm()
    {
        // TODO: Implement getCodeCreationForm() method.
    }

    /**
     * render
     *
     * @param array $args to render parameter array
     *
     * @return mixed
     */
    public function render(array $args)
    {
        $data = $this->plugin->getHandler()->getData();

        $updatable = $this->needUpdate((array)$data->version);

        XeFrontend::css($this->plugin->asset('assets/style.css'))->before('assets/settings/css/admin.css')->load();

        return View::make('news_client::views.widget', [
            'updatable' => $updatable,
            'latest' => $data->version,
            'news' => $data->news
        ]);
    }

    protected function needUpdate(array $latest)
    {
        return $latest['versionId'] > $this->versionId(__XE_VERSION__);
    }

    private function versionId($version)
    {
        $version = explode('.', $version);

        return $version[0] * 10000 + $version[1] * 100 + $version[2];
    }
}
