<div class="chapter-toolbar">
    <div class="inline-block">
        <select class="chapter-list">
            @foreach($manga->chapters as $chapter)
                <option value="{{ $chapter->chapter_number }}" {{ $chapter->chapter_number == $pagination['currentChap'] ? 'selected' : '' }}>
                    Chapter {{ $chapter->chapter_number }}: {{ $chapter->description }}
                </option>
            @endforeach
        </select>

        <select class="read-mode" data-limit="{{ $pagination['limit'] }}">
            <option value="1">Load 1 image</option>
            <option value="5">Load 5 images</option>
            <option value="10">Load 10 images</option>
            <option value="0">Load all images</option>
        </select>
    </div>

    <div class="inline-block">
        <div class="btn-control-container">
            {!! chapterPagination($pagination, $manga->clean_url) !!}
        </div>
    </div>
</div>