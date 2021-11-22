@extends('layouts.front.pages')
@section('title','Services')

@section('content')

        <!--page header section start-->
        <section class="page-header position-relative overflow-hidden ptb-120 bg-dark" style="background: url('{{asset('front/img/page-header-bg.svg')}}')no-repeat bottom left">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12">
                        <h1 class="display-5 fw-bold">We are your Surest Giftcard Plug</h1>
                        <p class="lead">Seamlessly actualize client-based users after out-of-the-box value. Globally embrace
                            strategic data through frictionless expertise.</p>
                    </div>
                </div>
                <div class="bg-circle rounded-circle circle-shape-3 position-absolute bg-dark-light right-5"></div>
            </div>
        </section>
        <!--page header section end-->

        <!--features grid section start-->
        <section class="feature-section bg-light ptb-120">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="feature-grid">
                            <div class="feature-card bg-white shadow-sm highlight-card rounded-custom p-5">
                                <div class="icon-box d-inline-block rounded-circle bg-primary-soft mb-32">
                                    <i class="fal fa-analytics icon-sm text-primary"></i>
                                </div>
                                <div class="feature-content">
                                    <h3 class="h5">Advanced sales system</h3>
                                    <p>With our tested and trusted trading system you are guaranteed to get the best from us.</p>
                                    <p> We also have some intresting features </p>
                                    <h6 class="mt-4">Included with...</h6>
                                    <ul class="list-unstyled mb-0">
                                        <li class="py-1"><i class="fad fa-check-circle me-2 text-primary"></i>24/7  Customer Service
                                        </li>
                                        <li class="py-1"><i class="fad fa-check-circle me-2 text-primary"></i>Personal
                                            branded Giftcard
                                        </li>
                                        <li class="py-1"><i class="fad fa-check-circle me-2 text-primary"></i>Quick Payout
                                        </li>
                                        <li class="py-1"><i class="fad fa-check-circle me-2 text-primary"></i>Weekly Newsletters
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="feature-card bg-white shadow-sm rounded-custom p-5">
                                <div class="icon-box d-inline-block rounded-circle bg-success-soft mb-32">
                                    <i class="fal fa-file-chart-line icon-sm text-success"></i>
                                </div>
                                <div class="feature-content">
                                    <h3 class="h5">Quick Sales</h3>
                                    <p class="mb-0">Quickly sell your unused giftcards hassle free. Only with Millytech.</p>
                                </div>
                            </div>
                            <div class="feature-card bg-white shadow-sm rounded-custom p-5">
                                <div class="icon-box d-inline-block rounded-circle bg-danger-soft mb-32">
                                    <i class="fal fa-user-friends icon-sm text-danger"></i>
                                </div>
                                <div class="feature-content">
                                    <h3 class="h5">User Friendly Interface</h3>
                                    <p class="mb-0">We have made our user interface smooth and easy to use.</p>
                                </div>
                            </div>
                            <div class="feature-card bg-white shadow-sm rounded-custom p-5">
                                <div class="icon-box d-inline-block rounded-circle bg-dark-soft mb-32">
                                    <i class="fal fa-spell-check icon-sm text-dark"></i>
                                </div>
                                <div class="feature-content">
                                    <h3 class="h5">Best Rates</h3>
                                    <p class="mb-0">We offer the best rates you can find anywhere.</p>
                                </div>
                            </div>
                            <div class="feature-card bg-white shadow-sm rounded-custom p-5">
                                <div class="icon-box d-inline-block rounded-circle bg-warning-soft mb-32">
                                    <i class="fal fa-cog icon-sm text-warning"></i>
                                </div>
                                <div class="feature-content">
                                    <h3 class="h5">Easy Customization</h3>
                                    <p class="mb-0">Choose how you want ot get paid for your giftcards.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--features grid section end-->


@endsection