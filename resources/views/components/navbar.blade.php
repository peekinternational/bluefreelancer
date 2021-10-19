<header class="pb-5">
    <nav class="navbar navbar-expand-lg navbar-light fixed-top bg-white shadow-sm py-1">
        <div class="container">
            <div class="navbar-brand">
                <a href="/">
                    <img src="{{ url('assets/img/logo/logo.png') }}" width="256" alt="Bluefreelancer">
                </a>
            </div>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item mr-lg-3">
                    <a href="{{ route('login') }}"
                        class="nav-link font-size-sm text-white bg-secondary rounded-sm py-2 px-3">
                        <i class="fa fa-lock mr-2" aria-hidden="true"></i>
                        {{ __('login') }}
                    </a>
                </li>
                <li class="nav-item d-none d-lg-block mr-lg-3">
                    <a href="{{ route('register') }}"
                        class="nav-link font-size-sm text-white bg-dark rounded-sm py-2 px-3">
                        <i class="fa fa-key mr-2" aria-hidden="true"></i>
                        {{ __('signup') }}
                    </a>
                </li>
                <li class="nav-item d-none d-lg-block">
                    <a href="{{ url('/login') }}"
                        class="nav-link font-size-sm text-white bg-primary rounded-sm py-2 px-3">
                        <i class="fa fa-file mr-2" aria-hidden="true"></i>
                        {{ __('postAProject') }}
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header>
