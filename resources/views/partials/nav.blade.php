<?php

// -----------------
// View Name Prefix
// -----------------
$VN = 'views/partials/nav.';

// -----------------
// Get Locale
// -----------------

$locale = Cookie::get('locale', Config::get('app.locale','en'));
$locales = Config::get('app.locales',['en' => 'English']);
if (!array_has($locales, $locale)) {
    $locale = 'en';
}
?>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/home">
                {{trans($VN.'app_name')}}
            </a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

            @if (Auth::check())
                <ul class="nav navbar-nav">
                    @if(Auth::user()->is_author)
                        <li class="dropdown">
                            <a href="{{ route('author.index') }}" class="dropdown-toggle" data-toggle="dropdown"
                               role="button" aria-expanded="false">{{trans($VN.'author')}}<span
                                        class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ route('author.index') }}">Item1</a></li>
                                <li><a href="{{ route('author.index') }}">Item2</a></li>
                            </ul>
                        </li>
                    @endif

                    @if(Auth::user()->is_reviewer)
                        <li class="dropdown">
                            <a href="{{ route('reviewer.index') }}" class="dropdown-toggle" data-toggle="dropdown"
                               role="button" aria-expanded="false">{{trans($VN.'reviewer')}}<span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ route('reviewer.index') }}">Item1</a></li>
                                <li><a href="{{ route('reviewer.index') }}">Item2</a></li>
                            </ul>
                        </li>
                    @endif

                    @if(Auth::user()->is_approver)
                        <li class="dropdown">
                            <a href="{{ route('approver.index') }}" class="dropdown-toggle" data-toggle="dropdown"
                               role="button" aria-expanded="false">{{trans($VN.'approver')}}<span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ route('approver.index') }}">Item1</a></li>
                                <li><a href="{{ route('approver.index') }}">Item2</a></li>
                            </ul>
                        </li>
                    @endif

                    @if(Auth::user()->is_publisher)
                        <li class="dropdown">
                            <a href="{{ route('publisher.index') }}" class="dropdown-toggle" data-toggle="dropdown"
                               role="button" aria-expanded="false">{{trans($VN.'publisher')}}<span
                                        class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ route('publisher.index') }}">Item1</a></li>
                                <li><a href="{{ route('publisher.index') }}">Item2</a></li>
                            </ul>
                        </li>
                    @endif


                </ul>
            @endif

            <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                    <li><a href="{{ url('/auth/login') }}">{{trans($VN.'login')}}</a></li>
                    <li><a href="{{ url('/auth/register') }}">{{trans($VN.'register')}}</a></li>
                @else
                    @if(Auth::user()->is_admin)
                        <li class="dropdown">
                            <a href="{{ route('admin.index') }}" class="dropdown-toggle" data-toggle="dropdown"
                               role="button" aria-expanded="false">{{trans($VN.'admin')}}<span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ route('admin.users.index') }}">{{trans($VN.'users')}}</a></li>
                                <li><a href="{{ route('admin.departments.index') }}">{{trans($VN.'departments')}}</a>
                                </li>
                                <li><a href="{{ route('admin.roles.index') }}">{{trans($VN.'roles')}}</a></li>
                                <li><a href="{{ route('admin.permissions.index') }}">{{trans($VN.'permissions')}}</a>
                                </li>
                                <li class="divider"></li>
                                <li><a href="{{ route('admin.folders.index') }}">{{trans($VN.'folders')}}</a></li>
                                <li><a href="{{ route('admin.categories.index') }}">{{trans($VN.'categories')}}</a></li>
                                <li><a href="{{ route('admin.frontpages.index') }}">{{trans($VN.'frontpages')}}</a></li>
                                <li><a href="{{ route('admin.documents.index') }}">{{trans($VN.'documents')}}</a></li>
                            </ul>
                        </li>
                    @endif
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false">{{ (Auth::user()->display_name .'('. Auth::user()->name .')') }}
                            <span
                                    class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/auth/logout') }}">{{trans($VN.'logout')}}</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ route('profile.edit') }}">{{trans($VN.'profile')}}</a></li>
                            <li><a href="{{ route('password.edit') }}">{{trans($VN.'password')}}</a></li>
                        </ul>
                    </li>
                @endif
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                       role="button" aria-expanded="false"><img
                                src="{{asset('/images/flags/'. $locale .'.png') }}"/></a>
                    <ul class="dropdown-menu" role="menu">
                        @foreach(Config::get('app.locales',['en'=>'English']) as $key => $language)
                            <li><a href="{{route('locale.setlocale',[$key]) }}"><img
                                            src="{{asset('/images/flags/'.$key.'.png') }}"/> {{$language}}</a></li>
                        @endforeach
                    </ul>
                </li>
            </ul>

        </div>
    </div>
</nav>