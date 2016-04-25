@section('page_title')
    <h2>{{ xe_trans('news_client::collectEnv.title') }}</h2>
@endsection

@section('page_description')
    <small>{{ xe_trans('news_client::collectEnv.description') }}</small>
@stop

<div class="row">
    <div class="col-sm-12">
        <!--[D] accordion 효과 시 id값 accordion 추가 (기본 없음) -->
        <div class="panel-group" id="">
            <div class="panel">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h3 class="panel-title">{{ xe_trans('news_client::collectEnv.subTitle') }}</h3>
                    </div>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in">
                    <form method="post" action="{{ route('manage.news_client.postSetting') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="panel-body">
                            <p class="text">
                                {!! xe_trans('news_client::collectEnv.compliance') !!}
                            </p>
                            <div class="form-group">
                                <label>1. {{ xe_trans('news_client::collectEnv.collectItemStep') }}</label>
                                <div class="panel">
                                    <div class="panel-heading">
                                        <div class="pull-left">
                                            {{ xe_trans('news_client::collectEnv.msgCollect') }}
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <label>{{ xe_trans('news_client::collectEnv.collectItem') }}</label>
                                        <ul class="normal-list">
                                            <li>{{ xe_trans('news_client::collectEnv.items.serverOS') }}</li>
                                            <li>{{ xe_trans('news_client::collectEnv.items.webSoftware') }}</li>
                                            <li>{{ xe_trans('news_client::collectEnv.items.PHPs') }}</li>
                                            <li>{{ xe_trans('news_client::collectEnv.items.database') }}</li>
                                            <li>{{ xe_trans('news_client::collectEnv.items.plugins') }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>2. {{ xe_trans('news_client::collectEnv.usedInfoStep') }}</label>
                                <div class="list-group-item">
                                    <p class="text">
                                        {!! xe_trans('news_client::collectEnv.purposeAndPrivate') !!}
                                    </p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>3. {{ xe_trans('news_client::collectEnv.agreeStep') }} <small>({{ xe_trans('xe::select') }})</small></label>
                                <div class="list-group-item">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="agree" value="true" @if($agree) checked @endif>
                                            {{ xe_trans('news_client::collectEnv.msgAgree') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <div class="pull-right">
                                <button type="submit" class="btn btn-primary">{{ xe_trans('xe::save') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>