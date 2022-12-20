@extends('layouts.app')

@section('title','Trade history')

@section('content')

<div class="container-fluid">
    <div class="mb-sm-4 d-flex flex-wrap align-items-center text-head">
        <h6 class="mb-3 me-auto">@yield('title')</h6>
    </div>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive" style="min-height: 300px">
                    <table class="table table-hover table-responsive-sm table-striped">
                        <thead>
                            <tr>
                                <th>Reference</th>
                                <th>Card</th>
                                <th>Total</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($trades as $trade)
                            <tr class="fs-14">
                                <td>{{$trade->reference}}</td>
                                <td>{{ $trade->tradeable->name }}</td>
                                <td>{{ format_money($trade->total) }}</td>
                                <td>{{ $trade->tradeable_type == \App\Models\GiftCard::class ? 'GiftCard':'Coin' }}</td>
                                <td>
                                    <span @class([
                                            "badge",
                                            "badge-outline-success" => $trade->status == 'paid',
                                            "badge-outline-danger" => $trade->status == 'rejected',
                                            "badge-outline-info" => $trade->status == 'processing',
                                            "badge-outline-primary" => $trade->status == 'pending',
                                            "badge-outline-light" => $trade->status == 'verified',
                                    ])>
                                        {{ ucfirst($trade->status) }}
                                    </span>
                                </td>
                                <td>{{ $trade->created_at->format('d-m-Y - h:ia') }}</td>
                                <td>

                                    <div class="dropdown dropdown-sm">
                                        <button type="button" class="btn btn-success light sharp" data-bs-toggle="dropdown" aria-expanded="false">
                                            <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
                                        </button>
                                        <div class="dropdown-menu" style="margin: 0px;">
                                            <a onclick="show({{$trade->id}})" class="dropdown-item"> <i class="fa fa-eye"></i> View</a>
                                            @if ($trade->status == 'rejected')
                                                <a onclick="showStatus(`{{route('user.trades.show-status', $trade->id)}}`)" class="dropdown-item"> <i class="fa fa-times"></i> Rejection Message</a>
                                            @elseif($trade->status == 'verified')
                                                <a onclick="showStatus(`{{route('user.trades.show-status', $trade->id)}}`)" class="dropdown-item"> <i class="fa fa-check"></i> Verification Message</a>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="text-center">No trades yet!</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end pt-3">
                    {{ $trades->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="show-modal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Trade Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
    <style>
        td a{
            cursor:pointer;
        }
    </style>
@endpush

@push('js')
    <script>
        let show = id => {

            fetch(`${window.location.pathname}/show/${id}`)
            .then(res => res.json())
            .then(res => {
                document.querySelector('#show-modal .modal-body').innerHTML = res.html
                $('#show-modal').modal('show')
            })
            .catch(err => console.log(err))
        }

        let showStatus = url => {

            fetch(url)
            .then(res => res.json())
            .then(res => {
                document.querySelector('#show-modal .modal-body').innerHTML = res.html
                $('#show-modal').modal('show')
            })
            .catch(err => console.log(err))
        }
    </script>
@endpush
