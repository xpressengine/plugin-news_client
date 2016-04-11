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
                    <h4>XE가 설치된 서버의 환경정보 일부가 XE 통계 수집 서버로 전송됩니다. 더 나은 SW를 제작하기 위한 목적으로 활용합니다. 익명으로 수집되며 이 정보를 외부에 공개하지 않습니다. </h4>
                    <strong>이 항목에 동의하지 않아도 됩니다.</strong>
                    <br />
                    <br />
                    <strong>수집하는 항목:</strong><br />
                    * 서버 OS<br />
                    * web software (apache, nginx)<br />
                    * php version 및 extension<br />
                    * database 종류 및 버전<br />
                    * 설치된 플러그인 정보<br />
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="agree" value="true" @if($agree) checked @endif>
                        <strong>설치 환경 수집에 동의합니다.</strong>
                    </label>
                </div>
            </div>


        </div>
    </div>
    <div class="btn_group_all">
        <button type="submit" class="btn btn_blue">{{ xe_trans('xe::save') }}</button>
    </div>
</form>