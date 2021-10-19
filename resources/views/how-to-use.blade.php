@extends('layouts.app')
@section('content')
    <!-- Title -->
    <div class="bg-secondary text-center bg-cover py-5"
        style="background-image: url({{ url('assets/img/dashboard/banner-1.jpg') }});">
        <h1 class="h5 font-weight-bold text-white">{{ __('howToUseOutSourcing') }}</h1>
    </div>

    <section class="bg-white py-5 my-3 my-md-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="h4 font-weight-bold mb-4">{{ __('YouCanRegister') }}</h2>

                    <div class="font-size-sm mb-4">
                        <p class="mb-2"><i class="fa fa-hand-o-right mr-2"></i> {{ __('AllKindsOfProjects') }}</p>
                        <p class="mb-2"><i class="fa fa-hand-o-right mr-2"></i> {{ __('ExpertiseAndCreative') }}
                        </p>
                        <p class="mb-2"><i class="fa fa-hand-o-right mr-2"></i>
                            {{ __('OutsourcingOKWorldclass') }}</p>

                        <ul class="pt-3">
                            <li>{{ __('YouCanChoose') }}</li>
                            <li>{{ __('YouCanRegister') }}</li>
                            <li>{{ __('ItIsPossible') }}
                            </li>
                        </ul>

                        <p class="mb-2"><i class="fa fa-hand-o-right mr-2"></i> {{ __('AtTheMoment') }}</p>
                        <p class="mb-2"><i class="fa fa-hand-o-right mr-2"></i> {{ __('TheScopeOf') }}</p>
                        <p class="mb-2"><i class="fa fa-hand-o-right mr-2"></i> {{ __('ProjectAmounts') }}</p>
                    </div>

                    <a href="/post-project" class="btn btn-primary">{{ __('postProject') }}</a>
                </div>

                <div class="col-md-6 text-md-right">
                    <img class="rounded-circle" src="{{ url('assets/img/pages/support/how-01.png') }}"
                        alt="Illustration">
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 my-3 my-md-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="h4 font-weight-bold mb-4">{{ __('howToRegister') }}</h2>

                    <div class="font-size-sm mb-4">
                        <h5 class="mb-4"><i class="fa fa-edit mr-2"></i> {{ __('ProjectRegistration') }}</h5>
                        <p class="mb-4">{{ __('AfterRegistering') }}</p>

                        <h5 class="mb-4"><i class="fa fa-camera-retro mr-2"></i> {{ __('HowToChoose') }}</h5>
                        <ul class="mb-4">
                            <li>{{ __('BeSure') }}</li>
                            <li>{{ __('ShouldUse') }}</li>
                            <li>{{ __('YouHaveToCompare') }}</li>
                            <li>{{ __('IfYouWantFaceToFace') }}</li>
                        </ul>

                        <h5 class="mb-4"><i class="fa fa-handshake-o mr-2"></i> {{ __('MeetingAndContract') }}
                        </h5>
                        <ul class="mb-4">
                            <li>{{ __('SelectASuitable') }}
                            </li>
                            <li>{{ __('FreelanceAndFaceToFace') }}
                            </li>
                            <li>{{ __('AdditionalWork') }}</li>
                            <li>{{ __('InCaseOfOffline') }}</li>
                            <li>{{ __('AnOutSourcingOkContract') }}</li>
                            <li>{{ __('TheContractWill') }}</li>
                            <li>{{ __('ItIsDoneBy') }}</li>
                        </ul>

                        <h5 class="mb-4"><i class="fa fa-credit-card mr-2"></i> {{ __('PayWhenYour') }}</h5>
                        <p class="mb-4">{{ __('TheEscrowSafePaymentSystem') }}</p>
                    </div>

                    <a href="/post-project" class="btn btn-primary">{{ __('postProject') }}</a>
                </div>

                <div class="col-md-6 text-md-right pl-md-5">
                    <img class="img-fluid" src="{{ url('assets/img/pages/support/how-02.png') }}"
                        alt="Illustration">
                </div>
            </div>
        </div>
    </section>

    <section class="container bg-light rounded-xl p-5">
        <div class="row">
            <div class="col-md-5">
                <img class="img-fluid rounded-lg" src="{{ url('assets/img/pages/support/how-03.png') }}"
                    alt="Illustration">
            </div>

            <div class="col-md-7">
                <h2 class="h4 font-weight-bold mb-4">{{ __('FreelancersCanCheck') }}</h2>
                <p class="font-size-sm">{{ __('OutsourcingOKIsSetUp') }}</p>
                <p class="font-size-sm">{{ __('YouCanEasilySend') }}</p>
                <p class="font-size-sm mb-0">{{ __('YouOnlyHaveToPay') }}</p>
            </div>
        </div>
    </section>

    <section class="py-5 my-3 my-md-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h2 class="h4 font-weight-bold mb-4">{{ __('EscrowSafePayment') }}</h2>

                    <div class="font-size-sm mb-4">
                        <h5 class="mb-4"><i class="fa fa-shield mr-2"></i> {{ __('OutSourcingOKTrust') }}</h5>
                        <ul>
                            <li>{{ __('TheClientEscrow') }}</li>
                            <li>{{ __('OnlyEscrowPayment') }}</li>
                            <li>{{ __('IfThereIsaProblem') }}</li>
                        </ul>
                    </div>

                    <a href="/post-project" class="btn btn-primary">{{ __('postProject') }}</a>
                </div>

                <div class="col-md-6 text-md-right pl-md-5">
                    <img class="img-fluid" src="{{ url('assets/img/pages/support/how-04.png') }}"
                        alt="Illustration">
                </div>
            </div>
        </div>
    </section>

    <section class="container bg-light text-center rounded-xl p-5">
        <h2 class="h4 font-weight-bold">{{ __('FreelancerSolves') }}</h2>
        <p class="font-size-sm mb-4">{{ __('FreelancersCanGrow') }}</p>

        <a href="/post-project" class="btn btn-primary">{{ __('postProject') }}</a>
    </section>

    <section class="container py-5 my-3 my-md-4">
        <div class="text-center pb-3">
            <h2 class="h4 font-weight-bold">{{ __('IfYouAreInDoubt') }}</h2>
            <h6>{{ __('OutSourcingIsAResult') }}</h6>
            <p class="font-size-sm mb-4">{{ __('CompleteTheProject') }}</p>
        </div>

        {{-- <div class="row pb-3">
            <div class="col-md-3 mb-4">
                <div class="card shadow rounded-xl">
                    <img src="./img/pages/support/how-05.png" alt="Illustration" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title mb-0">
                            <a href="#">Building a shopping mall</a>
                        </h5>
                    </div>
                    <div class="card-footer">
                        <p class="font-size-ms mb-0">$5,000 - 9 Daily Work</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="card shadow rounded-xl">
                    <img src="./img/pages/support/how-06.png" alt="Illustration" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title mb-0">
                            <a href="#">Wearable development</a>
                        </h5>
                    </div>
                    <div class="card-footer">
                        <p class="font-size-ms mb-0">$5,000 - 9 Daily Work</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="card shadow rounded-xl">
                    <img src="./img/pages/support/how-07.png" alt="Illustration" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title mb-0">
                            <a href="#">3D Design</a>
                        </h5>
                    </div>
                    <div class="card-footer">
                        <p class="font-size-ms mb-0">$5,000 - 9 Daily Work</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="card shadow rounded-xl">
                    <img src="./img/pages/support/how-08.png" alt="Illustration" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title mb-0">
                            <a href="#">3D Design</a>
                        </h5>
                    </div>
                    <div class="card-footer">
                        <p class="font-size-ms mb-0">$5,000 - 9 Daily Work</p>
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="text-center">
            <a href="/post-project" class="btn btn-primary mr-2">{{ __('postProject') }}</a>
            <a href="/post-contest" class="btn btn-primary">{{ __('PostContest') }}</a>
        </div>
    </section>

    <section class="container py-5 my-3 my-md-4">
        <div class="pb-3">
            <h2 class="h4 font-weight-bold pb-3">{{ __('help') }}</h2>
            <h6 class="mb-4"><i class="fa fa-laptop mr-2"></i> {{ __('CheckOut') }}
            </h6>
        </div>

        <div class="row pb-3">
            <div class="col-md-6 mb-4">
                <p class="font-size-sm font-weight-bold mb-2">
                    <a href="#">{{ __('ContestOrProjectRegistration') }}</a>
                </p>
                <p class="font-size-sm font-weight-bold mb-2">
                    <a href="#">{{ __('howToPay') }}</a>
                </p>
            </div>

            <div class="col-md-6 mb-4">
                <p class="font-size-sm font-weight-bold mb-2">
                    <a href="#">{{ __('HowToChooseRight') }}</a>
                </p>
                <p class="font-size-sm font-weight-bold mb-2">
                    <a href="#">{{ __('HowToOperateClient') }}</a>
                </p>
            </div>
        </div>
    </section>
@endsection
