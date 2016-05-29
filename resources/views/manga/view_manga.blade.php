<div class="content one-column">
    @if ($member_data['is_leader'])
        <div style="height: 30px">
            <a href="/manga/edit-manga/{{ $manga->id }}"><i class="fa fa-edit edit-button"></i></a>
        </div>
    @endif

    <div class="manga-cover">
        <div id="bookmark-icon" class="fave star {{ $is_bookmarked }}"
             onclick="bookmark('{{ $manga->id }}', '{!! csrf_token() !!}')"></div>
        <div class="blur-layer"></div>
        <div class="banner" style="background-image: url('/images/storage/manga/banners/{{ $manga->id }}.jpg')"></div>
        <div class="cover" style="background-image: url('/images/storage/manga/covers/{{ $manga->id }}.jpg')"></div>
        <div class="meta">
            <div class="meta-main">
                <h3>{{ $manga->name }}</h3>

                <p>{{ $manga->views }} views</p>
            </div>
            <div class="meta-hidden"><h3>{{ $manga->name }}</h3></div>
        </div>
        <div class="button-container">
            @if ($member_data['is_leader'])
                <a href="/manga/add-chapter/{{ $manga->id }}" class="shiny-button view-chapter-btn">Add Chapter</a>
            @endif
            <div id="poke" class="shiny-button view-chapter-btn">Poke Us</div>
        </div>
    </div>

    <div class="manga-details">
        <p>Author: <span>{{ $manga->author }}</span></p>

        <p>Other name: <span>{{ $manga->other_name }}</span></p>

        <p>Genres:
            <span>{{ $manga->genres->isEmpty() ? "N/A" : separatedByComma($manga->genres->lists('name')) }}</span></p>

        <p>Status: <span>{{ $manga->status }}</span></p>

        <p>Language Available: <span>Japanese, English</span></p>

        <p style="margin-bottom: 5px">Summary:</p><span>{{ $manga->summary }}</span>

        <p>Chapters:</p>
        @forelse ($manga->chapters as $chapter)
            @if ($chapter->active == 1 || $member_data['is_member'])
                <div class="chapter-block">
                    <a href="/manga/{{ $manga->clean_url }}/chapter-{{ $chapter->chapter_number }}/5-1">
                        <span>Chapter {{ $chapter->chapter_number }}: </span>
                        <span>{{ $chapter->description }}</span>
                    </a>
                    <a class="edit-button-chapter" href="/manga/edit-chapter/{{ $chapter->id }}">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a class="edit-button-chapter" href="/manga/edit-images/{{ $chapter->id }}/1">
                        <i class="fa fa-picture-o"></i>
                    </a>
                </div>
            @endif
        @empty
            <div>No chapter available</div>
        @endforelse
    </div>
    <!-- <div class="fb-comments" data-width="100%" data-numposts="5"></div> -->
</div>

@include('elements/sidebar')

