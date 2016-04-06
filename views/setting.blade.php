@section('page_title')
    <h2>환경정보 수집 동의 설정</h2>
@endsection

@section('page_description')
@stop

<form method="post" action="{{ route('manage.news_client.postSetting') }}">
    <div class="panel admin_card">
        <div class="panel-body card_cont">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group">
                <div class="well">
                    <h4>XE가 설치된 서버의 환경정보 일부를 디버깅 목적으로 수집하며, 이 과정에서 개인정보는 수집되지 않습니다.</h4>
                    <br />
                    <br />
                    <strong>수집하는 항목:</strong><br />
                    * 서버 OS<br />
                    * http software (apache, nginx)<br />
                    * php version 및 extension 목록<br />
                    * database 종류 및 버전<br />
                    * 설치된 플러그인 정보<br />
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="agree" value="true" @if($agree) checked @endif>
                        <strong>시스템 환경정보 수집에 동의합니다.</strong>
                    </label>
                </div>
            </div>


        </div>
    </div>
    <div class="btn_group_all">
        <button type="submit" class="btn btn_blue">{{ xe_trans('xe::save') }}</button>
    </div>
</form>