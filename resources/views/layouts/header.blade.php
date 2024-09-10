<nav class="navbar navbar-expand-lg bg-shadow px-2" style="margin-bottom: 37px;">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('assets/icons/ET-logo-en.png') }}" alt="Logo" style="width: 30px; margin-bottom: 8px;">
            {{ config('app.name') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link fw-semibold" href="https://portal.etc-network.uz">@lang('admin.Portal')</a>
                </li>

                @if (Auth::user()->role == 1)
                    <li class="nav-item dropdown">
                        <a class="nav-link fw-semibold dropdown-toggle" href="#" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-regular fa-gear"></i> Administrator
                        </a>
                        <ul class="dropdown-menu">
                            <li class="nav-item">
                                <a class="dropdown-item fw-semibold {{ Request::segment(2) === 'users' ? 'menu-active' : '' }}" href="{{ route('admin.user.index') }}">
                                    Users
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item fw-semibold {{ Request::segment(2) === 'roads' ? 'menu-active' : '' }}" href="{{ route('admin.road.index') }}">
                                    Roads
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item fw-semibold {{ Request::segment(2) === 'instances' ? 'menu-active' : '' }}" href="{{ route('admin.instance.index') }}">
                                    Instances
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item fw-semibold {{ Request::segment(2) === 'road-map' ? 'menu-active' : '' }}" href="{{ route('admin.road-map.index') }}">
                                   Road map
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link fw-semibold hover" href="{{ route('order.index') }}">Order</a>
                </li>
            </ul>
{{--            {!! \App\Facades\MenuServiceFacade::showMenu() !!}--}}

            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link fw-bold-600 js_employee" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#employeeModal">
                        {{ auth()->user()->position }} : {{ auth()->user()->name }}
                    </a>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle nav-link fw-semibold" href="" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        <i class="fa-solid fa-earth-asia"></i> @lang('admin.Language')
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item fw-semibold @if(App::isLocale('en')) active @endif"
                               href="{{ route('locale', ['en']) }}">
                                <i class="flag-icon flag-icon-uz"></i>
                                <img src="{{ asset('assets/img/usa-flag.png') }}"
                                     class="lang-flag" alt="usa-flag"/> {{ __("admin.English") }}
                            </a>
                        </li>
                        <li><a class="dropdown-item fw-semibold @if(App::isLocale('ru')) active @endif"
                               href="{{ route('locale', ['ru']) }}">
                                <i class="flag-icon flag-icon-ru"></i><img
                                    src="{{ asset('assets/img/russian-flag.png') }}" class="lang-flag"
                                    alt="russian-flag"/> {{ __("admin.Russian") }}</a>
                        </li>
                    </ul>
                </li>
                <!-- Authentication Links -->

                <a class="nav-link fw-semibold" href="" onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                    <i class="fa-solid fa-right-from-bracket"></i> @lang('admin.Sign out')
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>

            </ul>
        </div>

    </div>
</nav>
