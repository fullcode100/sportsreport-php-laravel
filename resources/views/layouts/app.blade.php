<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--Gets page title if one is set. Defaults otherwise.-->
    <?php $final_page_title; ?>
    @if(isset($page_title)) 
        <?php $final_page_title = $page_title . " - " . config('app.name', 'Sports Highlights and Photography'); ?>
    @else 
        <?php $final_page_title = config('app.name', 'Sports Highlights and Photography'); ?>
    @endif
    <title>{{$final_page_title}}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link href="{{ asset('css/custom-styles.css') }}" rel="stylesheet">
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    <link rel="shortcut icon" href="/favicon.ico" />

    <meta name="description" content="@if(View::hasSection('meta_descriptor')) @yield('meta_descriptor') @else Highlights Arena houses some of the best sports highlights and photos from around the internet. We collect clips of everything ranging from amazing NFL touchdowns, the craziest college plays, biggest MLB homeruns, great goalie saves in the NHL, and awe inspiring dunks in the NBA. @endif">
</head>
<body>
<div id="app">
    <div class="white-container">
        <div class="container">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <a class="title-link site-branding" href="{{ url('/') }}">
                    <img src="{{ url('/') }}{{$random_header_image}}" alt="Highlights Arena Header Image" class="img-fluid corner-stone-image">
                    <h1>{{ config('app.name', 'Highlights Arena') }}</h1>
                </a>
            </div>

            <nav class="navbar">
               <ul class="center-nav-links">
                    <li><a class="nav-link" href="/">Highlights</a></li>
                    <li><a class="nav-link" href="https://blog.highlightsarena.com/">Writings</a></li>
                    @if(Auth::check())
                        <li>
                            <a class="nav-link" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                {{ Auth::user()->name }} &#9660;
                            </a>
                        </li>
                    @endif
               </ul>

               <div class="collapse center-nav-links" id="collapseExample">
                    <a href="/home">Manage Highlights</a> |
                    <a href="/preview-post">Add New Highlight</a> |
                    <a href="{{ route('logout') }}"onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
            </nav>
        </div>
    </div>

    @yield('content')

    <div class="container" id="footer">
        <div class="col-xs-12 col-xs-12 col-md-12 col-lg-12">
            <p class="text-center">&copy; 2017 - Highlights Arena</p>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

<script>
     $(document).ready(function(){
        $('[data-toggle="popover"]').popover()
    });
</script>

@if(config('app.debug') || Auth::check())
    <!--Google Analytics was not loaded. Either you are in debug mode or you are logged in as an administrator.-->
@else
<!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-32585378-8"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-32585378-8');
    </script>
@endif
</body>
</html>
