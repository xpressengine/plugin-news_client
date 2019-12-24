

<div class="panel">
    <div class="panel-heading">
        <h3>News</h3>
    </div>
    <div class="panel-body">
        <table class="table">
            <thead>
            <tr>
                <th>{{ xe_trans('xe::title') }}</th>
                <th class="text-right">{{ xe_trans('xe::createdAt') }}</th>
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
