<div class="content one-column view-blog">
    @if ($is_admin)
        <a href="/blog/edit-blog/{{ $blog->id }}"><i class="fa fa-edit edit-button"></i></a>
    @endif

    <h3>{{ strtoupper($blog->title) }}</h3>

    <div class="more-info">
        {{ $blog->created_at->format('M d, Y') }} / By
        <a href="/user/profile/{{ $blog->user->username }}">{{ $blog->user->name }}</a>
    </div>

    <div class="cover-img">
        <img src="/images/storage/blogs/{{ $blog->id }}.jpg"/>
    </div>

    <div class="blog-content">
        {!! $blog->content !!}
    </div>
</div>

@include('elements/sidebar')

