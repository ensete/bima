<div id="header-bg">
    <div id="home-overlay"></div>

    <div id="ghost-container">
        @if ($composer['user'])
            <a href="/user/profile/{{ $composer['user']->username }}">
                <div class="ghost-button">Profile</div>
            </a>
            <a href="/user/logout">
                <div class="ghost-button">Logout</div>
            </a>
        @else
            <div class="ghost-button" onclick="triggerRegister()">Register</div>
            <div class="ghost-button" onclick="triggerLogin()">Login</div>
        @endif
    </div>

    <div id="header-container">
        <div id="logo" class="bg-commons">
            <a class="main-logo" href="/" title="Home">Bima</a>
            <h4 class="sub-logo">Bilingual Manga</h4>
        </div>

        <div id="nav-bar" class="bg-commons">
            <div class="left nav-bar">
                <ul>
                    <a href="/about">
                        <li class="shiny-button home about-header">About</li>
                    </a>
                    <a href="/manga/manga-list">
                        <li class="shiny-button home manga-header">Manga</li>
                    </a>
                    <li class="motto">One single click for translation</li>
                </ul>
            </div>

            <div class="right nav-bar">
                <ul>
                    <a href="#">
                        <li class="shiny-button home blog-header">Blog</li>
                    </a>
                    <a href="/contact">
                        <li class="shiny-button home contact-header">Contact</li>
                    </a>
                    <li class="motto">Manga texts can be selected</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div id='home-mobile-menu'>
    <div id='small-header'>
        <ul>
            <li><a href="/about" class="about-header">ABOUT</a></li>
            <li><a href="/manga/manga-list" class="manga-header">MANGA</a></li>
            <li><a href="/" title="Home"><img id="top-logo" src="/images/logo.png"/></a></li>
            <li><a href="/blog/blog-list" class="blog-header">BLOG</a></li>
            <li><a href="/contact" class="contact-header">CONTACT</a></li>
        </ul>
    </div>
</div>
