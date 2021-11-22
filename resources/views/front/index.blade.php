@extends('layouts.front.app')
@section('title','Home')

@section('content')
      <!--hero section start-->
        <section class="hero-section ptb-120 bg-dark text-white" style="background: url('{{asset('front/img/shape/dot-dot-wave-shape.svg')}}')no-repeat bottom left">
            <div class="container">
                <div class="row align-items-center justify-content-lg-between">
                    <div class="col-xl-5 col-lg-5">
                        <div class="hero-content-wrap text-center text-xl-start text-lg-start mt-5 mt-lg-0 mt-xl-0" data-aos="fade-up">
                            <h1 class="fw-bold display-5">Sell Your Giftcards with Ease!</h1>
                            <p class="lead">Sell giftcards from countries around the world...</p>
                            <div class="hero-subscribe-form-wrap pt-4 position-relative m-auto m-xl-0 d-none d-md-block d-lg-block d-xl-block">
                                <!-- <form id="subscribe-form" name="email-form" class="hero-subscribe-form d-block d-lg-flex d-md-flex">
                                    <input type="email" class="form-control me-2" name="Email" data-name="Email" placeholder="Enter Your Email Address" id="email-address" required="">
                                    <input type="submit" value="Subscribe" data-wait="Please wait..." class="btn btn-primary mt-3 mt-lg-0 mt-md-0">
                                </form> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 mt-lg-5 mt-4">
                        <div class="hero-img-wrap position-relative" data-aos="fade-up">
                            <div class="hero-screen-wrap">
                                <div class="phone-screen">
                                    <img src="{{asset('front/img/screen/phone-screen.png')}}" alt="hero image" class="position-relative img-fluid">
                                </div>
                                <div class="mac-screen">
                                    <img src="{{asset('front/img/screen/mac-screen.png')}}" alt="hero image" class="position-relative img-fluid rounded-custom">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--hero section end-->

        <!--customer section start-->
        <div class="customer-section pb-120 bg-dark">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-12">
                        <p class="text-center mt-lg-5 mt-4 mb-0" data-aos="fade-up" data-aos-delay="200">We Offer The Best Rates...</p>
                    </div>
                </div>
            </div>
        </div>
        <!--customer section end-->

        <!--highlight promo start-->
        <section class="promo-section ptb-120">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-10 col-lg-6">
                        <div class="section-heading text-center" data-aos="fade-up">
                            <h2>We are passionate about what we do.</h2>
                            <p>What is worth doing is worth doing well this is why we make sure we are always here for you. </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-lg-4">
                        <div class="promo-card-wrap promo-border-hover border border-2 bg-white rounded-custom p-5 mb-4 mb-lg-0 mb-md-4" data-aos="fade-up" data-aos-delay="50">
                            <div class="promo-card-info">
                                <h3 class="display-5 fw-medium mb-4">1500+</h3>
                                <h2 class="h5">Completed Trades</h2>
                                <p class="mb-0">Swiftly trade your giftcards in no time and enjoy instant payout.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="promo-card-wrap promo-border-hover border border-2 bg-white rounded-custom p-5 mb-4 mb-lg-0 mb-md-4" data-aos="fade-up" data-aos-delay="100">
                            <div class="promo-card-info">
                                <h3 class="display-5 fw-medium mb-4">1.5k</h3>
                                <h2 class="h5">Happy Customers</h2>
                                <p class="mb-0">We server our customers the right way keeping them glued to us.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="promo-card-wrap promo-border-hover border border-2 bg-white rounded-custom p-5 mb-4 mb-lg-0 mb-md-0" data-aos="fade-up" data-aos-delay="150">
                            <div class="promo-card-info">
                                <h3 class="display-5 fw-medium mb-4">24/7</h3>
                                <h2 class="h5">Customer Support</h2>
                                <p class="mb-0">Rapid response to customer complaint and observations.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--highlight promo end-->

        <!--feature section start-->
        <section class="feature-section-two pt-60 pb-10">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-lg-5 col-md-12">
                        <div class="section-heading" data-aos="fade-up">
                            <!-- <h4 class="h5 text-primary">Features</h4> -->
                            <h2>A Powerful Way to Sell your Giftcards</h2>
                            <p>Quick and simple way to sell your giftcards with instant payout.</p>
                            <ul class="list-unstyled mt-5">
                                <li class="d-flex align-items-start mb-4">
                                    <div class="icon-box bg-primary rounded me-4">
                                        <i class="fas fa-bezier-curve text-white"></i>
                                    </div>
                                    <div class="icon-content">
                                        <h3 class="h5">Quick, Simple and Easy</h3>
                                        <p>Sell your giftcards the right way.
                                        </p>
                                    </div>
                                </li>
                                <li class="d-flex align-items-start mb-4">
                                    <div class="icon-box bg-danger rounded me-4">
                                        <i class="fas fa-fingerprint text-white"></i>
                                    </div>
                                    <div class="icon-content">
                                        <h3 class="h5">Guaranteed Security</h3>
                                        <p>We keep all trades secured and do not share your data.
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-7">
                        <div class="feature-img-wrap position-relative d-flex flex-column align-items-end">
                            <ul class="img-overlay-list list-unstyled position-absolute">
                                <li class="d-flex align-items-center bg-white rounded shadow-sm p-3" data-aos="fade-up" data-aos-delay="50">
                                    <i class="fas fa-check bg-primary text-white rounded-circle"></i>
                                    <h6 class="mb-0">Create a Free Account</h6>
                                </li>
                                <li class="d-flex align-items-center bg-white rounded shadow-sm p-3" data-aos="fade-up" data-aos-delay="100">
                                    <i class="fas fa-check bg-primary text-white rounded-circle"></i>
                                    <h6 class="mb-0">Complete your Profile</h6>
                                </li>
                                <li class="d-flex align-items-center bg-white rounded shadow-sm p-3" data-aos="fade-up" data-aos-delay="100">
                                    <i class="fas fa-check bg-primary text-white rounded-circle"></i>
                                    <h6 class="mb-0">Update you bank details</h6>
                                </li>
                                <li class="d-flex align-items-center bg-white rounded shadow-sm p-3" data-aos="fade-up" data-aos-delay="150">
                                    <i class="fas fa-check bg-primary text-white rounded-circle"></i>
                                    <h6 class="mb-0">Sell your Giftcard</h6>
                                </li>
                            </ul>
                            <img src="{{asset('front/img/feature-img3.jpg')}}" alt="feature image" class="img-fluid rounded-custom" data-aos="fade-up">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--feature section end-->



        <!--work process section start-->
        <section class="work-process ptb-100">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-10 col-lg-6">
                        <div class="section-heading text-center" data-aos="fade-up">
                            <h4 class="h5 text-primary">Process</h4>
                            <h2>Just a Few Easy Steps to Trade your Giftcards</h2>
                            <p>Conveniently trade your giftcards from the comfort of your home with just a few clicks. </p>
                        </div>
                    </div>
                </div>
                <div class="row d-flex align-items-center">
                    <div class="col-md-6 col-lg-3">
                        <div class="process-card text-center px-4 py-lg-5 py-4 rounded-custom shadow-hover mb-3 mb-lg-0" data-aos="fade-up" data-aos-delay="50">
                            <div class="process-icon border border-light bg-custom-light rounded-custom p-3">
                                <span class="h2 mb-0 text-primary fw-bold">1</span>
                            </div>
                            <h3 class="h5">Create a free account</h3>
                            <p class="mb-0">Create a free account with us to enjoy unlimited trading</p>
                        </div>
                    </div>
                    <div class="dots-line first"></div>
                    <div class="col-md-6 col-lg-3">
                        <div class="process-card text-center px-4 py-lg-5 py-4 rounded-custom shadow-hover mb-3 mb-lg-0" data-aos="fade-up" data-aos-delay="100">
                            <div class="process-icon border border-light bg-custom-light rounded-custom p-3">
                                <span class="h2 mb-0 text-primary fw-bold">2</span>
                            </div>
                            <h3 class="h5">Complete your profile</h3>
                            <p class="mb-0">Complete your profile with basic information for our KYC records.</p>
                        </div>
                    </div>
                    <div class="dots-line first"></div>
                    <div class="col-md-6 col-lg-3">
                        <div class="process-card text-center px-4 py-lg-5 py-4 rounded-custom shadow-hover mb-3 mb-lg-0 mb-md-0" data-aos="fade-up" data-aos-delay="150">
                            <div class="process-icon border border-light bg-custom-light rounded-custom p-3">
                                <span class="h2 mb-0 text-primary fw-bold">3</span>
                            </div>
                            <h3 class="h5">Bank details</h3>
                            <p class="mb-0">Provide your bank details so we can pay you when you trade.</p>
                        </div>
                    </div>
                    <div class="dots-line first"></div>
                    <div class="col-md-6 col-lg-3">
                        <div class="process-card text-center px-4 py-lg-5 py-4 rounded-custom shadow-hover mb-0" data-aos="fade-up" data-aos-delay="200">
                            <div class="process-icon border border-light bg-custom-light rounded-custom p-3">
                                <span class="h2 mb-0 text-primary fw-bold">4</span>
                            </div>
                            <h3 class="h5">Start trading</h3>
                            <p class="mb-0">Congrats! You can now trade your giftcards quick and easy.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endsection