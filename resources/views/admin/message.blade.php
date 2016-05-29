<div class="content one-column about">
    <div id="pageMid" style="text-align: left">
        @foreach ($messages as $index => $message)
            <div>
                <h3>{{ $index+1 . '. ' . $message->name . " - " . $message->email . " (" . $message->created_at->format('Y M, d') . ")" }}</h3>
                <p>{!! nl2br(e($message->message)) !!}</p>
            </div>
            <hr>
        @endforeach
    </div>
</div>