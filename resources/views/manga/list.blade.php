<div class="content">
    @include('manga.manga_blocks', ['mangas' => $mangas])

    <div class="clearfix"></div>
    <div id="pagination-container">
        {!! $mangas->render() !!}
    </div>
</div>

@include('elements/sidebar')

