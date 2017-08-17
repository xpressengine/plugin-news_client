<?php
namespace Xpressengine\Plugins\NewsClient;

use App\Http\Controllers\Controller;
use XePresenter;
use Xpressengine\Http\Request;

class ManagerController extends Controller
{
    public function __construct()
    {
        XePresenter::setSettingsSkinTargetId('news_client');
    }

    public function getSetting()
    {
        return XePresenter::make('setting', [
            'agree' => app('xe.news_client')->isAgree()
        ]);
    }

    public function postSetting(Request $request)
    {
        app('xe.news_client')->setAgree($request->has('agree'));

        return redirect()->route('news_client::setting')
            ->with('alert', ['type' => 'success', 'message' => '저장되었습니다.']);
    }
}
