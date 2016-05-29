<div class="content one-column">
    <input id="bookmark-token" type="hidden" value="{{ csrf_token() }}"/>

    <h3>Bookmarks</h3>

    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th style="min-width: 109px">Latest</th>
            <th style="min-width: 102px">Release</th>
            <th></th>
        </tr>
        </thead>

        <tbody>
        @forelse ($user->bookmarks as $key => $bookmark)
            <tr>
                <td>{{ $key + 1 }}</td>

                <td>
                            <span class="tooltip tooltip-effect-1">
                                <span class="tooltip-item"><a
                                            href="/manga/{{ $bookmark->manga->clean_url }}">{{ $bookmark->manga->name }}</a></span>
                                <span class="tooltip-content clearfix">
                                    <img src="/images/storage/covers/{{ $bookmark->manga->id }}.jpg"/>
                                    <span class="tooltip-text">{{ $bookmark->manga->summary }}</span>
                                </span>
                            </span>
                </td>

                <td>
                    <a href="{{ isset($bookmark->manga->latestChapter)
                                ? '/manga/'.$bookmark->manga->clean_url.'/chapter-'.$bookmark->manga->latestChapter->chapter_number
                                : '' }}">
                        Chapter {{ $bookmark->manga->latestChapter['chapter_number'] or 0 }}
                    </a>
                </td>

                <td>
                    {{ isset($bookmark->manga->latestChapter)
                    ? $bookmark->manga->latestChapter->created_at->format('d-m-Y')
                    : 'N/A' }}
                </td>

                <td><i class="fa fa-times remove-bookmark" data-bookmark-id="{{ $bookmark->id }}"
                       title="remove {{ $bookmark->manga->name }}"></i></td>
            </tr>
        @empty
            <tr>
                <td colspan="5" style="text-align: center">N/A</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

@include('elements/sidebar')
