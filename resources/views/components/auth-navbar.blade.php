<header class="pb-5">
    <div class="fixed-top bg-gray-800 shadow-sm">
        <nav class="navbar navbar-expand-lg navbar-dark py-1">
            <div class="container">
                <div class="navbar-brand">
                    <a href="/">
                        <img src="{{ url('assets/img/logo/logo-light.png') }}" width="256" alt="Bluefreelancer">
                    </a>
                </div>

                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav font-size-ms">
                        <li class="nav-item dropdown dropdown-hover">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-user mr-1" aria-hidden="true"></i>
                                {{ __('client') }}
                            </a>

                            <div class="dropdown-menu py-4">
                                <div
                                    class="font-size-sm font-weight-bold text-center text-success-alt text-uppercase pt-1 pb-2">
                                    <i class="fa fa-search mr-2"></i>
                                    {{ __('findFreelancer') }}
                                </div>

                                <a href="{{ route('post-project') }}" class="dropdown-item border-bottom border-light">
                                    <i class="fa fa-tasks mr-2"></i>
                                    {{ __('startProject') }}
                                </a>
                                <a href="{{ route('post-contest') }}" class="dropdown-item border-bottom border-light">
                                    <i class="fa fa-hourglass-start mr-2"></i>
                                    {{ __('startContest') }}
                                </a>
                                <a href="{{ route('showcase.index') }}"
                                    class="dropdown-item border-bottom border-light">
                                    <i class="fa fa-picture-o mr-2"></i>
                                    {{ __('showcase') }}
                                </a>
                                <a href="/browse/directory" class="dropdown-item">
                                    <i class="fa fa-mouse-pointer mr-2"></i>
                                    {{ __('browseDirectory') }}
                                </a>
                            </div>
                        </li>

                        <li class="nav-item dropdown dropdown-hover">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-handshake-o mr-1" aria-hidden="true"></i>
                                {{ __('helper') }}
                            </a>

                            <div class="dropdown-menu py-4">
                                <div
                                    class="font-size-sm font-weight-bold text-center text-success-alt text-uppercase pt-1 pb-2">
                                    <i class="fa fa-search-plus mr-2"></i>
                                    {{ __('findWork') }}
                                </div>

                                <a href="{{ route('project-listing') }}"
                                    class="dropdown-item border-bottom border-light">
                                    <i class="fa fa-tasks mr-2"></i>
                                    {{ __('browseProject') }}
                                </a>
                                <a href="{{ route('contest-listing') }}"
                                    class="dropdown-item border-bottom border-light">
                                    <i class="fa fa-hourglass-start mr-2"></i>
                                    {{ __('browseContest') }}
                                </a>
                                <a href="{{ route('showcase.index') }}"
                                    class="dropdown-item border-bottom border-light">
                                    <i class="fa fa-picture-o mr-2"></i>
                                    {{ __('showcase') }}
                                </a>
                                <a href="/browse/category" class="dropdown-item">
                                    <i class="fa fa-mouse-pointer mr-2"></i>
                                    {{ __('browseCategories') }}
                                </a>
                            </div>
                        </li>

                        <li class="nav-item dropdown dropdown-hover">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-tasks mr-1" aria-hidden="true"></i>
                                {{ __('myProject') }}
                            </a>

                            <div class="dropdown-menu py-4">
                                <div
                                    class="font-size-sm font-weight-bold text-center text-success-alt text-uppercase pt-1 pb-2">
                                    <i class="fa fa-user-circle-o mr-2"></i>
                                    {{ __('manage') }}
                                </div>

                                <a href="{{ route('my-project.employer.open-projects') }}"
                                    class="dropdown-item border-bottom border-light">
                                    <i class="fa fa-tasks mr-2"></i>
                                    {{ __('myProject') }}
                                </a>
                                <a href="/dashboard" class="dropdown-item border-bottom border-light">
                                    <i class="fa fa-th-large mr-2"></i>
                                    {{ __('dashboard') }}
                                </a>
                                <a href="{{ route('inbox') }}" target="_blank" class="dropdown-item">
                                    <i class="fa fa-envelope mr-2"></i>
                                    {{ __('inbox') }}
                                </a>
                            </div>
                        </li>

                        <li class="nav-item dropdown dropdown-hover">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-life-bouy mr-1" aria-hidden="true"></i>
                                {{ __('getSupport') }}
                            </a>

                            <div class="dropdown-menu py-4">
                                <div
                                    class="font-size-sm font-weight-bold text-center text-success-alt text-uppercase pt-1 pb-2">
                                    <i class="fa fa-life-bouy mr-2"></i>
                                    {{ __('getHelp') }}
                                </div>

                                <a href="/support" class="dropdown-item border-bottom border-light">
                                    <i class="fa fa-tasks mr-2"></i>
                                    {{ __('getSupport') }}
                                </a>
                                <a href="/how-to-use" class="dropdown-item border-bottom border-light">
                                    <i class="fa fa-th-large mr-2"></i>
                                    {{ __('howToUse') }}
                                </a>
                                <a href="/fee-and-charge" class="dropdown-item">
                                    <i class="fa fa-envelope mr-2"></i>
                                    {{ __('feesAndCharges') }}
                                </a>
                            </div>
                        </li>
                    </ul>

                    <ul class="navbar-nav font-size-ms ml-auto">
                        <li class="nav-item dropdown dropdown-hover">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-dollar mr-1" aria-hidden="true"></i>
                                @if (App\Models\User::walletAmt())
                                {{ App\Models\User::walletAmt()->amt }}
                                @else
                                0.0
                                @endif
                            </a>

                            <div class="dropdown-menu py-4">
                                <div
                                    class="font-size-sm font-weight-bold text-center text-success-alt text-uppercase pt-1 pb-2">
                                    <i class="fa fa-money mr-2"></i>
                                    {{__('balance')}}
                                </div>

                                <div class="font-size-sm font-weight-medium text-white-75 text-uppercase py-1 px-4">
                                    <span class="text-white mr-2 pr-1">$</span>
                                    @if (App\Models\User::walletAmt())
                                    {{ App\Models\User::walletAmt()->amt }}
                                    @else
                                    0.0
                                    @endif
                                </div>
                                <div
                                    class="font-size-sm font-weight-medium text-white-75 text-uppercase py-1 px-4 mb-2">
                                    <span class="text-white mr-2 pr-1">₩</span>
                                    00.00
                                </div>

                                <div
                                    class="font-size-sm font-weight-bold text-center text-success-alt text-uppercase py-2">
                                    <i class="fa fa-sliders mr-2"></i>
                                    {{__('manage')}}
                                </div>

                                <a href="{{ route('payment.deposit.paypal') }}"
                                    class="dropdown-item border-bottom border-light">
                                    <i class="fa fa-credit-card mr-2"></i>
                                    {{__('deposit')}}
                                </a>
                                <a href="{{route('withdraw')}}" class="dropdown-item border-bottom border-light">
                                    <i class="fa fa-repeat mr-2"></i>
                                    {{__('withdraw')}}
                                </a>
                                <a href="{{route('financial-dashboard.employer')}}"
                                    class="dropdown-item border-bottom border-light">
                                    <i class="fa fa-th-large mr-2"></i>
                                    {{__('financialDashboard')}}
                                </a>
                                <a href="{{route('transaction-history.deposit')}}"
                                    class="dropdown-item border-bottom border-light">
                                    <i class="fa fa-clock-o mr-2"></i>
                                    {{__('transcation')}}
                                </a>
                                <a href="./verify-payment.html" class="dropdown-item">
                                    <i class="fa fa-shield mr-2"></i>
                                    {{__('verifyPayment')}}
                                </a>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a href="#searchCollapse" class="nav-link" data-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="searchCollapse">
                                <i class="fa fa-search font-size-lg" aria-hidden="true"></i>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('inbox') }}" target="_blank"
                                class="nav-link dropdown-toggle no-caret position-relative">
                                <i class="fa fa-comments font-size-lg" aria-hidden="true"></i>
                                <span class="badge badge-danger messageCount badge-notification badge-pill">{{
                                    App\Models\ChatMessages::getUnseenMsg() }}</span>
                            </a>
                        </li>

                        <li class="nav-item dropdown dropdown-hover">
                            <a href="#" class="nav-link dropdown-toggle no-caret" data-toggle="dropdown">
                                <i class="fa fa-bell font-size-lg" aria-hidden="true"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right py-4">
                                <div
                                    class="font-size-sm font-weight-bold text-center text-success-alt text-uppercase pt-1 pb-3">
                                    <i class="fa fa-bell-o mr-2"></i>
                                    {{__('notification')}}
                                </div>

                                <div class="overflow-auto" style="height: 15rem;">
                                    @if (App\Models\Notification::count())
                                    @foreach (App\Models\Notification::orderByDesc('created_at')->get() as $item)
                                    @if ($item->to == auth()->id())
                                    <a href="#" class="dropdown-item border-top border-light position-relative px-3">
                                        <i class="fa fa-bell-o mr-2"></i>
                                        <small>(From
                                            {{ App\Models\User::find($item->from)->username }})</small>
                                        {{ $item->message }}
                                        <br>
                                        <small>{{ $item->created_at->format('M d, Y - H:i:s') }}</small>
                                    </a>
                                    @endif
                                    @endforeach
                                    @else
                                    <span>{{__('noNotification')}}</span>
                                    @endif

                                </div>
                            </div>
                        </li>

                        <li class="nav-item dropdown dropdown-hover">
                            <a href="#" class="nav-link dropdown-toggle no-caret" data-toggle="dropdown">
                                <i class="fa fa-rss font-size-lg" aria-hidden="true"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right py-4">
                                <div
                                    class="font-size-sm font-weight-bold text-center text-success-alt text-uppercase pt-1 pb-3">
                                    <i class="fa fa-rss mr-2"></i>
                                    {{__('projectFeed')}}
                                </div>

                                <div class="overflow-auto" style="height: 15rem;">
                                    @if (App\Models\Project::count())
                                    @foreach(App\Models\Project::orderByDesc('created_at')->limit(10)->get(['project_id',
                                    'title'])
                                    as $item)
                                    <a href="{{ route('project.show', $item->project_id) }}"
                                        class="dropdown-item border-top border-light position-relative p-3">
                                        <i class="fa fa-desktop font-size-lg align-middle mr-2"></i>
                                        {{ $item->title }}
                                    </a>
                                    @endforeach
                                    @else
                                    <span class="text-danger">{{__('noProjectFeed')}}</span>
                                    @endif
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="dropdown ml-2">
                    <a class="avatar-link dropdown-toggle font-size-ms" href="#" data-toggle="dropdown">
                        <img class="rounded-circle mr-1"
                            src="{{ auth()->user()->img == '' ? url('assets/img/pages/default.png') : url('uploads/users/' . auth()->id() . '/images/' . auth()->user()->img) }}"
                            width="28">
                        {{ auth()->user()->username }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-avatar py-4">
                        <div class="font-size-sm font-weight-bold text-center pt-1 pb-3">
                            <img class="d-block avatar-bordered rounded-circle mx-auto mb-3"
                                src="{{ auth()->user()->img == '' ? url('assets/img/pages/default.png') : url('uploads/users/' . auth()->id() . '/images/' . auth()->user()->img) }}"
                                width="112">
                            <h6 class="text-white">{{ auth()->user()->name }}</h6>
                        </div>

                        <a href="{{ route('profile') }}" class="dropdown-item border-top border-light">
                            <i class="fa fa-user mr-2"></i>
                            {{__('profile')}}
                        </a>
                        <a href="{{ route('/setting/profile') }}" class="dropdown-item border-top border-light">
                            <i class="fa fa-gear mr-2"></i>
                            {{__('setting')}}
                        </a>
                        <a href="./support.html" class="dropdown-item border-top border-light">
                            <i class="fa fa-info-circle mr-2"></i>
                            {{__('getSupport')}}
                        </a>
                        <a href="{{ route('logout') }}" class="dropdown-item border-top border-light">
                            <i class="fa fa-sign-out mr-2"></i>
                            {{__('logout')}}
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <div class="collapse w-100 bg-gray-800 shadow-sm pb-2" id="searchCollapse">
            <div class="container">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text bg-white">
                            <i class="fa fa-search"></i>
                        </div>
                    </div>
                    <input type="text" class="form-control">
                </div>
            </div>
        </div>
    </div>
</header>