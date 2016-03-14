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
                <label>정보 수집 동의</label>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="agree" value="true" @if($agree) checked @endif> Agree
                    </label>
                </div>
            </div>


        </div>
    </div>
    <div class="btn_group_all">
        <button type="submit" class="btn btn_blue">{{ xe_trans('xe::save') }}</button>
    </div>
</form>