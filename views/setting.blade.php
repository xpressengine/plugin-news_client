@section('page_title')
    <h2>환경정보 수집 동의 설정</h2>
@endsection

@section('page_description')
    <small>PC 환경정보 수집 동의 설정 페이지입니다.</small>
@stop

<div class="row">
    <div class="col-sm-12">
        <!--[D] accordion 효과 시 id값 accordion 추가 (기본 없음) -->
        <div class="panel-group" id="">
            <div class="panel">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h3 class="panel-title">설치 환경정보 수집 동의</h3>
                    </div>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in">
                    <form method="post" action="{{ route('manage.news_client.postSetting') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="panel-body">
                            <p class="text">
                                XpressEngine은 이용자의 개인정보를 중요시하며, 정보통신망 이용촉진 및 정보보호 등에 관한 법률,<br>개인정보보호법 등 개인정보 보호 법령을 준수합니다.
                            </p>
                            <div class="form-group">
                                <label>1. 수집하는 정보</label>
                                <div class="panel">
                                    <div class="panel-heading">
                                        <div class="pull-left">
                                            XE는 설치된 서버의 환경정보 일부를 XE 통계 수집 서버로 전송합니다.
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <label>수집하는 항목</label>
                                        <ul class="normal-list">
                                            <li>서버 OS</li>
                                            <li>Web Software(apache, nginx)</li>
                                            <li>PHP version 및 extension</li>
                                            <li>Database 종류 및 version</li>
                                            <li>설치된 Plugin 정보</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>2. 수집한 정보의 이용</label>
                                <div class="list-group-item">
                                    <p class="text">
                                        수집한 환경정보는 더 나은 소프트웨어를 제작하기 위한 목적으로 활용됩니다. <br>익명으로 수집되며 그 외의 목적으로 사용하거나 외부에 공개하지 않습니다.
                                    </p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>3. 환경정보 수집에 대한 동의 <small>(선택)</small></label>
                                <div class="list-group-item">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="agree" value="true" @if($agree) checked @endif>
                                            설치 환경정보 수집에 동의합니다.
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