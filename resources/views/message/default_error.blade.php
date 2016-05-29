@foreach ($errors->all() as $error)
    <div class="ns-effect-jelly ns-error ns-show">
        <div class="ns-box-inner">
            <p>{{ $error }}</p>
        </div>
    </div>
@endforeach