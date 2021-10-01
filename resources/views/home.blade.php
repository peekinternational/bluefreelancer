@extends('layouts.app')
@section('content')
    <div class="bg-primary text-center py-5">
        <h1 class="text-white py-4">
            <strong>Need Help?</strong>
            <small class="d-block h4 font-weight-normal mt-2 mb-0">Bluefreelancer will solve it now.</small>
        </h1>
    </div>

    <section class="container py-5 my-3 my-md-4">
        <h2 class="h4 font-weight-bold pb-4">Project selection by type</h2>

        <div class="row pb-4 mb-2">
            <div class="col-sm-6 col-lg-4 col-xl-3 mb-4">
                <div class="card card-hover card-overlay bg-secondary border-0 h-100">
                    <img src="{{ url('assets/img/pages/home/website-developmnts.jpg') }}" class="card-img-top">
                    <div class="overlay-hidden d-flex flex-column justify-content-center text-center py-4 px-5">
                        <h3 class="h5 text-white mb-4"><strong>Website Development</strong></h3>
                        <a class="btn btn-sm btn-outline-light" href="/post-project">Post a
                            project
                            like this</a>
                    </div>
                    <div class="overlay-visible text-white p-3">
                        <p class="font-size-sm font-weight-bold mb-4">Web site · Information · Software</p>
                    </div>
                    <div class="card-body text-white p-3">
                        <ul class="list-unstyled row font-size-xxs mb-0">
                            <li class="col-lg-4 pr-lg-2 mb-2">Web site construction</li>
                            <li class="col-lg-4 px-lg-2 mb-2">Shopping mall construction</li>
                            <li class="col-lg-4 pl-lg-2 mb-2">Software</li>
                            <li class="col-lg-4 pr-lg-2 mb-2 mb-lg-0">Website design</li>
                            <li class="col-lg-4 px-lg-2 mb-2 mb-lg-0">WordPress template</li>
                            <li class="col-lg-4 pl-lg-2 mb-2 mb-lg-0">Other</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-4 col-xl-3 mb-4">
                <div class="card card-hover card-overlay bg-secondary border-0 h-100">
                    <img src="{{ url('assets/img/pages/home/website-designs.jpg') }}" height="177" class="card-img-top">
                    <div class="overlay-hidden d-flex flex-column justify-content-center text-center py-4 px-5">
                        <h3 class="h5 text-white mb-4"><strong>Web Designer</strong></h3>
                        <a class="btn btn-sm btn-outline-light" href="/post-project">Post a
                            similar
                            contest</a>
                    </div>
                    <div class="overlay-visible text-white p-3">
                        <p class="font-size-sm font-weight-bold mb-4">Design · Media · Architecture</p>
                    </div>
                    <div class="card-body text-white p-3">
                        <ul class="list-unstyled row font-size-xxs mb-0">
                            <li class="col-lg-4 pr-lg-2 mb-2">Website design</li>
                            <li class="col-lg-4 px-lg-2 mb-2">Video Creation</li>
                            <li class="col-lg-4 pl-lg-2 mb-2">Advertising Design</li>
                            <li class="col-lg-4 pr-lg-2 mb-2 mb-lg-0">Fashion · Accessories</li>
                            <li class="col-lg-4 px-lg-2 mb-2 mb-lg-0">Package design</li>
                            <li class="col-lg-4 pl-lg-2 mb-2 mb-lg-0">Other</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-4 col-xl-3 mb-4">
                <div class="card card-hover card-overlay bg-secondary border-0 h-100">
                    <img src="{{ url('assets/img/pages/home/product-sourcing.jpg') }}" class="card-img-top">
                    <div class="overlay-hidden d-flex flex-column justify-content-center text-center py-4 px-5">
                        <h3 class="h5 text-white mb-4"><strong>Product Sourcing · Manufacturing</strong></h3>
                        <a class="btn btn-sm btn-outline-light" href="/post-project">Post a
                            project
                            like this</a>
                    </div>
                    <div class="overlay-visible text-white p-3">
                        <p class="font-size-sm font-weight-bold mb-4">Product Sourcing · Manufacturing</p>
                    </div>
                    <div class="card-body text-white p-3">
                        <ul class="list-unstyled row font-size-xxs mb-0">
                            <li class="col-lg-4 pr-lg-2 mb-2">Product design</li>
                            <li class="col-lg-4 px-lg-2 mb-2">Manufacturing search</li>
                            <li class="col-lg-4 pl-lg-2 mb-2">Buyer search</li>
                            <li class="col-lg-4 pr-lg-2 mb-2 mb-lg-0">Custom product</li>
                            <li class="col-lg-4 px-lg-2 mb-2 mb-lg-0">Package design</li>
                            <li class="col-lg-4 pl-lg-2 mb-2 mb-lg-0">Other</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-4 col-xl-3 mb-4">
                <div class="card card-hover card-overlay bg-secondary border-0 h-100">
                    <img src="{{ url('assets/img/pages/home/mobile-apps.jpg') }}" class="card-img-top">
                    <div class="overlay-hidden d-flex flex-column justify-content-center text-center py-4 px-5">
                        <h3 class="h5 text-white mb-4"><strong>Mobile Apps</strong></h3>
                        <a class="btn btn-sm btn-outline-light" href="/post-project">Post a
                            project
                            like this</a>
                    </div>
                    <div class="overlay-visible text-white p-3">
                        <p class="font-size-sm font-weight-bold mb-4">Mobile phone · computing</p>
                    </div>
                    <div class="card-body text-white p-3">
                        <ul class="list-unstyled row font-size-xxs mb-0">
                            <li class="col-lg-4 pr-lg-2 mb-2">IOS app</li>
                            <li class="col-lg-4 px-lg-2 mb-2">Taizen app</li>
                            <li class="col-lg-4 pl-lg-2 mb-2">iPad app</li>
                            <li class="col-lg-4 pr-lg-2 mb-2 mb-lg-0">Android app</li>
                            <li class="col-lg-4 px-lg-2 mb-2 mb-lg-0">Mobile web build</li>
                            <li class="col-lg-4 pl-lg-2 mb-2 mb-lg-0">Other</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-4 col-xl-3 mb-4">
                <div class="card card-hover card-overlay bg-secondary border-0 h-100">
                    <img src="{{ url('assets/img/pages/home/article-writings.jpg') }}" class="card-img-top">
                    <div class="overlay-hidden d-flex flex-column justify-content-center text-center py-4 px-5">
                        <h3 class="h5 text-white mb-4"><strong>Article Writing</strong></h3>
                        <a class="btn btn-sm btn-outline-light" href="/post-project">Post a
                            similar
                            contest</a>
                    </div>
                    <div class="overlay-visible text-white p-3">
                        <p class="font-size-sm font-weight-bold mb-4">Writing · Contents</p>
                    </div>
                    <div class="card-body text-white p-3">
                        <ul class="list-unstyled row font-size-xxs mb-0">
                            <li class="col-lg-4 pr-lg-2 mb-2">Technical report writing</li>
                            <li class="col-lg-4 px-lg-2 mb-2">Blog posting</li>
                            <li class="col-lg-4 pl-lg-2 mb-2">Editing</li>
                            <li class="col-lg-4 pr-lg-2 mb-2 mb-lg-0">SEO</li>
                            <li class="col-lg-4 px-lg-2 mb-2 mb-lg-0">Product documentation</li>
                            <li class="col-lg-4 pl-lg-2 mb-2 mb-lg-0">Other</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-4 col-xl-3 mb-4">
                <div class="card card-hover card-overlay bg-secondary border-0 h-100">
                    <img src="{{ url('assets/img/pages/home/website-developmnts.jpg') }}" class="card-img-top">
                    <div class="overlay-hidden d-flex flex-column justify-content-center text-center py-4 px-5">
                        <h3 class="h5 text-white mb-4"><strong>SEO (Search Engine Optimization) Marketing</strong></h3>
                        <a class="btn btn-sm btn-outline-light" href="/post-project">Post a
                            project like this</a>
                    </div>
                    <div class="overlay-visible text-white p-3">
                        <p class="font-size-sm font-weight-bold mb-4">Data entry · Management</p>
                    </div>
                    <div class="card-body text-white p-3">
                        <ul class="list-unstyled row font-size-xxs mb-0">
                            <li class="col-lg-4 pr-lg-2 mb-2">Articles · Data submission</li>
                            <li class="col-lg-4 px-lg-2 mb-2">Data analysis</li>
                            <li class="col-lg-4 pl-lg-2 mb-2">Ad registration</li>
                            <li class="col-lg-4 pr-lg-2 mb-2 mb-lg-0">Spreadsheet creation</li>
                            <li class="col-lg-4 px-lg-2 mb-2 mb-lg-0">Excel creation</li>
                            <li class="col-lg-4 pl-lg-2 mb-2 mb-lg-0">Other</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-4 col-xl-3 mb-4">
                <div class="card card-hover card-overlay bg-secondary border-0 h-100">
                    <img src="{{ url('assets/img/pages/home/artificial-intelligence.jpg') }}" class="card-img-top">
                    <div class="overlay-hidden d-flex flex-column justify-content-center text-center py-4 px-5">
                        <h3 class="h5 text-white mb-4"><strong>Artificial intelligence</strong></h3>
                        <a class="btn btn-sm btn-outline-light" href="/post-project">Post a
                            project like this</a>
                    </div>
                    <div class="overlay-visible text-white p-3">
                        <p class="font-size-sm font-weight-bold mb-4">Engineering · Science</p>
                    </div>
                    <div class="card-body text-white p-3">
                        <ul class="list-unstyled row font-size-xxs mb-0">
                            <li class="col-lg-4 pr-lg-2 mb-2">Nanotechnology</li>
                            <li class="col-lg-4 px-lg-2 mb-2">Robotics</li>
                            <li class="col-lg-4 pl-lg-2 mb-2">Unmanned airplane</li>
                            <li class="col-lg-4 pr-lg-2 mb-2 mb-lg-0">Internet of things</li>
                            <li class="col-lg-4 px-lg-2 mb-2 mb-lg-0">Artificial intelligence</li>
                            <li class="col-lg-4 pl-lg-2 mb-2 mb-lg-0">Other</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-4 col-xl-3 mb-4">
                <div class="card card-hover card-overlay bg-secondary border-0 h-100">
                    <img src="{{ url('assets/img/pages/home/translations.jpg') }}" class="card-img-top">
                    <div class="overlay-hidden d-flex flex-column justify-content-center text-center py-4 px-5">
                        <h3 class="h5 text-white mb-4"><strong>Interpretation / translation</strong></h3>
                        <a class="btn btn-sm btn-outline-light" href="/post-project">Post a project like this</a>
                    </div>
                    <div class="overlay-visible text-white p-3">
                        <p class="font-size-sm font-weight-bold mb-4">Translation · Interpretation · Language</p>
                    </div>
                    <div class="card-body text-white p-3">
                        <ul class="list-unstyled row font-size-xxs mb-0">
                            <li class="col-lg-4 pr-lg-2 mb-2">English</li>
                            <li class="col-lg-4 px-lg-2 mb-2">Japanese</li>
                            <li class="col-lg-4 pl-lg-2 mb-2">Simplified · Chinese</li>
                            <li class="col-lg-4 pr-lg-2 mb-2 mb-lg-0">Traditional · Chinese</li>
                            <li class="col-lg-4 px-lg-2 mb-2 mb-lg-0">Spanish</li>
                            <li class="col-lg-4 pl-lg-2 mb-2 mb-lg-0">Other</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4 mx-auto">
            <a class="btn btn-sm btn-secondary btn-block py-2" href="/browse/category">Browse Categories</a>
        </div>
    </section>

    <section class="container">
        <div class="bg-cover bg-positon-lc text-center rounded p-5"
            style="background-image: url({{ url('assets/img/pages/home/banner-1.jpg') }});">
            <h3 class="h5 font-weight-bold text-white">You can check the work or the work to be performed in the project /
                contest in real time!</h3>
            <p class="text-white mb-0">Bluefreelancer puts your trust and safety first, and all transactions for your
                escrow
                funds are secured in real time with state-of-the-art SSL encryption.</p>
        </div>
    </section>

    <section class="container py-5 my-3 my-md-4">
        <div class="row flex-row-reverse">
            <div class="col-lg-6 text-lg-right mb-4">
                <img src="{{ url('assets/img/pages/home/illustration-1.png') }}" alt="Contest illustration">
            </div>

            <div class="col-lg-6">
                <h3 class="h4 pb-4"><strong>Secure project ㆍ Contest management</strong></h3>

                <div class="font-size-sm">
                    <p class="mb-2">
                        <i class="fa fa-hand-o-right mr-2"></i>
                        <span>Bluefreelancer, your trust and safety are top priority.</span>
                    </p>
                    <p class="mb-2">
                        <i class="fa fa-hand-o-right mr-2"></i>
                        <span>Real-time fund management status is safeguarded by escrow.</span>
                    </p>
                    <p class="mb-2">
                        <i class="fa fa-hand-o-right mr-2"></i>
                        <span>Freelancers can solve all your ideas right away.</span>
                    </p>
                    <p class="mb-2">
                        <i class="fa fa-hand-o-right mr-2"></i>
                        <span>Anyone can easily register projects in all fields.</span>
                    </p>
                    <p class="mb-2">
                        <i class="fa fa-hand-o-right mr-2"></i>
                        <span>You can get inspiration and help from many professional freelancers.</span>
                    </p>
                    <p class="mb-2">
                        <i class="fa fa-hand-o-right mr-2"></i>
                        <span>The holding of a contest becomes one step up business.</span>
                    </p>
                    <p class="mb-2">
                        <i class="fa fa-hand-o-right mr-2"></i>
                        <span>Freelancer will fix it immediately after registering a project or contest.</span>
                    </p>
                    <p class="mb-2">
                        <i class="fa fa-hand-o-right mr-2"></i>
                        <span>If you don't know how to register your project our</span>
                        <a href="/about/contact">customer support</a>
                        <span>team will help you.</span>
                    </p>
                    <p class="mb-2">
                        <i class="fa fa-hand-o-right mr-2"></i>
                        <span>The showcase mall allows you to purchase and consult quickly.</span>
                    </p>
                    <p class="mb-2">
                        <i class="fa fa-hand-o-right mr-2"></i>
                        <span>All this runs on a fully automated multi-platform and 1: 1 image.</span>
                    </p>

                    <ul class="py-3">
                        <li>Fixed amount or hourly selection</li>
                        <li>Special technology, cost and schedule requirements available</li>
                        <li>Free registration for all projects, regardless of size and amount</li>
                    </ul>

                    <p>
                        By registering the details of the project and the
                        contest, you will be able to receive a reasonable amount and complete results faster and more
                        accurately
                        than you would expect from a freelance client.
                    </p>
                    <p>
                        Projects can be registered as fixed amounts or time
                        periods, regardless of size, and contests can be registered as partial amounts to specify the budget
                        range and escrow that can be expended.
                    </p>
                </div>

                <div class="pt-3">
                    <button class="btn btn-secondary" href="/post-project">Start a Project</button>
                </div>
            </div>
        </div>
    </section>

    <section class="container">
        <h2 class="h4 font-weight-bold pb-4">Recently posted projects</h2>

        <div class="row">
            @if ($projects->count())
                @foreach ($projects as $key => $item)
                @php
                    $imgName = $key.'.jpg';
                @endphp
                    <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                        <div class="card card-hover bg-light h-100">
                            <img class="card-img-top" src="{{ url('assets/img/pages/projects/'.$imgName) }}"
                                alt="">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a class="stretched-link text-capitalize" href="#">{{ $item->title }}</a>
                                </h5>
                                <p class="card-text text-muted">{!! Illuminate\Support\Str::of($item->description)->limit(100) . '...' !!}</p>
                            </div>
                            <div class="card-footer text-warning-alt">
                                <span>
                                    @if ($item->min_budget && $item->max_budget)
                                        {{ $item->currency == 'USD' ? '$' : '₩' }} {{ $item->min_budget }} -
                                        {{ $item->currency == 'USD' ? '$' : '₩' }} {{ $item->max_budget }}
                                    @else
                                        @if ($item->rate_status == '1')
                                            {{ $item->fixed_rate }}
                                        @else
                                            {{ $item->hourly_rate . '/Hourly' }}
                                        @endif
                                    @endif
                                </span>
                                <span>{{ $item->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </section>

    <section class="container py-5">
        <h2 class="h4 font-weight-bold pb-4">Recently added contests</h2>

        <div class="row">
            @if ($contests->count())
                @foreach ($contests as $key => $item)
                @php
                    $imgName = $key.'.png';
                @endphp
                    <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                        <div class="card card-hover bg-light h-100">
                            <img class="card-img-top" src="{{ url('assets/img/pages/contests/'.$imgName) }}" alt="">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a class="stretched-link text-capitalize" href="#">{{ $item->title }}</a>
                                </h5>
                                <p class="card-text text-muted">{!! Illuminate\Support\Str::of($item->description)->limit(100) . '...' !!}</p>
                            </div>
                            <div class="card-footer text-warning-alt">
                                <span>{{$item->currency == 'USD' ? '$' : '₩'}}{{ $item->budget }}</span>
                                <span>{{ $item->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </section>
@endsection
