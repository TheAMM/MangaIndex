<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="googlebot" content="noindex">

    <meta name="viewport" content="width=device-width" />
    <meta name="mobile-web-app-capable" content="yes">

    @if(isset($pageTitle) && !empty($pageTitle))
        <title>{{{ $pageTitle }}} - Madokami</title>
        <meta property="og:title" content="{{{ $pageTitle }}} - Madokami" />
    @else
        <title>Madokami</title>
        <meta property="og:title" content="Madokami" />
    @endif

    @if(isset($pageDescription) && !empty($pageDescription))
        <meta property="og:description" content="{{{ $pageDescription }}}" />
        <meta property="description" content="{{{ $pageDescription }}}" />
    @endif

    @if(isset($pageImage) && !empty($pageDescription))
        <meta property="og:image" content="{{{ $pageImage }}}" />
    @endif

    <link rel="icon" type="image/png" href="{{{ URL::to('img/icon.png') }}}">

    {{ Minify::stylesheet(array($stylesheets, $additionalStylesheets)) }}

    <script type="application/ld+json">
        {
            "@context": "http://schema.org",
            "@type": "WebSite",
            "url": "{{{ URL::to('/') }}}",
            "potentialAction": {
                "@type": "SearchAction",
                "target": "{{{ URL::route('search') }}}?q={search_term_string}",
                "query-input": "required name=search_term_string"
            }
        }
    </script>
</head>
<body>
    @section('body')
        @yield('pageHeading')

        <div class="search-container">
            <form method="get" action="{{{ URL::route('search') }}}">
                <input type="text" name="q" placeholder="Search" class="input" id="search-input" required />
                <button class="button">Search</button>
            </form>

            <div class="mobile-break">
                @if($user)
                    <a href="{{{ URL::route('logout') }}}" class="button">Log out</a>

                    <a href="{{{ URL::route('notifications') }}}" class="button">
                        Notifications

                        @if(isset($notifyCount) && $notifyCount > 0)
                            <span class="notify-label">{{{ $notifyCount }}}</span>
                        @endif
                    </a>
                @else
                    <a href="{{{ URL::route('login') }}}" class="button">Log in</a>
                @endif

                <a href="{{{ URL::route('recent') }}}" class="button">Recent uploads</a>

                <a href="{{{ URL::route('reports') }}}" class="button">
                    Reports

                    @if(isset($reportsCount) && $reportsCount > 0)
                        <span class="notify-label">{{{ $reportsCount }}}</span>
                    @endif
                </a>

                <!--
                <a class="button" href="{{{ URL::route('donate') }}}">Donate</a>
                -->
            </div>
        </div> 

        @if(Session::has('error'))
            <div class="message message-error">{{{ Session::get('error') }}}</div>
        @endif

        @if(Session::has('success'))
            <div class="message message-success">{{{ Session::get('success') }}}</div>
        @endif

        <div class="message message-info">We're back, almost. If you registered before 2015-11-22, you should be good to go. If not, you'll have to register again, sorry. Your lucky word is '/topic'. Also, series images are missing, we'll get to that soon™. If you're downloading a <i>lot</i>, please mind the 429s, or contact us in the IRC.</div>

        @section('main')
            <div id="loli-madokai-container">
                <div id="loli-madokami"></div>
            </div>
        @show

        <footer>
            {{{ $statTotalSize }}} used<br/>
            #madokami @ rizon<br/>
            <a href="https://fufufu.moe/a/?cache" target="_blank">fufufu.moe</a>
        </footer>
    @show

    {{ Minify::javascript(array($javascripts, $additionalJavascripts)) }}
</body>
</html>
