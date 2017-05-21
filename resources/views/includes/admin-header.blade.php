<header class="top-nav">
    <nav>
        <ul>
            <li {{ Request::is('admin') ? 'class=active' : ''}}><a href="{{ route('admin.index') }}">Tableau de bord</a></li>
            <li {{ Request::is('admin/devis*') ? 'class=active' : ''}}><a href="{{ route('admin.quotes.index') }}">Devis</a></li>
            <li {{ Request::is('admin/categorie*') ? 'class=active' : ''}}><a href="{{ route('admin.quotes.categories') }}">Catégories</a></li>
            <li {{ Request::is('admin/contact/*') ? 'class=active' : ''}}><a href="{{ route('admin.contact.index') }}">Messages</a></li>
            <li><a href="{{ route('admin.logout') }}">Déconnexion</a></li>
        </ul>
    </nav>
</header>