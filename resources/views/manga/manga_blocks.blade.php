@foreach ($mangas as $manga)
    <div class="my-grid grid-5 manga-grid" >
        <div class="manga-image">
            <a href="/manga/{{ $manga->clean_url }}" title="{{ $manga->name }}">
                <img src="/images/storage/manga/banners/{{ $manga->id }}.jpg"/>
				<div class="svg-cross">
                    <svg width="220" height="70">
                        <line class="top-left" x1="0" y1="0" x2="-10" y2="-10"/>
                        <line class="bottom-left" x1="0" y1="70" x2="-10" y2="80"/>
                        <line class="bottom-right" x1="220" y1="70" x2="230" y2="80"/>
                        <line class="top-right" x1="220" y1="0" x2="230" y2="-10"/>
                    </svg>
                    <div class="svg-straight">
                        <svg width="200" height="50">
                            <line class="top" x1="0" y1="0" x2="600" y2="0"/>
                            <line class="left" x1="0" y1="50" x2="0" y2="-100"/>
                            <line class="bottom" x1="200" y1="50" x2="-400" y2="50"/>
                            <line class="right" x1="200" y1="0" x2="200" y2="150"/>
                        </svg>
                    </div>
                </div>
            </a>
            <div class="lang-tag-con">
                <div class="lang-tag">JP</div>
                <div class="lang-tag">EN</div>
            </div>
        </div>

        <div class="manga-description">
            <div class="manga-cat">
                <ul>
                    @foreach ($manga->genres as $genre)
                        <li>{{ $genre->name }}</li>
                    @endforeach
                </ul>
            </div>
            <h3>
                <a href="/manga/{{ $manga->clean_url }}" title="{{ $manga->name }}">
                    {{ $manga->name }} (Ch.{{ $manga->latestChapter->chapter_number or 0 }})
                </a>
            </h3>
            <div class="text-container manga">{{ $manga->summary }}</div>
            <div class="manga-meta">
                <div>{{ $manga->latestChapter->date or $manga->date }}</div>
                <div>{{ $manga->views }} views</div>
            </div>
        </div>
    </div>
@endforeach
