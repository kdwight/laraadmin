<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            /* Always set the map height explicitly to define the size of the div
            * element that contains the map. */
            #map {
              height: 100%;
            }
        </style>

        <script>
            function initMap() {
                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 14,
                    center: {lat: 14.573950, lng: 121.033070},
                    styles: [
                    {
                        featureType: 'poi',
                        stylers: [{visibility: 'off'}]
                    }
                    ]
                });

                setMarkers(map);
            }

            const contentString = '<b>EC Storage</b>';
            const contentString2 = '<b>EC Storage Warehouse 2</b>';
            const contentString3 = '<b>EC Storage San Rafael</b>';
            const contentString4 = '<b>EC Storage Acacia</b>';
            const contentString5 = '<b>EC Storage R. Pascual</b>';
            const contentString6 = '<b>EC Storage Makati</b>';

            const branches = [
                ['EC Storage', 14.573950, 121.033070, 1, contentString],
                ['EC Storage Warehouse 2', 14.578700, 121.036380, 2, contentString2],
                ['EC Storage San Rafael', 14.5779557, 121.0394062, 3, contentString3],
                ['EC Storage Acacia', 14.5877, 121.0357, 4, contentString4],
                ['EC Storage R. Pascual', 14.5873, 121.0422, 5, contentString5],
                ['EC Storage Makati', 14.5573, 121.0155, 6, contentString6]
            ];

            function setMarkers(map) {
                branches.map((branch, i) => {
                    var marker = new google.maps.Marker({
                    position: {lat: branch[1], lng: branch[2]},
                    map: map,
                    title: branch[0],
                    icon: 'https://maps.google.com/mapfiles/kml/shapes/library_maps.png',
                    zIndex: branch[3]
                    });

                    var infowindow = new google.maps.InfoWindow({
                        content: branch[4]
                    });

                    marker.addListener('click', function() {
                        infowindow.open(map, marker);
                    });
                });
            }
        </script>
    </head>
    <body>
        <!-- Load Facebook SDK for JavaScript -->
        <div id="fb-root"></div>
        <script>
        window.fbAsyncInit = function() {
            FB.init({
            xfbml            : true,
            version          : 'v3.2'
            });
        };

        (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>

        <!-- Your customer chat code -->
        <div class="fb-customerchat"
        attribution=setup_tool
        page_id="242788566667703"
        theme_color="#67b868">
        </div>

        <div id="map"></div>
        <!-- Replace the value of the key parameter with your own API key. -->
        <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCkUOdZ5y7hMm0yrcCQoCvLwzdM6M8s5qk&callback=initMap">
        </script>

        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Documentation</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div>
        </div>

        <script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script>
    </body>
</html>
