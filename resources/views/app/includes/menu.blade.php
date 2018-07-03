<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img alt="Backstage Technical Services" src="{{ asset('images/bts-logo-transparent.png') }}">
            </a>

            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menu-main">
                <span class="sr-only">Toggle navigation</span>
                <span class="fa fa-bars"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse" id="menu-main">
            {!! $mainMenu !!}

            <div class="btn-group" id="menu-main--buttons">
                @if(!auth()->check())
                    <a class="btn btn-success" id="menu-main--book" href="{{ route('contact.book') }}">
                        <span class="fa fa-calendar-check-o"></span>
                        <span>Book Us</span>
                    </a>
                @else
                    <a class="btn btn-warning" id="menu-main--accident" href="{{ route('contact.accident') }}">
                        <span class="fa fa-exclamation-triangle"></span>
                        <span>Report Accident</span>
                    </a>
                @endif
            </div>

            <div class="dropdown" id="menu-profile">
                @if(auth()->check())
                    <button class="dropdown-toggle" type="button" data-toggle="dropdown" data-target="#menu-profile--dropdown">
                        @if(auth()->check())
                            <img src="{{ auth()->user()->getAvatarUrl() }}">
                        @else
                            <span class="fa fa-user"></span>
                        @endif
                    </button>
                    <div class="dropdown-menu" id="menu-profile--dropdown">
                        <div id="menu-main--user">
                            <p id="menu-main--user--upper">{{ auth()->user()->name }}</p>
                            <p id="menu-main--user--lower">
                                <a href="{{ route('member.profile') }}">My Profile</a> |
                                <a href="{{ route('auth.logout') }}">Logout</a>
                            </p>
                        </div>
                        {!! $userMenu !!}
                    </div>
                @else
                    <a href="{{ route('auth.login') }}">
                        <span class="fa fa-user"></span>
                    </a>
                @endif
            </div>
        </div>
    </div>
</nav>