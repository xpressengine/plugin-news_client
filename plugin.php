<?php
namespace Xpressengine\Plugins\NewsClient;

use Frontend;
use Presenter;
use Route;
use XeLang;
use Xpressengine\Plugin\AbstractPlugin;

class Plugin extends AbstractPlugin
{
    protected $handler;

    /**
     * 이 메소드는 활성화(activate) 된 플러그인이 부트될 때 항상 실행됩니다.
     *
     * @return void
     */
    public function boot()
    {
        // implement code
        $this->route();

        $register = app('xe.pluginRegister');
        $register->add(NewsWidget::class);
    }

    public function register()
    {
        app()->bind('xe.plugin.news_client', function () {
            return $this;
        });
        app()->singleton(Handler::class, function ($app) {
            return new Handler(
                $app['cache.store'],
                $app['xe.config'],
                $app['xe.plugin'],
                $app['db'],
                $app['request']
            );
        });
        app()->alias(Handler::class, 'xe.news_client');
    }

    protected function route()
    {
        Route::settings($this->getId(), function () {
            Route::group(['prefix' => 'setting', 'as' => 'news_client::setting'], function () {
                Route::get('/', 'ManagerController@getSetting');
                Route::post('/', 'ManagerController@postSetting');
            });
        }, ['namespace' => __NAMESPACE__]);
    }

    /**
     * 플러그인이 활성화될 때 실행할 코드를 여기에 작성한다.
     *
     * @param string|null $installedVersion 현재 XpressEngine에 설치된 플러그인의 버전정보
     *
     * @return void
     */
    public function activate($installedVersion = null)
    {
        if (!$this->getHandler()->getConfig()) {
            $this->getHandler()->setAgree(false);
        }

        XeLang::putFromLangDataSource('news_client', base_path('plugins/news_client/langs/lang.php'));
    }

    /**
     * 플러그인의 설정페이지 주소를 반환한다.
     * 플러그인 목록에서 플러그인의 '관리' 버튼을 누를 경우 이 페이지에서 반환하는 주소로 연결된다.
     *
     * @return string
     */
    public function getSettingsURI()
    {
        return route('news_client::setting');
    }

    public function getHandler()
    {
        return app(Handler::class);
    }
}
