<?php
namespace Xpressengine\Plugins\NewsClient;

use Xpressengine\Skin\GenericSkin;

class NewsWidgetSkin extends GenericSkin
{
    /**
     * @var string
     */
    protected static $path = 'news_client.views';

    /**
     * @var string
     */
    protected static $viewDir = '';

    protected static $info = [
        'support' => [
            'mobile' => true,
            'desktop' => true
        ]
    ];

}
