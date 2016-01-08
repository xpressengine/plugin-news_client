

<div class="panel">
    <div class="panel-heading">
        <h3>News</h3>
    </div>
    <div class="panel-body">
        @if ($updatable)
            <div class="alert alert-info" role="alert">
                <strong>최신 버전이 아닙니다.</strong>
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
            @foreach($news as $item)
                <tr>
                    <td>{{ $item->title }}</td>
                    <td class="text-right">{{ $item->createdAt }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
