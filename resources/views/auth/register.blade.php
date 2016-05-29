<form id="register-form" method="POST" enctype="multipart/form-data" action="/user/register">
    <div class="avatar" style="background-image: url(/images/cute-whale.jpg)">
        <div id="register-msg">Hi!</div>
    </div>

    <div class="form-container">
        <input id="register-token" name="_token" type="hidden" value="{!! csrf_token() !!}"/>
        <p class="field">
            <input id="register-username" class="glowing-input" type="text" name="username" placeholder="Username" min="6" max="20" required>
        </p>
        <p class="double-field">
            <input id="register-pass" class="glowing-input" type="password" name="password" placeholder="Password" min="6" max="20" required>
            <input id="register-confirm-pass" class="glowing-input" type="password" name="password_confirmation" placeholder="Confirm Password" min="6" max="20" required>
            <span class="clearfix"></span>
        </p>
        <p class="field">
            <input id="register-email" class="glowing-input" type="email" name="email" placeholder="Email" required>
        </p>
        <p class="submit">
            <button id="register-submit" type="submit" class="button-3d">REGISTER</button>
        </p>
    </div>
</form>

<div id="register-note">
    <p>
        - Wanna make your favorite manga bilingual and help people with their learning process?
        Don't hesitate to join us and follow our <a class="bold-link" href="#">GUIDE</a> to start right now.
        It's sure that your great contribution will be much appreciated by others.
        We always welcome you with open arms.
    </p>
    <p>- If you have something in mind or further details, please feel free to <a class="bold-link" href="/contact">CONTACT</a> us</p>
</div>

<div class="x-button" onclick="disableOverlay()"></div>