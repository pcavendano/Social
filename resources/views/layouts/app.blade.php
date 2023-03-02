<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name')}} : @yield('title')</title>
    <link  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.0/mdb.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=sw" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/bootstrap.bundle.js') }}" defer></script>
    <script src="{{ asset('js/bootstrap.js') }}" defer></script>
    <!-- Styles -->


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/boxicons.min.css"
          integrity="sha512-pVCM5+SN2+qwj36KonHToF2p1oIvoU3bsqxphdOIWMYmgr4ZqD3t5DjKvvetKhXGc/ZG5REYTT6ltKfExEei/Q=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.css"
          integrity="sha256-NAxhqDvtY0l4xn+YVa6WjAcmd94NNfttjNsDmNatFVc=" crossorigin="anonymous"/>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito';
        }
    </style>
</head>
<body>
    {{-- Request::server('HTTP_ACCEPT_LANGUAGE') --}}
@php $locale = session()->get('locale'); @endphp
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="mt-1">
            <a class="navbar-brand" href="/">@lang('lang.hello')
                @if(Auth::check()) {{Auth::user()->name}} @else
                    Guest @endif!</a>
            <button class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarNavAltMarkup"
                    aria-controls="navbarNavAltMarkup"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="d-flex justify-content-between">
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ">
                    @guest
                        <a class="nav-link" href="{{route('user.create')}}">@lang('lang.register')</a>
                        <a class="nav-link" href="{{route('login')}}">@lang('lang.login')</a>
                    @else
                        <a class="nav-link" href="{{route('forum.index')}}">@lang('lang.articles')</a>
                        <a class="nav-link" href="{{route('etudiants')}}">@lang('lang.students')</a>
                        <a class="nav-link" href="{{route('logout')}}">@lang('lang.logout')</a>
                    @endguest

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                           v-pre>
                            @switch($locale)
                                @case('en')
                                <i class="flag flag-united-states" width="25px"></i> English
                                @break
                                @case('fr')
                                <i class="flag flag-france" width="25px"></i> Français
                                @break
                                @default
                                <i class="flag flag-united-states" width="25px"></i> English
                            @endswitch
                            <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="nav-link dropdown-item @if($locale=='en') bg-secondary @endif" href="{{route('lang', 'en')
            }}"><i class="flag flag-united-states"  width="25px"> English</i></a>
                            <a class="nav-link dropdown-item {{ $locale =='fr' ? 'bg-secondary' : '' }}" href="{{route('lang', 'fr')
            }}"><i class="flag flag-france"  width="25px"></i> Français</a>
                        </div>
                    </li>

                </div>
            </div>
        </div>
    </nav>
    @yield('content')
</body>
<footer class="bg-light text-center text-lg-start">
    <div class="container footer p-4">
        <div class="row">
            <div class="col-lg-12">
                <p>@lang('lang.work'): Pedro Contreras Avendano</p>
            </div>
        </div>
    </div>
</footer>
</html>
