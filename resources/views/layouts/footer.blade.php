<!-- Footer -->
<footer class="bg-darker">
    <div class="border-bottom border-light py-5">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-6 col-md-4 col-lg-2 mb-4 mb-lg-0">
                    <h3 class="h5 font-weight-bold text-light mb-0">46,320</h3>
                    <div class="font-size-sm">
                        <small class="text-light text-uppercase op-75">{{ __('REGISTEREDUSERS') }}</small>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-2 mb-4 mb-lg-0">
                    <h3 class="h5 font-weight-bold text-light mb-0">11,832</h3>
                    <div class="font-size-sm">
                        <small class="text-light text-uppercase op-75">{{ __('TOTALJOBSPOSTED') }}</small>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-2 mb-4 mb-md-0">
                    <div class="d-flex">
                        <select class="form-control" onchange="window.location.href=this.value;">
                            <option {{ session()->get('lang') == 'en' ? 'selected' : '' }}
                                value="{{ route('locale', 'en') }}">English</option>
                            <option {{ session()->get('lang') == 'kr' ? 'selected' : '' }}
                                value="{{ route('locale', 'kr') }}">Korean</option>
                        </select>
                        @if (session()->get('lang') == 'en')
                            <img src="{{ url('assets/img/flags/america-flag.png') }}" width="40">
                        @elseif (session()->get('lang') == 'kr')
                            <img src="{{ url('assets/img/flags/korean-flag.png') }}" width="40">
                        @else
                            <img src="{{ url('assets/img/flags/america-flag.png') }}" width="40">

                        @endif
                    </div>
                </div>
                <div class="col-md-12 col-lg-5 text-left text-lg-right">
                    <div class="d-inline-flex align-items-center">
                        <a class="mr-1" href="#">
                            <img src="{{ url('assets/img/brands/apple-app.svg') }}" width="135" alt="Apple App Store">
                        </a>
                        <a class="mr-1" href="#">
                            <img src="{{ url('assets/img/brands/google-play.svg') }}" width="135"
                                alt="Google Play Store">
                        </a>
                        <span class="d-inline-flex border border-gray rounded p-2">
                            <img src="{{ url('assets/img/brands/logo.png') }}" width="100" alt="Job Call Me">
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="py-5">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-sm-6 col-md-3 col-lg-2 pb-4 mb-3">
                    <h3 class="h6 font-weight-bold text-light pb-3">{{ __('Network') }}</h3>
                    <ul class="nav nav-light flex-column font-size-sm">
                        <li>
                            <a class="nav-link" href="/showcases.html">{{ __('showcase') }}</a>
                        </li>
                        <li>
                            <a class="nav-link"
                                href="/projects/project-list.html">{{ __('browseProject') }}</a>
                        </li>
                        <li>
                            <a class="nav-link"
                                href="/contests/contest-list.html">{{ __('browseContest') }}</a>
                        </li>
                        <li>
                            <a class="nav-link" href="/outsoucers.html">{{ __('UserDirectory') }}</a>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-6 col-md-3 col-lg-3 pl-md-4 pl-lg-5 pb-4 mb-3">
                    <h3 class="h6 font-weight-bold text-light pb-3">{{ __('AboutOutsourcingOk') }}</h3>
                    <ul class="nav nav-light flex-column font-size-sm">
                        <li>
                            <a class="nav-link" href="/about/overview.html">{{ __('AboutUs') }}</a>
                        </li>
                        <li>
                            <a class="nav-link" href="/about/outsource.html">{{ __('HowItWorks') }}</a>
                        </li>
                        <li>
                            <a class="nav-link" href="/about/feesandcharges.html">{{ __('FeeandCharges') }}</a>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-6 col-md-3 col-lg-3 pl-md-4 pl-lg-5 pb-4 mb-3">
                    <h3 class="font-weight-bold h6 text-light pb-3">{{ __('GetInTouch') }}</h3>
                    <ul class="nav nav-light flex-column font-size-sm">
                        <li>
                            <a class="nav-link" href="/showcases.html">{{ __('showcase') }}</a>
                        </li>
                        <li>
                            <a class="nav-link" href="/projects/project-list.html">{{ __('browseProject') }}</a>
                        </li>
                        <li>
                            <a class="nav-link" href="/contests/contest-list.html">{{ __('browseContest') }}</a>
                        </li>
                        <li>
                            <a class="nav-link" href="/outsoucers.html">{{ __('UserDirectory') }}</a>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-6 col-md-3 col-lg-2 pl-md-4 pl-lg-5 pb-4 mb-3">
                    <h3 class="font-weight-bold h6 text-light pb-3">{{ __('Terms') }}</h3>
                    <ul class="nav nav-light flex-column font-size-sm">
                        <li>
                            <a class="nav-link" href="/showcases.html">{{ __('showcase') }}</a>
                        </li>
                        <li>
                            <a class="nav-link" href="/projects/project-list.html">{{ __('browseProject') }}</a>
                        </li>
                        <li>
                            <a class="nav-link" href="/contests/contest-list.html">{{ __('browseContest') }}</a>
                        </li>
                        <li>
                            <a class="nav-link" href="/outsoucers.html">{{ __('UserDirectory') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="font-size-sm text-white-75 text-left text-md-center">
                <p class="mb-1"><span>{{ __('CustomerService') }}</span> 070-7770-0967 |
                    <span>{{ __('OpeningHours') }}</span> | Fax +822 2058-0138 | <a class="text-light"
                        href="https://www.bluefreelancer.com">admin@bluefreelancer.com</a></p>
                <p class="mb-1"><span>{{ __('jobCallme') }}</span> | <span>{{ __('CEO') }}</span> |
                    <span>{{ __('addressCompany') }}</span></p>
                <p class="mb-1"><span>{{ __('PersonalInformationManager') }}</span> |
                    <span>{{ __('CompanyRegistrationNumber') }}</span>
                    201-86-41011 <span class="d-block d-md-inline-block ml-md-2 my-2 my-md-0"><a
                            class="btn btn-info btn-sm"
                            href="https://www.ftc.go.kr/info/bizinfo/communicationView.jsp?apv_perm_no=2014321012130201367&amp;area1=&amp;area2=&amp;currpage=1&amp;searchKey=04&amp;searchVal=2018641011&amp;stdate=&amp;enddate="
                            target="_blank">{{ __('ConfirmCarrierInformation') }}</a></span></p>
                <p class="mb-1"><span>{{ __('CommunicationOnLine') }}</span> 2014-<span translate="Seocho"
                        class="ng-scope">{{ __('Seocho') }}</span>-1367</p>
                <p class="mb-1">직업정보제공사업 신고번호 서울청 제2017-26호</p>
                <p class="mb-1">Copyright © bluefreelancer.com</p>
            </div>
        </div>
    </div>
</footer>
