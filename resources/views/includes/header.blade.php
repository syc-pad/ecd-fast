<header>
    <nav class="main-nav">
        <ul>
            <li {{ Request::is('/') ? 'class=active' : ''}}><a href="{{ route('public.index') }}">Accueil</a></li>
            <li {{ Request::is('a-propos') ? 'class=active' : ''}}><a href="{{ route('about') }}">À propos</a></li>
            <li {{ Request::is('contact') ? 'class=active' : ''}}><a href="{{ route('contact') }}">Contact</a></li>
            <li><a href="{{ route('admin.login') }}">Espace client</a></li>
        </ul>
    </nav>
</header>