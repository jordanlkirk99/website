<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @include('app.includes.head', ['structure' => 'error'])
    </head>
    <body>
        <div id="error-wrapper">
            <div id="error-num">@yield('errorCode')</div>
            <div id="error-content">
                <div>@yield('errorDetails')</div>
                <div id="error-links">
                    <a href="{{ route('home') }}">
                        <span class="fa fa-home" title="Try the homepage"></span>
                    </a>
                    <a href="https://github.com/backstagetechnicalservices/website/issues" target="_blank" title="Report issue">
                        <span class="fa fa-github"></span>
                    </a>
                </div>
            </div>
        </div>
    </body>
</html>