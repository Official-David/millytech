@extends('layouts.app')

@section('title', 'Cards and Rates')

@section('content')
<div class="container-fluid">
    <div class="mb-sm-4 d-flex flex-wrap align-items-center text-head">
        <h6 class="mb-3 me-auto">@yield('title')</h6>
    </div>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="text-end">
                    <a href="{{route('user.trades.index')}}" class="btn btn-primary">Trade Now</a>
                </div>
                <div class="table-responsive" style="min-height: 300px">
                    <table class="table table-hover table-responsive-sm table-striped">
                        <thead>
                            <tr>
                                <th>Card</th>
                                <th>Rates(Physical)</th>
                                <th>Rates(E-code)</th>
                                <th>Last Change</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($giftcards as $giftcard)
                            <tr class="fs-14">
                                <td>{{$giftcard->name}}</td>
                                <td>
                                    @foreach ($giftcard->currencies as $currency)
                                    {{$currency->name .':'. $currency->rate}}
                                        @if (!$loop->last)
                                            {{'|'}}
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($giftcard->currencies as $currency)
                                    {{$currency->name .':'. $currency->ecode_rate}}
                                        @if (!$loop->last)
                                            {{'|'}}
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{$giftcard->updated_at}}</td>

                            @empty
                            <tr>
                                <td colspan="9" class="text-center">No giftcards yet!</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end pt-3">
                    {{ $giftcards->links() }}
                </div>
            </div>
        </div>
        <div class="text-start">
            <a href="{{route('user.trades.index')}}" class="btn btn-primary">Trade Now</a>
        </div>
    </div>
</div>
@endsection
