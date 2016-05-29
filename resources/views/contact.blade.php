<div class="content one-column about">
    <div id="pageMid">
        <h3 class="contact_mes">Please feel free to leave me a message!</h3>

        <form action="" method="POST">
            <input name="_token" type="hidden" value="{!! csrf_token() !!}"/>
            <input class="contact_input" required type="text" name="name" placeholder="Your Name"><br>
            <input class="contact_input" required type="email" name="email" placeholder="Your Email"><br>
            <textarea id="contact-textarea" required name="message" placeholder="Your Message" rows="12"></textarea><br>
            <input id="contactBtn" type="submit" value="Send">
        </form>
    </div>
</div>

@include('elements.sidebar')
