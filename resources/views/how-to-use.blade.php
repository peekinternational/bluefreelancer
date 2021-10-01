@extends('layouts.app')
@section('content')
    <!-- Title -->
    <div class="bg-secondary text-center bg-cover py-5"
        style="background-image: url({{ url('assets/img/dashboard/banner-1.jpg') }});">
        <h1 class="h5 font-weight-bold text-white">How to use Bluefreelancer</h1>
    </div>

    <section class="bg-white py-5 my-3 my-md-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="h4 font-weight-bold mb-4">You can register specific technology, cost and schedule requirements
                        as you wish.</h2>

                    <div class="font-size-sm mb-4">
                        <p class="mb-2"><i class="fa fa-hand-o-right mr-2"></i> All kinds of projects can be
                            registered regardless of size and field.</p>
                        <p class="mb-2"><i class="fa fa-hand-o-right mr-2"></i> Expertise and creative field
                            Leading freelance members will be able to offer their content to clients within minutes.</p>
                        <p class="mb-2"><i class="fa fa-hand-o-right mr-2"></i> Bluefreelancer's world-class
                            freelance members represent a variety of solutions to clients within minutes:</p>

                        <ul class="pt-3">
                            <li>You can choose fixed amount or time as you like.</li>
                            <li>You can register specific technology, cost and schedule requirements as you wish.</li>
                            <li>It is possible to develop small, large scale and all kinds of projects regardless of scale.
                            </li>
                        </ul>

                        <p class="mb-2"><i class="fa fa-hand-o-right mr-2"></i> At the moment of project
                            registration freelancers complete satisfactory results with prompt and reasonable amount.</p>
                        <p class="mb-2"><i class="fa fa-hand-o-right mr-2"></i> The scope of the client's project
                            work may vary according to the requirements of the freelancer.</p>
                        <p class="mb-2"><i class="fa fa-hand-o-right mr-2"></i> Project amounts can be selected
                            directly within the planned range, either as fixed amounts or as part-time amounts.</p>
                    </div>

                    <a href="/post-project" class="btn btn-primary">Post Project</a>
                </div>

                <div class="col-md-6 text-md-right">
                    <img class="rounded-circle" src="{{ url('assets/img/pages/support/how-01.png') }}" alt="Illustration">
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 my-3 my-md-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="h4 font-weight-bold mb-4">How to register a project</h2>

                    <div class="font-size-sm mb-4">
                        <h5 class="mb-4"><i class="fa fa-edit mr-2"></i> Project Registration</h5>
                        <p class="mb-4">After registering the project title and contents, present the project
                            estimate to the freelancer If you propose your profile directly after checking your profile in
                            Global Membership Search, you will receive quotes and support from freelancers You can receive
                            the contents in a short time!</p>

                        <h5 class="mb-4"><i class="fa fa-camera-retro mr-2"></i> How to Choose the Right
                            Freelancer</h5>
                        <ul class="mb-4">
                            <li>Be sure to check your application and freelance profile.</li>
                            <li>Should use Bluefreelancer video and chat.</li>
                            <li>You have to compare freelancers' proposals carefully and choose the most suitable
                                freelancer.</li>
                            <li>If you want to have a face-to-face meeting after choosing a freelancer, you can always get
                                in touch with the Bluefreelancer headquarters conference room.</li>
                        </ul>

                        <h5 class="mb-4"><i class="fa fa-handshake-o mr-2"></i> Meeting and contract method</h5>
                        <ul class="mb-4">
                            <li>Select a suitable freelancer and apply for a consultation by video chat to the applicant.
                            </li>
                            <li>Freelance and face-to-face meetings can be done at any time by Bluefreelancer headquarters.
                            </li>
                            <li>Additional work such as writing contracts and handling expenses is carried out from the head
                                office, both online and offline.</li>
                            <li>In case of offline contract, only outsourcing will be conducted at Okhwa Head Office.</li>
                            <li>An Bluefreelancer contract has the same effect as an actual written contract.</li>
                            <li>The contract will be processed in three ways: simple, signed, and stamped.</li>
                            <li>It is done by the seal procedure according to the Electronic Signature, Electronic Document
                                and Electronic Commerce Basic Law.</li>
                        </ul>

                        <h5 class="mb-4"><i class="fa fa-credit-card mr-2"></i> Pay when your results are
                            satisfied!</h5>
                        <p class="mb-4">The escrow safe payment system allows the client to pay directly and
                            securely.The payment decision can be made only by the client. All payments and privileges are
                            only available to clients. You can pay according to the work period and contract set by the
                            client, and pay only when you are finished.</p>
                    </div>

                    <a href="/post-project" class="btn btn-primary">Post Project</a>
                </div>

                <div class="col-md-6 text-md-right pl-md-5">
                    <img class="img-fluid" src="{{ url('assets/img/pages/support/how-02.png') }}" alt="Illustration">
                </div>
            </div>
        </div>
    </section>

    <section class="container bg-light rounded-xl p-5">
        <div class="row">
            <div class="col-md-5">
                <img class="img-fluid rounded-lg" src="{{ url('assets/img/pages/support/how-03.png') }}" alt="Illustration">
            </div>

            <div class="col-md-7">
                <h2 class="h4 font-weight-bold mb-4">Freelancers can check the progress of the project in real time via
                    video chat.</h2>
                <p class="font-size-sm">Bluefreelancer is set up to use Google Chrome optimized PC to monitor the progress
                    of work in real time and to share communication. You can check all project progress and future project
                    schedule from freelancers in real time.</p>
                <p class="font-size-sm">You can easily send messages to a freelancer regardless of where you are on the
                    mobile. You can communicate with a freelancer in real time even if you share confirmation, update and
                    work situation.</p>
                <p class="font-size-sm mb-0">You only have to pay through your escrow secure payment system if the contract
                    is completed or the project is completed successfully or the project is completed satisfactorily.</p>
            </div>
        </div>
    </section>

    <section class="py-5 my-3 my-md-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h2 class="h4 font-weight-bold mb-4">Escrow safe payment system</h2>

                    <div class="font-size-sm mb-4">
                        <h5 class="mb-4"><i class="fa fa-shield mr-2"></i> Bluefreelancer trust and safety of our
                            members are our top priority and our basic policy is:</h5>
                        <ul>
                            <li>The client's escrow and all transactional systems are protected by SSL encryption.</li>
                            <li>Only escrow payment will be paid to freelancers if the client is satisfied.</li>
                            <li>If there is a problem, a representative will help you (Customer Center: 10 am to 5 pm /
                                excluding holidays)</li>
                        </ul>
                    </div>

                    <a href="/post-project" class="btn btn-primary">Post Project</a>
                </div>

                <div class="col-md-6 text-md-right pl-md-5">
                    <img class="img-fluid" src="{{ url('assets/img/pages/support/how-04.png') }}" alt="Illustration">
                </div>
            </div>
        </div>
    </section>

    <section class="container bg-light text-center rounded-xl p-5">
        <h2 class="h4 font-weight-bold">Freelancer solves your ideas ...</h2>
        <p class="font-size-sm mb-4">Freelancers can grow your business one step further.</p>

        <a href="/post-project" class="btn btn-primary">Post Project</a>
    </section>

    <section class="container py-5 my-3 my-md-4">
        <div class="text-center pb-3">
            <h2 class="h4 font-weight-bold">If you are in doubt, please check out the next project and contest!</h2>
            <h6>Outsourcing is a result of several projects and contest entries that our clients have registered.</h6>
            <p class="font-size-sm mb-4">Complete the project by searching Bluefreelancer projects and searching for
                contests.</p>
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
            <a href="/post-project" class="btn btn-primary mr-2">Post Project</a>
            <a href="/post-contest" class="btn btn-primary">Post Contest</a>
        </div>
    </section>

    <section class="container py-5 my-3 my-md-4">
        <div class="pb-3">
            <h2 class="h4 font-weight-bold pb-3">Help</h2>
            <h6 class="mb-4"><i class="fa fa-laptop mr-2"></i> Check out these links to find out where to start!
            </h6>
        </div>

        <div class="row pb-3">
            <div class="col-md-6 mb-4">
                <p class="font-size-sm font-weight-bold mb-2">
                    <a href="#">1. Contest or project registration method and procedure</a>
                </p>
                <p class="font-size-sm font-weight-bold mb-2">
                    <a href="#">2. In Bluefreelancer how to pay for projects and contests</a>
                </p>
            </div>

            <div class="col-md-6 mb-4">
                <p class="font-size-sm font-weight-bold mb-2">
                    <a href="#">3. How to choose the right applicant</a>
                </p>
                <p class="font-size-sm font-weight-bold mb-2">
                    <a href="#">4. How to operate the client escrow payment system</a>
                </p>
            </div>
        </div>
    </section>
@endsection
