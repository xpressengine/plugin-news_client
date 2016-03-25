<?php
namespace Xpressengine\Plugins\NewsClient;

use App\Http\Controllers\Controller;
use XePresenter;
use Xpressengine\Http\Request;

class ManagerController extends Controller
{
    protected $handler;

    public function __construct()
    {
        XePresenter::setSettingsSkinTargetId('news_client');
        $this->handler = app('xe.plugin.news_client')->getHandler();
    }

    public function getSetting()
    {
        return XePresenter::make('setting', [
            'agree' => $this->handler->isAgree()
        ]);
    }

    public function postSetting(Request $request)
    {
        $this->handler->setAgree($request->has('agree'));

        return redirect()->route('manage.news_client.getSetting')
            ->with('alert', ['type' => 'success', 'message' => '저장되었습니다.']);
    }
}
