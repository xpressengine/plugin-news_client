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
 * @copyright   2019 Copyright XEHub Corp. <https://www.xehub.io>
 * @license     http://www.gnu.org/licenses/lgpl-3.0-standalone.html LGPL
 * @link        https://xpressengine.io
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
 * @copyright   2019 Copyright XEHub Corp. <https://www.xehub.io>
 * @license     http://www.gnu.org/licenses/lgpl-3.0-standalone.html LGPL
 * @link        https://xpressengine.io
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
