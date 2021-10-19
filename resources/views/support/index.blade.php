@extends('layouts.app')
@section('content')
    <div class="bg-secondary text-center bg-cover py-5"
        style="background-image: url({{ url('assets/img/pages/support/banner-1.jpg') }});">
        <div class="py-5 my-4">
            <div class="container py-4">
                <h1 class="h2 font-weight-bold text-white mb-4">{{ __('howMayWe') }}</h1>

                {{-- <div class="col-md-8 mx-auto">
                    <div class="bg-white border rounded-lg shadow p-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text border-0 bg-transparent">
                                    <i class="fa fa-search font-size-lg"></i>
                                </div>
                            </div>
                            <input class="form-control border-0" type="text" placeholder="Please search for questions...">
                            <button class="btn btn-primary">Search Help</button>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>

    <div class="container py-5 my-3 my-md-4">
        <div class="row">
            <div class="col-md-4 mb-4">
                <a class="card card-hover bg-primary bg-cover border-0 py-3" href="/support/show/General"
                    style="background-image: url({{ url('assets/img/pages/support/card-bg.svg') }});">
                    <div class="card-body text-center">
                        <i class="fa fa-gears display-4 text-white mb-3"></i>
                        <h4 class="text-white mb-0">{{ __('general') }}</h4>
                    </div>
                </a>
            </div>

            <div class="col-md-4 mb-4">
                <a class="card card-hover bg-danger bg-cover border-0 py-3" href="/support/show/Project"
                    style="background-image: url({{ url('assets/img/pages/support/card-bg.svg') }});">
                    <div class="card-body text-center">
                        <i class="fa fa-life-bouy display-4 text-white mb-3"></i>
                        <h4 class="text-white mb-0">{{ __('project') }}</h4>
                    </div>
                </a>
            </div>

            <div class="col-md-4 mb-4">
                <a class="card card-hover bg-warning bg-cover border-0 py-3" href="/support/show/Contest"
                    style="background-image: url({{ url('assets/img/pages/support/card-bg.svg') }});">
                    <div class="card-body text-center">
                        <i class="fa fa-wpforms display-4 text-white mb-3"></i>
                        <h4 class="text-white mb-0">{{ __('contest') }}</h4>
                    </div>
                </a>
            </div>

            <div class="col-md-4 mb-4">
                <a class="card card-hover bg-success bg-cover border-0 py-3" href="/support/show/Payment"
                    style="background-image: url({{ url('assets/img/pages/support/card-bg.svg') }});">
                    <div class="card-body text-center">
                        <i class="fa fa-money display-4 text-white mb-3"></i>
                        <h4 class="text-white mb-0">{{ __('paymentSetting') }}</h4>
                    </div>
                </a>
            </div>

            <div class="col-md-4 mb-4">
                <a class="card card-hover bg-info bg-cover border-0 py-3" href="/support/show/Membership"
                    style="background-image: url({{ url('assets/img/pages/support/card-bg.svg') }});">
                    <div class="card-body text-center">
                        <i class="fa fa-address-card display-4 text-white mb-3"></i>
                        <h4 class="text-white mb-0">{{ __('membership') }}</h4>
                    </div>
                </a>
            </div>

            <div class="col-md-4 mb-4">
                <a class="card card-hover bg-secondary bg-cover border-0 py-3" href="/support/show/Profile"
                    style="background-image: url({{ url('assets/img/pages/support/card-bg.svg') }});">
                    <div class="card-body text-center">
                        <i class="fa fa-user display-4 text-white mb-3"></i>
                        <h4 class="text-white mb-0">{{ __('profile') }}</h4>
                    </div>
                </a>
            </div>
        </div>
    </div>

    {{-- <section class="container pb-5 mb-3 mb-md-4">
        <div class="text-center mb-5">
            <h2 class="h3 font-weight-bold">{{ __('suggestedArticle') }}</h2>
        </div>

        <div class="card rounded-xl">
            <div class="card-body p-lg-5">
                <div class="articles-inner thumbnail p-ml-lg m-ml-none m-mr-none">
                    <span class="badge badge-ribbon"></span>

                    <h3 class="link-heading font-weight-bold">
                        <a href="./support-inner.html">Support Payment</a>
                    </h3>
                    <h4 class="h5 font-weight-bold mb-4">General</h4>

                    <img src="{{ url('assets/img/logo/logo.png') }}" width="225" alt="Bluefreelancer">

                    <hr>

                    <h4 class="mb-3">Some Heading Text</h4>

                    <p class="card-text">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita omnis doloribus aliquid repellat.
                        Ullam
                        praesentium fuga saepe non, hic a recusandae nihil voluptas accusamus porro? Exercitationem maiores,
                        perspiciatis cum quidem dolorem modi. Natus corporis aliquid, magnam hic, molestiae aliquam
                        laudantium
                        commodi dicta consequuntur adipisci aperiam ipsa animi asperiores a vitae? Unde officia itaque enim
                        maiores molestiae ipsa veritatis doloremque sapiente culpa, quos sequi alias, ducimus in quia,
                        maxime
                        laborum commodi dignissimos delectus excepturi nobis quas dolorem praesentium! Et at laborum porro
                        repellendus illo velit provident pariatur molestias iste, sunt quibusdam.
                    </p>

                    <p class="card-text">
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rerum totam voluptatibus ex quam
                        voluptatem
                        harum deserunt perferendis possimus architecto iste. Ducimus voluptate nam obcaecati quibusdam
                        quisquam ab
                        aliquid id eveniet nesciunt pariatur aspernatur sit soluta dolorum qui quam, deserunt culpa non ut
                        distinctio tempora iusto voluptatem aut asperiores? Blanditiis fugit iusto tenetur sequi ab sit eos
                        labore, quos fugiat accusamus doloribus? Doloremque, doloribus pariatur veniam expedita a magni
                        aliquam
                        ut? Praesentium, temporibus nulla? Velit vel modi, impedit fugiat, numquam possimus architecto ex
                        optio
                        fugit rem minus. Neque earum quasi blanditiis alias autem beatae, eos, architecto mollitia tempore
                        ipsum
                        quos assumenda sint quam facilis, illum dolorum adipisci ipsam! Rerum, quas voluptatum ipsa nihil,
                        at non
                        sequi, nesciunt cupiditate recusandae sunt impedit!
                    </p>

                    <p class="card-text">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit voluptate repellendus
                        accusamus
                        molestias nisi! Aliquid, aut? Facere ad ea earum reprehenderit aperiam a et quam saepe, quisquam,
                        nobis
                        fugit ducimus temporibus sunt exercitationem rem eligendi sint. Rem repellendus porro numquam,
                        praesentium
                        quae laudantium at molestias laboriosam quia dolore. In, quidem!
                    </p>

                    <p class="card-text">
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. At consequuntur, magnam nemo veniam
                        aperiam
                        expedita delectus eum provident quasi enim nostrum ab accusamus cum minima distinctio quia nobis a
                        perferendis quidem saepe. Explicabo ad tempore vel itaque nisi distinctio! Fugit deserunt aspernatur
                        corporis illum. Impedit, ex dolor saepe eum harum quibusdam deserunt, illo quisquam eius earum
                        tenetur.
                        Similique culpa neque quas eum vero! Laborum inventore necessitatibus et esse impedit nobis velit
                        ipsa
                        porro perferendis architecto non sequi dignissimos ad corrupti repellendus, quasi, laudantium
                        nesciunt rem
                        praesentium. Repellat deserunt aperiam vitae id enim itaque, ducimus, labore pariatur omnis
                        voluptatibus
                        at numquam rem non inventore assumenda, aliquid ab iusto! Quas, nam itaque dolore illum provident
                        quae
                        voluptate facilis fugit optio molestiae soluta esse maxime, explicabo enim? Accusantium ullam quia
                        soluta
                        eum corporis. Atque et neque nulla quos veritatis accusamus, est, ex provident pariatur impedit,
                        cupiditate iste odit aspernatur labore expedita recusandae a!
                    </p>
                </div>
            </div>
        </div>
    </section> --}}
@endsection
