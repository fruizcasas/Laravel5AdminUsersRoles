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
                L5 AUR
            </a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            @if (Auth::check())
                <ul class="nav navbar-nav">
                    @if(Auth::user()->is_owner)
                        <li class="dropdown">
                            <a href="{{ route('owner.index') }}" class="dropdown-toggle" data-toggle="dropdown"
                               role="button" aria-expanded="false">Owner<span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ route('owner.index') }}">Item1</a></li>
                                <li><a href="{{ route('owner.index') }}">Item2</a></li>
                            </ul>
                        </li>
                    @endif

                    @if(Auth::user()->is_reviewer)
                        <li class="dropdown">
                            <a href="{{ route('reviewer.index') }}" class="dropdown-toggle" data-toggle="dropdown"
                               role="button" aria-expanded="false">Reviewer<span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ route('reviewer.index') }}">Item1</a></li>
                                <li><a href="{{ route('reviewer.index') }}">Item2</a></li>
                            </ul>
                        </li>
                    @endif

                    @if(Auth::user()->is_approver)
                        <li class="dropdown">
                            <a href="{{ route('approver.index') }}" class="dropdown-toggle" data-toggle="dropdown"
                               role="button" aria-expanded="false">Approver<span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ route('approver.index') }}">Item1</a></li>
                                <li><a href="{{ route('approver.index') }}">Item2</a></li>
                            </ul>
                        </li>
                    @endif

                    @if(Auth::user()->is_signer)
                        <li class="dropdown">
                            <a href="{{ route('signer.index') }}" class="dropdown-toggle" data-toggle="dropdown"
                               role="button" aria-expanded="false">Signer<span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ route('signer.index') }}">Item1</a></li>
                                <li><a href="{{ route('signer.index') }}">Item2</a></li>
                            </ul>
                        </li>
                    @endif

                    @if(Auth::user()->is_admin)
                        <li class="dropdown">
                            <a href="{{ route('admin.index') }}" class="dropdown-toggle" data-toggle="dropdown"
                               role="button" aria-expanded="false">Admin<span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ route('admin.users.index') }}">Users</a></li>
                                <li><a href="{{ route('admin.roles.index') }}">Roles</a></li>
                                <li><a href="{{ route('admin.permissions.index') }}">Permissions</a></li>
                            </ul>
                        </li>
                    @endif


                </ul>
            @endif

            <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                    <li><a href="{{ url('/auth/login') }}">Login</a></li>
                    <li><a href="{{ url('/auth/register') }}">Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false">{{ (Auth::user()->display_name .'('. Auth::user()->name .')') }} <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/auth/logout') }}">Logout</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ route('profile.edit') }}">Profile</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>