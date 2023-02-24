<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>STM - @yield('title')</title>
    <link rel="shortcut icon" href="/vendors/images/logo.png" type="image/x-icon">

    <link rel="stylesheet" href="/vendors/css/app.css">

    <!--    Icons -->
    <link rel="stylesheet" href="/vendors/css/uicons/css/uicons-regular-rounded.css">
    <link rel="stylesheet" href="/vendors/css/font-awesome/css/all.min.css">

    <!--    JS Files -->

    <script defer src="/vendors/js/turbolinks.js" data-turbolinks-eval="false"></script>
    <script defer src="/vendors/js/app.js" data-turbolinks-eval="false"></script>
</head>
<body>
<div class="sidebar">
    <div class="logo-details">
        <img src="/vendors/images/logo.png" alt="logo" class="icon">
        <div class="logo_name">TRANSPORT</div>
        <i class='fi-rr-align-right' id="close-nav"></i>
    </div>
    <ul class="nav-links">
        <li class="{{ $params['active_link'] === 'dashboard' ? 'active' : '' }}">
            <a href="{{ route('home.index') }}">
                <i class="fi-rr-home"></i>
                <span class="link_name">Dashboard</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="{{ route('home.index') }}">Dashboard</a></li>
            </ul>
        </li>

        <li class="{{ $params['active_link'] === 'planning' ? 'active' : '' }}">
            <a href="{{ route('planning.index') }}">
                <i class="fi-rr-calendar"></i>
                <span class="link_name">Planning</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="{{ route('planning.index') }}">Planning</a></li>
            </ul>
        </li>

        <li class="{{ $params['active_link'] === 'reservations' ? 'active' : '' }}">
            <a href="{{ route('reservation.index') }}">
                <i class="fi-rr-document"></i>
                <span class="link_name">Réservations</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="{{ route('reservation.index') }}">Réservations</a></li>
            </ul>
        </li>

        <li class="{{ $params['active_link'] === 'agences' ? 'active' : '' }}">
            <a href="{{ route('agence.index') }}">
                <i class="fi-rr-shop"></i>
                <span class="link_name">Agences</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="{{ route('agence.index') }}">Agences</a></li>
            </ul>
        </li>

        <li class="{{ $params['active_link'] === 'agents' ? 'active' : '' }}">
            <a href="{{ route('agent.index') }}">
                <i class="fi-rr-portrait"></i>
                <span class="link_name">Agents</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="{{ route('agent.index') }}">Agents</a></li>
            </ul>
        </li>

        <li class="{{ $params['active_link'] === 'voyageurs' ? 'active' : '' }}">
            <a href="{{ route('voyageur.index') }}">
                <i class="fi-rr-user"></i>
                <span class="link_name">Voyageurs</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="{{ route('voyageur.index') }}">Voyageurs</a></li>
            </ul>
        </li>

        <li class="{{ $params['active_link'] === 'bus' ? 'active' : '' }}">
            <a href="{{ route('bus.index') }}">
                <i class="fi-rr-truck-side"></i>
                <span class="link_name">Bus</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="{{ route('bus.index') }}">Bus</a></li>
            </ul>
        </li>

        <li class="{{ $params['active_link'] === 'forfaits' ? 'active' : '' }}">
            <a href="{{ route('forfait.index') }}">
                <i class="fi-rr-money"></i>
                <span class="link_name">Forfaits</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="{{ route('forfait.index') }}">Forfaits</a></li>
            </ul>
        </li>

        <li class="{{ $params['active_link'] === 'settings' ? 'active' : '' }}">
            <a href="{{ route('users.index') }}">
                <i class="fi-rr-settings"></i>
                <span class="link_name">Paramètres</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="{{ route('users.index') }}">Paramètres</a></li>
            </ul>
        </li>

        <li style="border-bottom: none !important;">
            <div class="profile-details">
                <div class="profile-content">
                    <img src="/vendors/images/profileDefault.png" alt="profileImg">
                </div>
                <div class="name-job">
                    <div class="profile_name">{{ \App\Helpers\TextHelpers\Text::Excerpt(\Illuminate\Support\Facades\Auth::user()->name, 10) }}</div>
                    <div class="job">Administrator</div>
                </div>
                <i id="log__out" data-url="{{ route("logout") }}" class='fi-rr-sign-out-alt log_out' style="min-width: 50px;"></i>
            </div>
        </li>
    </ul>
</div>

@yield('content')

<script>
    @yield('script')
</script>
</body>
</html>
