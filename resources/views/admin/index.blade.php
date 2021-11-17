@extends('layouts.app')

@section('title','Admin Dashboard')

@section('content')
<div class="container-fluid">
    <div class="mb-sm-4 d-flex flex-wrap align-items-center text-head">
        <h2 class="mb-3 me-auto">Dashboard</h2>
    </div>
    @can('super-admin')
    <div class="row">
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div class="card-data me-2">
                        <h5>Total users</h5>
                        <h2 class="fs-40 font-w600">{{ $users->count() }}</h2>
                    </div>
                    <div>
                        <span class="donut1" data-peity='{ "fill": ["var(--primary)", "rgba(242, 246, 252)"]}'>1</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div class="card-data me-2">
                        <h5>Active users</h5>
                        <h2 class="fs-40 font-w600">{{ $users->where('status','active')->count() }}</h2>
                    </div>
                    <div>
                        <span class="donut1" data-peity='{ "fill": ["rgb(255, 135, 35,1)", "rgba(242, 246, 252)"]}'>{{
                            $users->where('status','active')->count() }}/{{ $users->count() }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div class="card-data me-2">
                        <h5>Inactive Users</h5>
                        <h2 class="fs-40 font-w600">{{ $users->where('status','inactive')->count() }}</h2>
                    </div>
                    <div>
                        <span class="donut1" data-peity='{ "fill": ["rgb(56, 226, 93,1)", "rgba(242, 246, 252)"]}'>{{
                            $users->where('status','inactive')->count() }}/{{ $users->count() }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div class="card-data me-2">
                        <h5>Total trades</h5>
                        <h2 class="fs-40 font-w600">{{$trades->count()}}</h2>
                    </div>
                    <div>
                        <span class="donut1"
                            data-peity='{ "fill": ["rgb(51, 62, 75,1)", "rgba(242, 246, 252)"]}'>1</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endcan

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header border-0">
                    <h4 class="mb-0 fs-20 text-black">Trade data</h4>
                </div>
                <div class="card-body  text-center" style="position: relative;">
                    <canvas id="trade-chart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header border-0">
                    <h4 class="mb-0 fs-20 text-black">Recent trades</h4>
                </div>
                <div class="card-body pt-1 mt-1">
                    <div class="table-responsive">
                        <table class="table table-hover table-responsive-sm table-stripe">
                            <thead>
                                <tr>
                                    <th>Rate</th>
                                    <th>Amount</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($trades->take(5) as $trade)
                                <tr>
                                    <td>{{ $trade->rate }}</td>
                                    <td>{{ format_money($trade->amount) }}</td>
                                    <td>{{ format_money($trade->total) }}</td>
                                    <td>{{ $trade->status }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">No trades yet.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @can('super-admin')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header border-0">
                    <h4 class="mb-0 fs-20 text-black">New users</h4>
                </div>
                <div class="card-body pt-1 mt-1">
                    <div class="table-responsive">
                        <table class="table table-hover table-responsive-sm table-stripe">
                            <thead class="fs-12">
                                <tr>
                                    <th>Firstname</th>
                                    <th>Lastname</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Joined</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="fs-12">
                                @forelse ($users->take(5) as $user)
                                <tr>
                                    <td>{{ $user->firstname }}</td>
                                    <td>{{ $user->lastname }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <span class="badge badge-outline-{{user_status($user->status)}}">
                                            {{strtoupper($user->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $user->created_at->diffForHumans() }}</td>
                                    <td> <a href="{{ route('admin.user.edit',$user->id) }}"> <i class="fa fa-eye"></i> Profile</a></td>
                                </tr>
                                @empty
                                <td colspan="4" class="text-center text-muted">No users yet.</td>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @can('super-admin')
                    <div class="text-center">
                        <a href="{{route('admin.user.index')}}" class="btn btn-outline-success"><i
                                class="fa fa-table"></i> View all</a>
                    </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
    @endcan



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

                labels: ['Pending','Processing','Paid','Rejected'],
                datasets:[{
                    data: [
                        {{$trades->where('status','pending')->count()}},
                        {{$trades->where('status','processing')->count()}},
                        {{$trades->where('status','paid')->count()}},
                        {{$trades->where('status','rejected')->count()}},
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
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
