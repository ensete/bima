<div class="content">

    <div class="indicator">
        <h3>LATEST</h3>
    </div>
    @include('manga.manga_blocks', ['mangas' => $latest_manga])

    <div class="indicator">
        <h3>POPULAR</h3>
    </div>
    @include('manga.manga_blocks', ['mangas' => $popular_manga])

    <div class="clearfix"></div>
    <div class="advertiser-horizon"></div>
</div>

@include('elements/sidebar')

