@extends('layouts.app')

@section('title','Dashboard')

@section('content')
<div class="container-fluid">
    <div class="mb-sm-4 d-flex flex-wrap align-items-center text-head">
        <h2 class="mb-3 me-auto">Dashboard</h2>
    </div>
    <div class="row">
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div class="card-data me-2">
                        <h5>Total trades</h5>
                        <h2 class="fs-40 font-w600">{{ $user->trades->count() }}</h2>
                    </div>
                    <div>
                        <span class="donut1" data-peity='{ "fill": ["var(--primary)", "rgba(242, 246, 252)"]}'></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div class="card-data me-2">
                        <h5>Pending trades</h5>
                        <h2 class="fs-40 font-w600">{{ $user->trades->where('status','pending')->count() }}</h2>
                    </div>
                    <div>
                        <span class="donut1" data-peity='{ "fill": ["rgb(255, 135, 35,1)", "rgba(242, 246, 252)"]}'>{{
                            $user->trades->where('status','pending')->count() }}/{{ $user->trades->count() }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div class="card-data me-2">
                        <h5>Processing trades</h5>
                        <h2 class="fs-40 font-w600">{{ $user->trades->where('status','processing')->count() }}</h2>
                    </div>
                    <div>
                        <span class="donut1" data-peity='{ "fill": ["rgb(56, 226, 93,1)", "rgba(242, 246, 252)"]}'>{{
                            $user->trades->where('status','processing')->count() }}/{{ $user->trades->count() }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div class="card-data me-2">
                        <h5>Rejected trades</h5>
                        <h2 class="fs-40 font-w600">{{$user->trades->where('status','rejected')->count()}}</h2>
                    </div>
                    <div>
                        <span class="donut1" data-peity='{ "fill": ["rgb(51, 62, 75,1)", "rgba(242, 246, 252)"]}'>{{
                            $user->trades->where('status','rejected')->count() }}/{{ $user->trades->count() }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header border-0">
                    <h4 class="mb-0 fs-20 text-black">Trade data</h4>
                </div>
                <div class="card-body  text-center" style="position: relative;">
                    <canvas id="trade-chart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body pb-3">
                    <p class="mb-2 d-flex  fs-14 text-black font-w500">Total pending amount
                        <span
                            class="ms-auto text-dark fs-14 font-w400">{{format_money($user->trades->where('status','pending')->sum('total'))}}</span>
                    </p>
                    <div class="progress mb-4" style="height:18px">
                        <div class="progress-bar bg-primary progress-animated"
                            style="width:{{$user->trades->count() > 0 ? ($user->trades->where('status','pending')->count() * 100) / $user->trades->count(): 0 }}%; height:18px;"
                            role="progressbar">
                        </div>
                    </div>
                    <p class="mb-2 d-flex  fs-14 text-black font-w500">Total rejected amount
                        <span
                            class="ms-auto text-dark fs-14 font-w400">{{format_money($user->trades->where('status','rejected')->sum('total'))}}</span>
                    </p>
                    <div class="progress mb-3" style="height:18px">
                        <div class="progress-bar bg-primary progress-animated"
                            style="width:{{$user->trades->count() > 0 ? ($user->trades->where('status','rejected')->count() * 100) / $user->trades->count(): 0 }}%; height:18px;"
                            role="progressbar">
                        </div>
                    </div>
                    <p class="mb-2 d-flex  fs-14 text-black font-w500">Total processing amount
                        <span
                            class="ms-auto text-dark fs-14 font-w400">{{format_money($user->trades->where('status','processing')->sum('total'))}}</span>
                    </p>
                    <div class="progress mb-3" style="height:18px">
                        <div class="progress-bar bg-primary progress-animated"
                            style="width:{{$user->trades->count() > 0 ? ($user->trades->where('status','processing')->count() * 100) / $user->trades->count(): 0 }}%; height:18px;"
                            role="progressbar">
                        </div>
                    </div>
                    <p class="mb-2 d-flex  fs-16 text-black font-w500">Total amount
                        <span
                            class="ms-auto text-dark fs-14 font-w400">{{format_money($user->trades->sum('total'))}}</span>
                    </p>
                    <div class="progress mb-3" style="height:18px">
                        <div class="progress-bar bg-primary progress-animated"
                            style="width:{{$user->trades->count() > 0 ? ($user->trades->count() * 100) /$user->trades->count():0 }}%; height:18px;"
                            role="progressbar">
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <strong>Logged in from</strong>
                            @if (\Browser::isMobile())
                                    <p><i class="fa fa-mobile fa-2x mt-1"></i></p>
                                @elseif (\Browser::isTablet())
                                    <p><i class="fa fa-tablet fa-2x mt-1"></i></p>
                                @elseif (\Browser::isDesktop())
                                    <p><i class="fa fa-desktop fa-2x mt-1"></i></p>
                                @endif
                            <p><strong>{{ \Browser::browserName() . ' on ' . \Browser::platformName() }}</strong></p>

                        </div>
                        <div class="col-md-6">
                            <strong>Your ip address</strong>
                            <h4 class="m-0 p-0 pt-3">
                                {{ request()->ip() }}
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header border-0">
                    <h4 class="mb-0 fs-20 text-black">Recent trades</h4>
                </div>
                <div class="card-body pt-1 mt-1">
                    <div class="table-responsive">
                        <table class="table table-hover table-responsive-sm table-stripe">
                            <thead>
                                <tr>
                                    <th class="fs-16">Asset</th>
                                    <th class="fs-16">Type</th>
                                    <th class="fs-16">Total</th>
                                    <th class="fs-16">Status</th>
                                    <th class="fs-16">Date</th>
                                </tr>
                            </thead>
                            <tbody class="fs-12">
                                @forelse ($user->trades->take(5) as $trade)
                                <tr>
                                    <td>{{$trade->tradeable->name}}</td>
                                    <td>{{ $trade->tradeable_type == \App\Models\GiftCard::class ? 'GiftCard':'Coin' }}</td>
                                    <td>{{ format_money($trade->total) }}</td>
                                    <td>{{ $trade->status }}</td>
                                    <td>{{ $trade->created_at->format('d M, Y') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">No trades yet.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center">
                        <a href="{{route('user.trades.history')}}" class="btn btn-outline-success"><i
                                class="fa fa-table"></i> View all</a>
                    </div>
                </div>
            </div>
        </div>
    </div>




</div>

@endsection

@push('js')
<!-- Chart piety plugin files -->
<script src="{{asset('back/vendor/peity/jquery.peity.min.js')}}"></script>
<!-- Apex Chart -->
<script src="{{asset('back/vendor/apexchart/apexchart.js')}}"></script>
<script src="{{asset('back/js/dashboard/dashboard-1.js')}}"></script>
{{-- <script src="{{asset('back/js/dashboard/dotted-map-init.js')}}"></script> --}}

@endpush

@push('js')
<script>
    const ctx = document.getElementById('trade-chart').getContext('2d')
        const myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {

                labels: ['Pending','Processing','Paid','Rejected','Verified'],
                datasets:[{
                    data: [
                        {{$user->trades->where('status','pending')->count()}},
                        {{$user->trades->where('status','processing')->count()}},
                        {{$user->trades->where('status','paid')->count()}},
                        {{$user->trades->where('status','rejected')->count()}},
                        {{$user->trades->where('status','verified')->count()}},
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.5)',
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(255, 206, 86, 0.5)',
                        'rgba(75, 192, 192, 0.5)',
                        'rgba(75, 292, 142, 0.5)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(75, 292, 142, 1)',
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        })
</script>
@endpush
