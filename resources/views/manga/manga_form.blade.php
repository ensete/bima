<div class="content one-column">

    <h3>{{ $title }}</h3>

    <div class="manga-cover">
        <div class="blur-layer"></div>
        <div id="demo-banner" class="banner"
             style="background-image: url(/images/storage/manga/banners/{{ $manga->id or '' }}.jpg)"></div>
        <div id="demo-cover" class="cover"
             style="background-image: url(/images/storage/manga/covers/{{ $manga->id or '' }}.jpg)"></div>
    </div>

    <form method="post" action="" enctype="multipart/form-data" style="width: 60%">
        <input name="_token" type="hidden" value="{!! csrf_token() !!}"/>
        <input name="team_id" type="hidden" value="{{ $user->team_id or $manga->team_id }}"/>

        <div class="form-group">
            <label for="name">Name: </label><br/>
            <input type="text" id="name" name="name" value="{{ $manga->name or old('name') }}" required/>
        </div>

        <div class="form-group">
            <label for="cover_image">Manga Cover (preferably 150x200): </label><br/>
            <input type="file" id="cover_image" name="cover_image" accept="image/*"/>
        </div>

        <div class="form-group">
            <label for="banner_image">Manga Banner (preferably 920x300): </label><br/>
            <input type="file" id="banner_image" name="banner_image" accept="image/*"/>
        </div>

        <div class="form-group">
            <label for="author">Author: </label><br/>
            <input type="text" id="author" name="author" value="{{ $manga->author or old('author') }}" required/>
        </div>

        <div class="form-group">
            <label for="other_name">Other Name: </label><br/>
            <input type="text" id="other_name" name="other_name" value="{{ $manga->other_name or old('other_name') }}"/>
        </div>

        <div class="form-group">
            <label for="status">Status: </label><br/>
            <select name="status" id="language">
                <option>Ongoing</option>
                <option>Completed</option>
            </select>
        </div>

        @foreach ($genres as $genre)
            <div style="width: 30%;display: inline-block">
                <input type="checkbox" id="{{ $genre->id }}" name="genres[]"
                       value="{{ $genre->id }}" {{ checkGenre($genre->id, $current_genres) }}/>
                <label for="{{ $genre->id }}">{{ $genre->name }}</label>
            </div>
        @endforeach

        <div class="form-group">
            <label for="summary">Summary: </label><br/>
            <textarea id="summary" name="summary" required>{{ $manga->summary or old('summary') }}</textarea>
        </div>

        <input type="submit" value="Save"/>
    </form>
</div>

@include('elements.sidebar')
