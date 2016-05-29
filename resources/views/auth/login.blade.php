<form class="login-form" method="POST" action="/user/login">
    <input name="_token" type="hidden" value="{!! csrf_token() !!}"/>
    <p class="field">
        <input id="login-username" type="text" name="username" placeholder="Username" required>
        <i class="fa fa-user fa-fw"></i>
    </p>
    <p class="field">
        <input type="password" name="password" placeholder="Password" required>
        <i class="fa fa-lock"></i>
    </p>
    <input type="hidden" name="remember" value="1">
    <p class="submit">
        <button type="submit"><i class="fa fa-arrow-circle-right fa-lg"></i></button>
    </p>
</form>