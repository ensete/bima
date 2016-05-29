<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.17/themes/base/jquery-ui.css">

<div class="content one-column edit-image" style="max-width: 3000px;width:100%;">
    <div id="image-area">
        <div class="image-container" style="display: inline-block; border-right: 1px dashed">
            <input id="_token" type="hidden" value="{!! csrf_token() !!}"/>
            <img id="img" data-image-id="{{ $image->id }}" src="{{ $image->link }}"/>

            @for ($i = 0; $i < $languages->count(); $i++)
                <div data-language-id="{{ $languages[$i]->id }}" class="language {{ $i == 0 ? 'active' : 'none' }}">
                    @foreach ($texts->where('language_id', $languages[$i]->id) as $text)
                        <div class="div-text bubble{{ ($languages[$i]->typing == 2) ? ' vertical-style' : '' }}" data-text-id="{{ $text->id }}" style="{{ $text->style }}"><div class="edit-speech"><i class="fa fa-remove"></i><i class="fa fa-edit"></i></div><span>{!! $text->content !!}</span></div>
                    @endforeach
                </div>
            @endfor
        </div>
    </div>

    <div id="control-panel">
        <div class="form-group" style="margin-bottom: 5px">
            <label for="font-family">Font Family: </label>
            <select id="font-family" class="changeable">
                <option value="maru-gothic">Nukamiso</option>
                <option value="kei">Kei</option>
                <option value="GL-AntiquePlus">GL-AntiquePlus</option>
                <option value="hl-comic1">HL Comic1</option>
                <option value="hl-comic2">HL Comic2</option>
                <option value="hl-comic-boom">HL ComicBoom</option>
                <option value="anime-ace">Anime Ace</option>
                <option value="augie">Augie</option>
                <option value="felt-regular">Felt Regular</option>
                <option value="manga-speak">Manga Speak</option>
                <option value="chaney">Chaney</option>
                <option value="comic">Comic</option>
                <option value="dom">Dom</option>
                <option value="wahroonga">Wahroonga</option>
                <option value="telephone">Telephone</option>
            </select>
        </div>

        <div class="form-group" style="margin-bottom: 5px">
            <label for="font-size">Font Size: </label>
            <input type="number" id="font-size" class="changeable" value="16"/>
        </div>

        <div class="form-group">
            <input type="button" id="add-bold" style="width: 37%" value="Bold" title="Format:<b>YOUR TEXT</b>"/>
            <input type="button" id="toggle-background" style="width: 60%" value="Background"/>
            <input type="button" id="toggle-text-style" value="Style" style="width: 32%"/>
            <button id="rotate-left" style="width: 31%"><i class="fa fa-undo"></i></button>
            <button id="rotate-right" style="width: 32%"><i class="fa fa-repeat"></i></button>
        </div>

        <div class="form-group">
            <textarea id="code-text" style="resize: both;height: 100px;"></textarea>
        </div>

        <div style="margin-bottom: 10px;">
            <label for="normal">Normal</label>
            <input id="normal" type="radio" name="background" value="1" checked>

            <label for="transparent">Transparent</label>
            <input id="transparent" type="radio" name="background" value="2">
        </div>

        <div style="margin-bottom: 10px;">
            @for ($i = 0; $i < $languages->count(); $i++)
                <label for="{{ $languages[$i]->language }}"
                       style="text-transform: uppercase;">{{ $languages[$i]->language }}</label>
                <input id="{{ $languages[$i]->language }}" type="radio" name="language"
                       data-typing="{{ $languages[$i]->typing }}"
                       value="{{ $languages[$i]->id }}" {{ $i == 0 ? 'checked' : '' }}>
            @endfor
        </div>

        <div style="margin-bottom: 10px;">
            <button style="width:48%;height:30px;vertical-align: top;" id="apply-text-field">Apply</button>
            <button style="width:48%;height:30px" id="save-all">Save</button>
        </div>

        <div class="btn-control-container">
            @if ($proceed['is_prev'])
                <a href="/manga/edit-images/{{ $image->chapter_id }}/{{ $image->order - 1 }}">
                    <div class="btn-control left"><i class="fa fa-angle-left"></i></div>
                </a>
            @endif

            <span>{{ $image->order."/".$totalImg }}</span>

            @if ($proceed['is_next'])
                <a href="{{ $image->order + 1 }}">
                    <div class="btn-control right"><i class="fa fa-angle-right"></i></div>
                </a>
            @endif
        </div>
    </div>
</div>
