<?php
namespace Xpressengine\Plugins\NewsClient;

use Frontend;
use Presenter;
use Route;
use Xpressengine\Plugin\AbstractPlugin;
use Xpressengine\Support\LaravelCache;

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

        app()->bind('xe.plugin.news_client', function () {
            return $this;
        });
    }

    protected function route()
    {
        Route::settings($this->getId(), function () {
            Route::get('setting', ['as' => 'manage.news_client.getSetting', 'uses' => 'ManagerController@getSetting']);
            Route::post('setting', ['as' => 'manage.news_client.postSetting', 'uses' => 'ManagerController@postSetting']);
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
    }

    /**
     * 플러그인을 설치한다. 플러그인이 설치될 때 실행할 코드를 여기에 작성한다
     *
     * @return void
     */
    public function install()
    {
        //
    }

    /**
     * 해당 플러그인이 설치된 상태라면 true, 설치되어있지 않다면 false를 반환한다.
     * 이 메소드를 구현하지 않았다면 기본적으로 설치된 상태(true)를 반환한다.
     *
     * @param string $installedVersion 이 플러그인의 현재 설치된 버전정보
     *
     * @return boolean 플러그인의 설치 유무
     */
    public function checkInstalled($installedVersion = null)
    {
        // implement code

        return parent::checkInstalled($installedVersion);
    }

    /**
     * 플러그인을 업데이트한다.
     *
     * @param string|null $installedVersion 현재 XpressEngine에 설치된 플러그인의 버전정보
     *
     * @return void
     */
    public function update($installedVersion = null)
    {
        //
    }

    /**
     * 플러그인의 설정페이지 주소를 반환한다.
     * 플러그인 목록에서 플러그인의 '관리' 버튼을 누를 경우 이 페이지에서 반환하는 주소로 연결된다.
     *
     * @return string
     */
    public function getSettingsURI()
    {
        return route('manage.news_client.getSetting');
    }

    public function getHandler()
    {
        if (!$this->handler) {
            $this->handler = new Handler(
                new LaravelCache(app('cache.store')),
                app('xe.config'),
                app('xe.plugin'),
                app('db'),
                app('request')
            );
        }

        return $this->handler;
    }
}
