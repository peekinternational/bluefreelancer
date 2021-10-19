@extends('layouts.app')
@section('content')
    <!-- Title -->
    <div class="bg-secondary text-center bg-cover py-5"
        style="background-image: url({{ url('assets/img/dashboard/banner-1.jpg') }});">
        <h1 class="h5 font-weight-bold text-white">{{ __('FeeandCharges') }}</h1>
    </div>

    <section class="py-5 my-3 my-md-4">
        <div class="container">
            <div class="card card-bordered card-body rounded-xl">
                <h2 class="font-weight-bold">{{ __('FeeandCharges') }}</h2>
                <hr>

                <section>
                    <h3 class="h4 mb-4"><b>1.{{ __('feesforClients') }}</b></h3>

                    <section class="mb-4">
                        <strong>{{ __('FreeRegistrationClient') }}</strong>

                        <p>
                            {{ __('OutSourcingOKPostProjectReceive') }}
                        </p>
                        <p>
                            {{ __('Typeofproject') }}
                        </p>
                        <p>
                            {{ __('Cancelproject') }}
                        </p>
                    </section>

                    <section>
                        <h4 class="h5 mb-3"><b>{{ __('VideoFeeClient') }}</b></h4>

                        <p>
                            {{ __('UsingVideoChat') }}
                        </p>
                        <p>
                            {{ __('FreeProjVideoChatPayed') }}
                        </p>
                        <p>
                            {{ __('PurchaseNotCanceled') }}
                        </p>
                    </section>

                    <section>
                        <h4 class="h5 mb-3"><b>{{ __('RegistrationContest') }}</b></h4>

                        <p>
                            {{ __('ClientDepositTotalPrize') }}
                        </p>
                        <p>
                            {{ __('GuaranteedContestsNotRefunded') }}
                        </p>
                        <p>{{ __('RegistrationContestAwardingPrizeisFree') }}</p>
                        <p>{{ __('AdditionalPrizeForCompetition') }}</p>
                    </section>

                    <section class="pb-3">
                        <h4 class="h5 mb-3"><b>{{ __('VariousLivingServicesFee') }}</b></h4>

                        <p>
                            {{ __('IfSatisifiedGivePaymentApproval') }}
                        </p>
                    </section>

                    <section>
                        <h3 class="h4 my-4"><b>2.{{ __('FeesForClient') }}</b></h3>

                        <p>
                            {{ __('FirstSubscribeOutsourcingOKMember') }}
                        </p>
                    </section>


                    <section>
                        <h4 class="h5 mb-3"><b>{{ __('RequestSupportCount') }}</b></h4>

                        <p>
                            {{ __('LimitNoOFSupport') }}
                        </p>
                        <p> {{ __('IfMoreThenLimit') }}</p>
                    </section>


                    <section>
                        <h4 class="h5 mb-3"><b>{{ __('FreelanceProjectFee') }}</b></h4>

                        <p>
                            {{ __('ProjectSupportVideoChat') }}
                        </p>
                        <p> {{ __('CalculationMethodoneMillion') }}</p>
                        <p>{{ __('MillionWonwithVAT') }}</p>
                        <p>{{ __('AmountOfFreelancers') }}</p>
                        <p>{{ __('AmountReceivedByFreelancers') }}</p>
                    </section>

                    <section>
                        <h4 class="h5 mb-3"><b>{{ __('FreelanceFees') }}</b></h4>

                        <p>
                            {{ __('SupportForContest') }}
                        </p>
                        <p> {{ __('CalculationMethodPrizeoneMillion') }}</p>
                        <p>{{ __('AmountReceivedByFreelancers99') }}</p>
                        <p>{{ __('AmountReceivedByFreelancers87') }}</p>
                        {{-- <p>{{ __('AmountOfFreelancers') }}</p> --}}
                    </section>

                    <section class="pb-3">
                        <h4 class="h5 mb-3"><b>{{__('VariousLivingServicesRecruitmentFee')}}</b></h4>

                        <p>
                            {{__('FreelancerEmployedServiceFee')}}
                        </p>
                        <p> {{__('EmploymentOneMillion')}} </p>
                        <p>{{__('EmploymentOnepointOneMillion')}}</p>
                        <p>{{__('AmountReceivedByFreelancers93')}}</p>
                        <p>{{__('AmountReceivedByFreelancers82')}}</p>
                    </section>
                </section>

                <section>
                    <h3 class="h4 my-4"><b>3.{{__('FeesForUsingPayPal')}} </b></h3>
                </section>

                <section class="pb-3">
                    <h4 class="h5 mb-3"><b>{{__('PayPalPaymentFee')}}</b></h4>

                    <p>
                        {{__('WhenUsePaypalFees')}}
                    </p>
                    <p> {{__('PayPalPolicy')}}</p>
                </section>
            </div>
        </div>
    </section>
@endsection
