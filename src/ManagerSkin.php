<?php
/**
 * ManagerSkin.php
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

use Xpressengine\Skin\AbstractSkin;
use View;

/**
 * ManagerSkin
 *
 * @category    NewsClient
 * @package     Xpressengine\Plugins\NewsClient
 * @author      XE Developers <developers@xpressengine.com>
 * @copyright   2015 Copyright (C) NAVER <http://www.navercorp.com>
 * @license     http://www.gnu.org/licenses/old-licenses/lgpl-2.1.html LGPL-2.1
 * @link        http://www.xpressengine.com
 */
class ManagerSkin extends AbstractSkin
{
    /**
     * render
     *
     * @return \Illuminate\Contracts\Support\Renderable|\Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return View::make(
            sprintf('%s::views.%s', 'news_client', $this->view),
            $this->data
        );
    }
}
