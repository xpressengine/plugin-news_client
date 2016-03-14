<?php
namespace Xpressengine\Plugins\NewsClient;

use Xpressengine\Skin\AbstractSkin;
use View;

class ManagerSkin extends AbstractSkin
{
    public function render()
    {
        return View::make(
            sprintf('%s::views.%s', 'news_client', $this->view),
            $this->data
        );
    }
}
