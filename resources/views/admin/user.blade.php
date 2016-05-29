<div class="content one-column about">
    <div id="pageMid" style="text-align: left">
        @foreach ($users as $index => $user)
            <h3><a class="normal-a" href="/user/profile/{{ $user->username }}">{{ $user->username . ' - ' . $user->email }}</a></h3>
            <hr>
        @endforeach
    </div>
</div>