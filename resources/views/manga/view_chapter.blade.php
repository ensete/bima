<div id="ripple-container">
    <div style="height: 0; width: 0; position: absolute; visibility: hidden;" aria-hidden="true">
        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
             focusable="false">
            <symbol id="ripply-scott-polygon" viewBox="0 0 100 100">
                <g>
                    <polygon points="5.6,77.4 0,29 39.1,0 83.8,19.3 89.4,67.7 50.3,96.7"/>
                    <polygon fill="rgba(255,255,255,0.35)" transform="scale(0.5), translate(50, 50)"
                             points="5.6,77.4 0,29 39.1,0 83.8,19.3 89.4,67.7 50.3,96.7"/>
                    <polygon fill="rgba(255,255,255,0.25)" transform="scale(0.25), translate(145, 145)"
                             points="5.6,77.4 0,29 39.1,0 83.8,19.3 89.4,67.7 50.3,96.7"/>
                </g>
            </symbol>
        </svg>
    </div>

    <button id="js-ripple-btn" class="styl-material polygon">
        <svg class="ripple-obj" id="js-ripple">
            <use width="4" height="4" xlink:href="#ripply-scott-polygon" class="js-ripple"></use>
        </svg>
        language switcher
    </button>
</div>

<a id="manga-name" href="/manga/{{ $manga->clean_url }}">{{ $manga->name }}</a>
<div id="images-container">
    {!! $toolbar !!}
    @foreach ($chapter->images as $image)
        <div class="image-container">
            <img src="{{ $image->link }}"/>

            <div class="language main">
                @foreach ($image->texts as $text)
                    @if ($text->language_id == $languages[0]->id)
                        {!! renderText($text, $languages[0]->typing) !!}
                    @endif
                @endforeach
            </div>

            <div class="language sub" style="display: none;">
                @foreach ($image->texts as $text)
                    @if ($text->language_id == $languages[1]->id)
                        {!! renderText($text, $languages[1]->typing) !!}
                    @endif
                @endforeach
            </div>
        </div>
    @endforeach
</div>
{!! $toolbar !!}
