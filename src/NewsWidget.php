<?php
namespace Xpressengine\Plugins\NewsClient;

use XeFrontend;
use Xpressengine\Widget\AbstractWidget;

class NewsWidget extends AbstractWidget
{
    protected static $id = 'widget/news_client@news';

    /**
     * init
     *
     * @return mixed
     */
    protected function init()
    {
        //
    }

    /**
     * getCodeCreationForm
     *
     * @return mixed
     */
    public function getCodeCreationForm()
    {
        //
    }

    /**
     * render
     *
     * @return mixed
     */
    public function render()
    {
        $data = app('xe.news_client')->getData();

        $updatable = $this->needUpdate((array)$data->version);

        XeFrontend::css('plugins/news_client/assets/style.css')->before('assets/settings/css/admin.css')->load();

        return $this->renderSkin(
            [
                'updatable' => $updatable,
                'latest' => $data->version,
                'news' => $data->news
            ]
        );
    }

    protected function needUpdate(array $latest)
    {
        return 1 === version_compare($latest['version'], __XE_VERSION__);
    }
}
