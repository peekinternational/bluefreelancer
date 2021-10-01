@extends('layouts.app')
@section('content')
    <!-- Title -->
    <div class="bg-secondary text-center bg-cover py-5"
        style="background-image: url({{ url('assets/img/dashboard/banner-1.jpg') }});">
        <h1 class="h5 font-weight-bold text-white">Bluefreelancer fee and commission</h1>
    </div>

    <section class="py-5 my-3 my-md-4">
        <div class="container">
            <div class="card card-bordered card-body rounded-xl">
                <h2 class="font-weight-bold">Bluefreelancer fee and commission</h2>
                <hr>

                <section>
                    <h3 class="h4 mb-4"><b>1.Fees and fees for "clients"</b></h3>

                    <section class="mb-4">
                        <strong>Free registration of "client" project</strong>

                        <p>
                            Bluefreelancer is free to sign up, post a project, receive bids from freelancers, review the
                            outsoucingOk's portfolio and discuss the project requirements. If you choose to award the
                            project, and
                            the freelancer accepts, we charge you a small project fee relative to the value of the selected
                            bid,
                            as an introduction fee.</p>
                        <p>
                            You can register free of charge regardless of the fixed amount (tax excluded) or the part-time
                            amount (tax excluded) as desired by the client.
                        </p>
                        <p>
                            You may cancel the "project" from your dashboard at any time for up to seven (7) days after the
                            "project" has been accepted for a full refund of your fee.
                        </p>
                    </section>

                    <section>
                        <h4 class="h5 mb-3"><b>Video chat fee for "client"</b></h4>

                        <p>
                            In case of using video chat, "client" will be charged for 5,000 won (by VAT) for video chatting
                            by
                            "project" case (per case), calculated from the day of purchase regardless of the time of
                            purchase, You
                            will not be able to use it after 30 days, and you will have to repurchase.
                        </p>
                        <p>
                            If the "client" uses the video chat even if the "project" is registered for free, the fee for
                            the
                            video chat is 5,000 won (without tax).
                        </p>
                        <p>
                            "Personal Service", "Recommendation", "Highlight", "Private", "NDA", "Emergency", "Guarantee of
                            Contest" and "Video Chat" purchased by "Client" Since the service is operated in real time, the
                            service fee (additional tax) paid by the "client" for the purchase will not be canceled or
                            refunded.
                        </p>
                    </section>

                    <section>
                        <h4 class="h5 mb-3"><b>Registration fees related to registration of "contest" of "client" (tax
                                excluded)</b></h4>

                        <p>
                            When registering a "Contest", the "Client" must "deposit" the same amount as the total contest
                            prize through the Escrow Payment System and refund the prize if the Client cancels. However, if
                            you
                            contact customer support 30 days after the cancellation date, you can get a refund
                        </p>
                        <p>
                            "Guaranteed contests" can not be refunded. If the "client" has already selected the contest as a
                            "winner" and the "winner" has completed the contest and paid the prize to the "winner" , The
                            "client"
                            must choose carefully and decide.
                        </p>
                        <p>Registration of a contest for registering a contest requiring "client" and awarding a prize is
                            free.</p>
                        <p>If the "client" grants the next winner in addition to the contest, he or she must pay an
                            additional prize for that competition.</p>
                    </section>

                    <section class="pb-3">
                        <h4 class="h5 mb-3"><b>Various living related services Admission Fee (VAT excluded)</b></h4>

                        <p>
                            "Life-related employment service" is free registration and no fee is charged to "client."
                            "Client"
                            must deposit the total service wage (excluding tax) through "escrow payment system" The
                            deposited
                            amount is secured in Bluefreelancer. If you are 100% satisfied, just give "freelancer" "payment
                            approval"
                        </p>
                    </section>

                    <section>
                        <h3 class="h4 my-4"><b>2.Fees and fees for "freelancers"</b></h3>

                        <p>
                            "Freelancer" first subscribes to an Bluefreelancer member, then creates a profile to select the
                            projects of interest, uploads the portfolio, receives project notifications, discusses the
                            "client"
                            and "project" details, We support for proposal (bid).
                        </p>
                    </section>


                    <section>
                        <h4 class="h5 mb-3"><b>Request to add "freelancer" support count</b></h4>

                        <p>
                            We are limiting the number of support to 300 to prevent the support / bidding of some
                            "freelancers" indiscreet projects,
                        </p>
                        <p> If the number of support / bids is more than 300, you can add up to 50 times by purchasing
                            additional 2,000 won (excluding tax).</p>
                    </section>


                    <section>
                        <h4 class="h5 mb-3"><b>"Freelance" "project" fee and fee</b></h4>

                        <p>
                            Project support and video chat are free if you support a "project" regardless of fixed amount or
                            hourly amount. If you accept and agree to the "client" "project" and if you are an "enterprise"
                            Fees
                            will be deducted from 7% (excluding VAT) fee. If you are "Individual", you will receive a
                            deduction of
                            7% (excluding VAT) and 3.3% withholding at the total "Project" cost.
                        </p>
                        <p> [Calculation method] When project amount is 1 million won </p>
                        <p>The payment amount of "client" is 1.1 million won (1 million won + 10% VAT)</p>
                        <p>The amount of "freelancers" received: 1023,000 won for business (limited to outsourcing fee
                            "project" amount 930,000won + VAT 10%)</p>
                        <p>The amount of "freelancers" received: 899,310 won for individuals (the "project" amount for
                            outsourcing is limited to 930,000 won - withholding of 3.3%)</p>
                    </section>

                    <section>
                        <h4 class="h5 mb-3"><b>"Freelance" "Contest" fee and fee information</b></h4>

                        <p>
                            Support for "contest" as a "freelancer" is free, and the fee for the "contest" fee applies when
                            a
                            contest prize is awarded. If the "Client" is awarded the "Contest" prize, the fee will be
                            deducted
                            from the 10% commission fee (excluding VAT) for the enterprise and 10% We will deduct 3.3% from
                            collection.
                        </p>
                        <p> [Calculation method] When the prize amount of contest is 1 million won </p>
                        <p>The payment amount of "client" is 1.1 million won (1 million won + 10% VAT)</p>
                        <p>The amount of "freelancers" received: 99,000 won for business (limited to the outsourcing fee,
                            90% of the fee for the contest test + 10% VAT)</p>
                        <p>The amount of "freelancers" received: KRW 870,000 for individuals (the fee for outsourcing is
                            limited to a fee of KRW 900,000 for the concession test fee - withholding of 3.3%)</p>
                    </section>

                    <section class="pb-3">
                        <h4 class="h5 mb-3"><b>Various living related services Recruitment fees and fees</b></h4>

                        <p>
                            If a "freelancer" is employed to perform a client's service, the "service fee" is deducted from
                            the total service wage of 15% (excluding VAT) Separate) and withholding tax at 3.3%
                        </p>
                        <p> [Calculation method] When the employment amount is 1 million won </p>
                        <p>The payment amount of "client" is 1.1 million won (1 million won + 10% VAT)</p>
                        <p>The amount of "freelancers" received: 93,500 won for companies (limited to the outsourcing fee,
                            the contest test fee is 850,000 won + 10% VAT)</p>
                        <p>The amount of "freelancers" received: 821,1950 won for individuals (The amount of outsourcing fee
                            is limited. Contest test fee: 850,000 won - Withholding tax: 3.3%)</p>
                    </section>
                </section>

                <section>
                    <h3 class="h4 my-4"><b>3.Fees for using PayPal </b></h3>
                </section>

                <section class="pb-3">
                    <h4 class="h5 mb-3"><b>"PayPal" Payment Fee Information</b></h4>

                    <p>
                        When using PayPal, all domestic and international credit card users will not be charged the same
                        card fee as cash. However, if you pay by PayPal, you will be responsible for the fees charged by
                        PayPal
                        policy.
                    </p>
                    <p> PayPal fees are charged to you under the PayPal policy and have nothing to do with
                        Bluefreelancer.</p>
                </section>
            </div>
        </div>
    </section>
@endsection
