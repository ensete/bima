<div class="content">
    @foreach ($blogs as $blog)
        <div class="my-grid grid-5 blog-grid">
            <a href="/blog/{{ $blog->clean_url }}" title="{{ $blog->title }}">
                <img src="/images/storage/blogs/{{ $blog->id }}.jpg"/>
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
            <div class="blog-info">
                <h3><a href="/blog/{{ $blog->clean_url }}">{{ strtoupper($blog->title) }}</a></h3>

                <div class="text-container">
                    <p>{{ preg_replace('#<[^>]+>#', ' ', $blog->content) }}</p>
                </div>

                <div class="grid-footer">
                    <div class="more-info">
                        {{ $blog->created_at->format('M d, Y') }} / By
                        <a href="/user/profile/{{ $blog->user->username }}">{{ $blog->user->name }}</a>
                    </div>
                    <a href="/blog/{{ $blog->clean_url }}">
                        <div class="read-more">Read more</div>
                    </a>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    @endforeach

    <div class="clearfix"></div>
    <div id="pagination-container">
        {!! $blogs->render() !!}
    </div>
</div>

@include('elements/sidebar')

