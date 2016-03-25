

<div class="panel">
    <div class="panel-heading">
        <h3>News</h3>
    </div>
    <div class="panel-body">
        @if ($updatable)
            <div class="alert alert-info" role="alert">
                <strong>최신 버전이 아닙니다.</strong>
                <br />
                최신버전: [{{ $latest->version }}]
                현재버전: [{{ __XE_VERSION__ }}]
                <a href="#" class="alert-link">최신버전 보러가기</a>
            </div>
        @endif
        <table class="table">
            <thead>
            <tr>
                <th>Title</th>
                <th class="text-right">CreatedAt</th>
            </tr>
            </thead>
            <tbody>
            @forelse($news as $item)
                @if($item->type === 'link')
                <tr>
                    <td><a href="{{ $item->content }}" target="_blank">{{ $item->title }}</a></td>
                    <td class="text-right">{{ Carbon\Carbon::createFromTimestamp(strtotime($item->createdAt))->format('m.d H:i') }}</td>
                </tr>
                @else
                <tr role="button" data-toggle="collapse" data-target="#news_{{ $item->id }}">
                    <td>{{ $item->title }}</td>
                    <td class="text-right">{{ Carbon\Carbon::createFromTimestamp(strtotime($item->createdAt))->format('m.d H:i') }}</td>
                </tr>
                <tr class="active collapse" id="news_{{ $item->id }}">
                    <td colspan="2">{!! $item->content !!}</td>
                </tr>
                @endif
            @empty
                <tr>
                    <td colspan="2" class="text-center">새 소식이 없습니다</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
