<div class="content one-column">
    <h3>{{ $title }}: <a href="/manga/{{ $manga->clean_url }}">{{ $manga->name }}</a></h3>

    <form class="form" method="post" action="">
        <input name="_token" type="hidden" value="{!! csrf_token() !!}"/>

        <div class="form-group">
            <label for="number">Chapter Number: </label><br/>
            <input type="number" id="number" name="number" value="{{ $chapter->chapter_number or '' }}" required/>
        </div>

        <div class="form-group">
            <label for="name">Chapter Name: </label><br/>
            <input type="text" id="name" name="name" value="{{ $chapter->description or '' }}" required/>
        </div>

        <div class="form-group">
            <label for="html_image">Full HTML Images (Images without any text): </label><br/>
            <textarea id="html_image" name="html_image"></textarea>
        </div>

        <div class="form-group">
            <input id="active" type="checkbox" name="active" value="1" style="width: auto" {{ $is_active }}>
            <label for="active" style="margin-left: 5px">Active</label>
        </div>

        <div class="form-group">
            <input type="submit" value="Save"/>
        </div>
    </form>
</div>

@include('elements/sidebar')

