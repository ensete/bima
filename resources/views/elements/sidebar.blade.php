<div id="fb-root" style="position: absolute"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.5&appId=1426423650982306";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
<div class="sidebar">
    <div class="sidebar-content">
        <div class="sidebar-deco">
            <h3>RANDOM MANGA</h3>
        </div>
        @foreach ($data['manga'] as $manga)
            <p>- <a href="/manga/{{ $manga->clean_url }}">{{ $manga->name }}</a></p>
        @endforeach
    </div>

    {{-- <div class="sidebar-content">
        <div class="sidebar-deco">
            <h3>PROMINENT POSTS</h3>
        </div>
        @foreach ($data['posts'] as $blog)
            <p>- <a href="/blog/{{ $blog->clean_url }}">{{ $blog->title }}</a></p>
        @endforeach
    </div> --}}

    <div class="fb-page" data-href="https://www.facebook.com/Bilingual-Manga-271780903017440/?fref=ts" data-width="300" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="false"></div>
    <div class="advertiser-sidebar"></div>
</div>