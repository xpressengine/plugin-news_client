<?php
/**
 * NewsWidget.php
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

use XeFrontend;
use Xpressengine\Widget\AbstractWidget;

/**
 * NewsWidget
 *
 * @category    NewsClient
 * @package     Xpressengine\Plugins\NewsClient
 * @author      XE Developers <developers@xpressengine.com>
 * @copyright   2015 Copyright (C) NAVER <http://www.navercorp.com>
 * @license     http://www.gnu.org/licenses/old-licenses/lgpl-2.1.html LGPL-2.1
 * @link        http://www.xpressengine.com
 */
class NewsWidget extends AbstractWidget
{
    protected static $id = 'widget/news_client@news';

    /**
     * init
     *
     * @return void
     */
    protected function init()
    {
    }

    /**
     * getCodeCreationForm
     *
     * @return void
     */
    public function getCodeCreationForm()
    {
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

        XeFrontend::css('plugins/news_client/assets/style.css')->before('assets/core/settings/css/admin.css')->load();

        return $this->renderSkin(
            [
                'updatable' => $updatable,
                'latest' => $data->version,
                'news' => $data->news
            ]
        );
    }

    /**
     * check need update
     *
     * @param array $latest latest
     *
     * @return bool
     */
    protected function needUpdate(array $latest)
    {
        return 1 === version_compare($latest['version'], __XE_VERSION__);
    }
}
