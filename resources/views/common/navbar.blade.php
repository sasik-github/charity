<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a href='https://play.google.com/store/apps/details?id=ru.volunteer&utm_source=global_co&utm_medium=prtnr&utm_content=Mar2515&utm_campaign=PartBadge&pcampaignid=MKT-Other-global-all-co-prtnr-py-PartBadge-Mar2515-1'>
                <img class="google-badge-image" alt='Доступно на Google Play' src='/images/google-play-badge.png'/>
            </a>
            <a class="navbar-brand" href="{{ url('/') }}">
                Я АКТИВИСТ
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                <li><a href="{{ url('/news') }}">Новости</a></li>
                <li><a href="{{ url('/about') }}">О приложении</a></li>
                @if (!Auth::guest())
                    @if (auth()->user()->isAdmin())
                        <li><a href="{{ url('/events') }}">События</a></li>
                        <li><a href="{{ url('/volunteers') }}">Волонтеры</a></li>
                        <li><a href="{{ url('/organizers') }}">Организаторы</a></li>
                    @endif
                @endif
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Вход</a></li>
                    {{--<li><a href="{{ url('/register') }}">Регистрация</a></li>--}}
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ action('UsersController@getChangePassword') }}">Сменить пароль</a></li>
                            <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Выход</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
